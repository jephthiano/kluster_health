<?php
if(isset($_POST["demail"]) && isset($_POST["pss"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	// validating and sanitizing email
	$email = ($_POST["demail"]);
	if(empty($email)){$missing[] = "email";}else{$ademail = test_input($email);}
	
	// validating and sanitizing password
	$password = ($_POST["pss"]);
	if(empty($password) OR strlen($password) < 7){$missing[] = "password";}else{$adpassword = $password;}
		
	if(empty($error) and empty($missing)){
		$doctor = new doctor('admin');
		$doctor->email = $ademail;
		$doctor->current_password = $adpassword;
		$doctor_id = $doctor->authenticate_login();
		//validate login
		if($doctor_id == true && is_numeric($doctor_id)){
			require_once(file_location('doctor_inc_path','session_set.inc.php'));//setting session
			$data["status"] = 'success';$data["message"] = ($_POST["re"]);
		}elseif($doctor_id === 'suspended'){
			$data["status"] = 'error';$data["errors"] = "<b class='j-text-color8'>Sorry!!!</b><br>Account has been suspended, contact admin.<br>";
		}elseif($doctor_id === false){
			$data["status"] = 'error';$data["errors"] = "<b class='j-text-color8'>Sorry!!!</b><br>Email and Password not match<br>";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = "<b class='j-text-color8'>Sorry!!!</b><br>All fields are required<br>";
	}
	echo json_encode($data);
}//end of if isset
?>