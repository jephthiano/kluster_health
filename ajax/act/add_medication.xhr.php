<?php
if(isset($_POST)){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$missing = []; $data = [];	
	
	// validating and sanitizing name
	$nm = ($_POST['nm']);
	if(empty($nm)){
		$missing['nme'] = "* cannot be empty";
	}else{
		$name = (test_input($nm));
	}
	
	// validating and sanitizing duration
	$du = ($_POST['du']);
	if(empty($du)){
		$missing['due'] = "* cannot be empty";
	}elseif(!is_numeric($du)){
		$missing['due'] = "* must be a number";
	}else{
		$duration = (test_input($du));
	}
	
	// validating and sanitizing interval
	$dsi = ($_POST['dsi']);
	if(empty($dsi)){
		$missing['dsie'] = "* cannot be empty";
	}elseif(!is_numeric($dsi)){
		$missing['dsie'] = "* must be a number";
	}else{
		$interval = strtolower(test_input($dsi));
	}
	
	// validating and sanitizing Last time inatke
	$lit = ($_POST['lit']);
	if(empty($lit)){
		$missing['lite'] = "* cannot be empty";
	}elseif(is_date_valid($lit)){
		$missing['lite'] = "* invaled date";
	}else{
		$last_intake_time = (test_input($lit));
	}
	
	// validating and sanitizing id
	$id = removenum($_POST['phid']);
	if(empty($id)){
		$missing['mat'] = "";
	}else{
		$ph_id = (test_input($id));
	}
	
	if(empty($missing)){
		$sec = (60*60*$interval);
		if(!is_lapsed($sec,$last_intake_time)){ //check if  (last intake + interval ) is greater than now (i.e it is more than interval ago)
			$missing['lite'] = "* cannot be more than {$interval} ago";
		}elseif(is_lapsed(0,$last_intake_time)){ //if last intake is more than now
			$missing['lite'] = "* cannot be more than now";
		}
		//array for first an next adherence data
		$adhere_array['taken'] = $last_intake_time;
		$adhere_array['pending'] = add_time($last_intake_time,$interval,'hour');
	}
	
	if(empty($missing)){
		$register = content_data('patient_medication_table','pmd_id',$name,'pmd_name',"AND p_id = {$p_id}");
		if($register !== false){
			$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>You have added this medication already";
		}else{
			$patient = new patient('admin');
			$patient->name = $name;
			$patient->duration = $duration;
			$patient->last_intake_time = $last_intake_time;
			$patient->interval = $interval;
			$patient->ph_id = $ph_id;
			$patient->adhere_array = $adhere_array;
			$result = $patient->add_medication();
			if($result === 'success'){
				$data["status"] = 'success';$data["message"] = "<b class='j-text-color9'>Success!!!</b><br>Medication data successfully added.
				<br>Once it is time to take your medication. you will be notified through email (default).
				<br>You can change your preferred notification settings at <br>Profile > Account & Security > Notification.
				<br>After taking or missing your medication, please confirm it in the reminder section to keep your adherence data up to date";
			}elseif($result === 'fail'){
				$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occurred while adding medication data, try again";
			}
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $missing;
	}
	echo json_encode($data);
}//end of if empty

?>