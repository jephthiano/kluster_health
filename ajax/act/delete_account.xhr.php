<?php
if(isset($_POST["pss"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	// validating and sanitizing password
	$pass = ($_POST['pss']);
	if(!password_verify($pass,content_data('patient_table','p_password',$p_id,'p_id'))){$error['psse'] = "* incorrect password";}
	
	if(empty($error)){
		$current_patient = $p_id;
		$patient_pics = get_media('patient',$p_id); // profle pics
		$patient = new patient('admin');
		$patient->id = $p_id;
		$delete = $patient->delete_account();
		if($delete === 'success'){
			//delete profile_pics images
			$profile_full_path = file_location('media_path',$patient_pics);
			if(file_exists($profile_full_path) && $patient_pics !== 'home/avatar.png'){unlink($profile_full_path);}
            require_once(file_location('inc_path','session_destroy.inc.php'));
			$data["status"] = 'success';$data["message"] = "";
		}else{
			$data["status"] = 'fail';$data["message"] = "Error occcur while running request";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>
