<?php
if(isset($_GET)){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$missing = []; $data = [];	
	
	// validating and sanitizing pmaid
	$id = removenum($_GET['pmaid']);
	if(empty($id)){
		$missing['mat'] = "error";
	}else{
		$pma_id = (test_input($id));
	}
	
	// validating and sanitizing status
	$st = ($_GET['st']);
	if($st !== 'taken' && $st !== 'missed'){
		$missing['mat'] = "error";
	}else{
		$new_status = (test_input($st));
	}
	$pmd_id = content_data('patient_adherence_table','pmd_id',$pma_id,'pma_id',"AND p_id = {$p_id}");
	$ph_id = content_data('patient_adherence_table','ph_id',$pma_id,'pma_id',"AND p_id = {$p_id}");
	$dosage_interval = content_data('patient_medication_table','pmd_dosage_interval',$pmd_id,'pmd_id',"AND p_id = {$p_id}"); //med dosage interval
	$last_med_datetime = content_data('patient_adherence_table','pma_datetime',$pma_id,'pma_id',"AND p_id = {$p_id}"); //last med intake
	$next_med_datetime = add_time($last_med_datetime,$dosage_interval,'hour'); //next med intake
	$duration = content_data('patient_medication_table','pmd_duration',$pmd_id,'pmd_id',"AND p_id = {$p_id}"); //duration of med
	$first_intake_time = content_data('patient_medication_table','pmd_first_intake_time',$pmd_id,'pmd_id',"AND p_id = {$p_id}"); //first time med is taken
	$lapse_time = add_time($first_intake_time,$duration,'day');
	
	if(is_lapsed(-180,$next_med_datetime,$lapse_time)){ //if $next_med_time is greater than expired time (expire status = true, i.e dont insert next adherence)
		$expired_status = true;
	}else{
		$expired_status = false;
	}

	if(empty($missing)){
		$cur_status = content_data('patient_adherence_table','pma_status',$pma_id,'pma_id',"AND p_id = {$p_id}");
		if($cur_status !== 'pending' && $cur_status !== 'notified'){
			$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>You have confirmed this adherence already, kindly refresh the page";
		}else{
			$patient = new patient('admin');
			$patient->pma_id = $pma_id;
			$patient->status = $new_status;
			$patient->expired_status = $expired_status;
			$patient->datetime = $next_med_datetime;
			$patient->pmd_id = $pmd_id;
			$patient->ph_id = $ph_id;
			$result = $patient->confirm_adherence();
			if($result === 'success'){
				if($expired_status === true){
					$dateformat = show_date($lapse_time).' '.show_time($lapse_time);
					$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Yes!!!</b><br>Medication duration has expired on {$dateformat}";
				}else{
					$dateformat = show_date($next_med_datetime).' '.show_time($next_med_datetime);$message = '';
					if(is_lapsed(0,$dateformat)){ // if date of next medication is greater than now, patient will be notified
						$message = "You will be notified when it is time";
						$verb = 'is';
					}else{
						$message = "Your next medication time lapsed, Kindly confirm your adherence";
						$verb = 'was';
					}
					$data["status"] = 'success';$data["message"] = "<b class='j-text-color9'>Success!!!</b><br>Adherence data successfully updated.
					<br>Your next medication intake {$verb} {$dateformat} <br> {$message}";
				}
			}elseif($result === 'fail'){
				$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occurred while confirming adherence data, try again";
			}
		}
	}else{
		$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occurred while confirming adherence data, try again";
	}
	echo json_encode($data);
}//end of if empty

?>