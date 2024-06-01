<?php
if(isset($_POST["pemail"]) && isset($_POST["pss"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	if(get_json_data('login','act') == 0 || get_json_data('all','act') == 0){//if checkout and all act is disabled
		$data["status"] = 'error';$data["errors"] = 'Sorry!!!<br> Login is not available at the moment';
	}else{
		// validating and sanitizing email
		$email = ($_POST["pemail"]);
		if(empty($email)){$missing[] = "email";}else{$ademail = test_input($email);}
		
		// validating and sanitizing password
		$password = ($_POST["pss"]);
		if(empty($password) OR strlen($password) < 7){$missing[] = "password";}else{$adpassword = $password;}
		
		if(empty($error) and empty($missing)){
			$patient = new patient('admin');
			$patient->email = $ademail;
			$patient->current_password = $adpassword;
			$patient_id = $patient->authenticate_login();
			//validate login
			if($patient_id == true && is_numeric($patient_id)){
				require_once(file_location('inc_path','session_set.inc.php'));//setting session
				$data["status"] = 'success';$data["message"] = ($_POST["re"]);
			}elseif($patient_id === 'suspended'){
				$data["status"] = 'error';$data["errors"] = "<b class='j-text-color8'>Sorry!!!</b><br>Account has been suspended, contact admin.<br>";
			}elseif($patient_id === false){
				$data["status"] = 'error';$data["errors"] = "<b class='j-text-color8'>Sorry!!!</b><br>Email and Password not match<br>";
			}
		}else{
			$data["status"] = 'error';$data["errors"] = "<b class='j-text-color8'>Sorry!!!</b><br>All fields are required<br>";
		}
	}
	echo json_encode($data);
}//end of if isset
?>