<?php
if(isset($_GET)){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$missing = []; $data = [];	
	
	// validating and sanitizing ph_id
	$phid = removenum($_GET['phid']);
	if(empty($phid)){
		$missing['mat'] = "ph error";
	}else{// check if the patient is the current user
		if(content_data('patient_health_table','ph_id',$phid,'ph_id',"AND p_id = {$p_id}") === false){
			$missing['mat'] = "error";
		}else{
			$ph_id = (test_input($phid));
		}
	}
	
	// validating and sanitizing d_id
	$did = removenum($_GET['did']);
	if(empty($did)){
		$missing['mat'] = "d error";
	}else{
		$d_id = (test_input($did));
	}
	
	if(empty($missing)){
		if(content_data('guidance_request_table','gr_id',$ph_id,'ph_id',"AND p_id = {$p_id}") !== false){
			$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>You have a doctor already or a pending request";
		}else{
			$patient = new patient('admin');
			$patient->ph_id = $ph_id;
			$patient->d_id = $d_id;
			$result = $patient->send_quidance_request();
			if($result === 'success'){
				$data["status"] = 'success';$data["message"] = "<b class='j-text-color9'>Success!!!</b><br>Request successfully sent";
			}elseif($result === 'fail'){
				$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occurred while sending request, try again";
			}
		}
	}else{
		$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occurred while sending request, try again";
	}
	echo json_encode($data);
}//end of if empty

?>