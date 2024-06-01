<?php
if(isset($_GET)){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$missing = []; $data = [];	
	
	
	// validating and sanitizing type
	$ty = ($_GET['ty']);
	if($ty !== 'remove' && $ty !== 'cancel'){
		$missing['mat'] = "ty error";
	}else{
		if($ty === 'remove'){
			$suc_msg = "Medical professional successfully removed";
			$fail_msg = "Error occurred while removing medical professional, try again";
		}else{
			$suc_msg = "Request successfully cancelled";
			$fail_msg = "Error occurred while cancelling request, try again";
		}
		$type = (test_input($ty));
	}
	
	// validating and sanitizing gr_id
	$grid = removenum($_GET['grid']);
	if(empty($grid)){
		$missing['mat'] = "ph error";
	}else{// check if the patient is the current user
		if(content_data('guidance_request_table','gr_id',$grid,'gr_id',"AND p_id = {$p_id}") === false){
			$missing['mat'] = "error";
		}else{
			$gr_id = (test_input($grid));
		}
	}
	
	if(empty($missing)){
		$patient = new patient('admin');
		$patient->gr_id = $gr_id;
		$result = $patient->delete_quidance_request();
		if($result === 'success'){
			$data["status"] = 'success';$data["message"] = "<b class='j-text-color9'>Success!!!</b><br>{$suc_msg}";
		}elseif($result === 'fail'){
			$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>{$fail_msg}";
		}
	}
	echo json_encode($data);
}//end of if empty

?>