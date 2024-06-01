<?php
if(isset($_GET)){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	require_once(file_location('doctor_inc_path','session_check_nologout.inc.php'));
	$missing = []; $data = [];	
	
	// validating and sanitizing status
	$st = ($_GET['st']);
	if($st !== 'accepted' && $st !== 'rejected'){
		$missing['mat'] = "ph error";
	}else{
		$status = (test_input($st));
	}
	
	// validating and sanitizing gr_id
	$grid = removenum($_GET['grid']);
	if(empty($grid)){
		$missing['mt'] = "d error";
	}else{
		$gr_id = (test_input($grid));
	}
	if(empty($missing)){
		if(content_data('guidance_request_table','gr_status',$gr_id,'gr_id',"AND d_id = {$d_id}") !== 'pending'){
			$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>This request is not available for confirmation";
		}else{
			$doctor = new doctor('admin');
			$doctor->status = $status;
			$doctor->gr_id = $gr_id;
			$result = $doctor->return_quidance_request();
			if($result === 'success'){
				if($status === 'accepted'){
					$message = ', you can now monitor patient medication adherence data';
				}else{
					$message = '';
				}
				$data["status"] = 'success';$data["message"] = "<b class='j-text-color9'>Success!!!</b><br>Request successfully {$status} {$message}";
			}elseif($result === 'fail'){
				$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occurred while running request, try again";
			}
		}
	}else{
		$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occurred while running request, try again";
	}
	echo json_encode($data);
}//end of if empty

?>