<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('doctor_inc_path','session_start.inc.php'));
if(isset($_SESSION['doctor_id']) && content_data('doctor_table','d_id',test_input(ssl_decrypt_input($_SESSION['doctor_id'])),'d_id') !== false
   && content_data('doctor_table','d_status',test_input(ssl_decrypt_input($_SESSION['doctor_id'])),'d_id') !== "suspended"){
	$GLOBALS['d_id'] = test_input(ssl_decrypt_input($_SESSION['doctor_id']));
}elseif(isset($_COOKIE['_manyanter'])){ // REMEMBER ME COOKIE
	$cookie = $_COOKIE['_manyanter'];
	if($cookie !== ""){
		list($hdoctor_id,$cookie_token,$hdoctor_ip) = explode(':',$cookie);
		$doctor_id = removenum(ssl_decrypt_input($hdoctor_id));
		$h_token = hash_input($cookie_token);
		$doctor_ip = ssl_decrypt_input($hdoctor_ip);
		// create connection
		require_once(file_location('inc_path','connection.inc.php'));
		@$conn = dbconnect('admin','PDO');
		$sql = "SELECT cd_expiretime FROM doctor_cookie_data_table
		WHERE d_id = :id AND cd_token = :token AND cd_ipaddress = :ipaddress
		LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':id',$doctor_id,PDO::PARAM_STR);
		$stmt->bindParam(':token',$h_token,PDO::PARAM_STR);
		$stmt->bindParam(':ipaddress',$doctor_ip,PDO::PARAM_STR);
		$stmt->bindColumn('cd_expiretime',$time);
		$stmt->execute();
		$numRow = $stmt->rowCount();
		if($numRow > 0){
			while($stmt->fetch()){
				if($time >= time()){
               // no chance for suspended users || false user
					if(content_data('doctor_table','d_status',$doctor_id,'d_id') === "suspended" || content_data('doctor_table','d_id',$doctor_id,'d_id') === false){
						require_once(file_location('doctor_inc_path','session_destroy.inc.php'));
						require_once(file_location('doctor_inc_path','session_redirection.inc.php'));
					}
					$_SESSION['doctor_id'] = ssl_encrypt_input($doctor_id);
					$GLOBALS['d_id'] = test_input(ssl_decrypt_input($_SESSION['doctor_id']));
				}else{ // if the time has expired
					require_once(file_location('doctor_inc_path','session_destroy.inc.php'));
					require_once(file_location('doctor_inc_path','session_redirection.inc.php'));					
				}
			}// end of while
		}else{ // if authentication is not true
			require_once(file_location('doctor_inc_path','session_destroy.inc.php'));
			require_once(file_location('doctor_inc_path','session_redirection.inc.php'));
		}
	}else{// if cookie is false
		require_once(file_location('doctor_inc_path','session_destroy.inc.php'));
		require_once(file_location('doctor_inc_path','session_redirection.inc.php'));
	}
}else{
	$GLOBALS['d_id'] = "";
}
?>