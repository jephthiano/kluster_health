<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('inc_path','session_start.inc.php'));
if(isset($_SESSION['patient_id']) && content_data('patient_table','p_id',test_input(ssl_decrypt_input($_SESSION['patient_id'])),'p_id') !== false
   && content_data('patient_table','p_status',$_SESSION['patient_id'],'p_id') === "active"){
	$GLOBALS['p_id'] = test_input(ssl_decrypt_input($_SESSION['patient_id']));
}elseif(isset($_COOKIE['_jyualdj'])){ // PICK FROM REMEMBER ME COOKIE IF SESSION IS SET
	$cookie = $_COOKIE['_jyualdj'];
	if($cookie !== ""){
		list($hpatient_id,$cookie_token,$hpatient_ip) = explode(':',$cookie);
		$patient_id = removenum(ssl_decrypt_input($hpatient_id));
		$h_token = hash_input($cookie_token);
		$patient_ip = ssl_decrypt_input($hpatient_ip);
		// create connection
		require_once(file_location('inc_path','connection.inc.php'));
		@$conn = dbconnect('admin','PDO');
		$sql = "SELECT cd_expiretime FROM patient_cookie_data_table
		WHERE p_id = :id AND cd_token = :token AND cd_ipaddress = :ipaddress
		LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':id',$patient_id,PDO::PARAM_STR);
		$stmt->bindParam(':token',$h_token,PDO::PARAM_STR);
		$stmt->bindParam(':ipaddress',$patient_ip,PDO::PARAM_STR);
		$stmt->bindColumn('cd_expiretime',$time);
		$stmt->execute();
		$numRow = $stmt->rowCount();
		if($numRow > 0){
			while($stmt->fetch()){
				if($time >= time()){
               // no chance for suspended users || false user
					if(content_data('patient_table','p_status',$patient_id,'p_id') === "suspended" || content_data('patient_table','p_id',$patient_id,'p_id') === false){
						require_once(file_location('inc_path','session_destroy.inc.php'));
						require_once(file_location('inc_path','session_redirection.inc.php'));
					}
					$_SESSION['patient_id'] = ssl_encrypt_input($patient_id);
					$GLOBALS['p_id'] = test_input(ssl_decrypt_input($_SESSION['patient_id']));
				}else{ // if the time has expired
					require_once(file_location('inc_path','session_destroy.inc.php'));
					require_once(file_location('inc_path','session_redirection.inc.php'));
				}
			}// end of while
		}else{ // if authentication is not true
			require_once(file_location('inc_path','session_destroy.inc.php'));
			require_once(file_location('inc_path','session_redirection.inc.php'));
		}
	}else{// if cookie is false
		require_once(file_location('inc_path','session_destroy.inc.php'));
		require_once(file_location('inc_path','session_redirection.inc.php'));
	}
}else{
	require_once(file_location('inc_path','session_destroy.inc.php'));
	require_once(file_location('inc_path','session_redirection.inc.php'));
}
?>