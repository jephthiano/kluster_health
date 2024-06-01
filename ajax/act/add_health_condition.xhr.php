<?php
if(isset($_POST)){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$missing = []; $data = [];	
	
	// validating and sanitizing illness
	$ill = ($_POST['ill']);
	if(empty($ill)){
		$missing['ille'] = "* select a value";
	}else{
		$illness = strtolower(test_input($ill));
	}
	
	// validating and sanitizing stage
	$sta = ($_POST['stg']);
	if(empty($sta)){
		$missing['stge'] = "* select a value";
	}else{
		$stage = strtolower(test_input($sta));
	}
	
	// validating and sanitizing note
	$not = ($_POST['nt']);
	if(empty($not)){
		$note = NULL;
	}else{
		$note = strtolower(test_input($not));
	}
	
	if(empty($missing)){
		$register = content_data('patient_health_table','ph_id',$illness,'ph_illness',"AND p_id = {$p_id}");
		if($register !== false){
			$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>You have added {$illness} already";
		}else{
			$patient = new patient('admin');
			$patient->illness = $illness;
			$patient->stage = $stage;
			$patient->note = $note;
			$result = $patient->add_health_condition();
			if($result === 'success'){
				$data["status"] = 'success';$data["message"] = "<b class='j-text-color9'>Success!!!</b><br>Data successfully added";
			}elseif($result === 'fail'){
				$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occurred while adding data, try again";
			}
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $missing;
	}
	echo json_encode($data);
}//end of if empty

?>