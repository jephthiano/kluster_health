<?php
require_once(file_location('inc_path','session_start.inc.php'));
$_SESSION['patient_id'] = ssl_encrypt_input($patient_id);
session_regenerate_id();
//COOKIE DATA (REMEMBER ME)
$hpatient_id = ssl_encrypt_input(addnum($patient_id));
$cookie_token = random_token();
$h_token = hash_input($cookie_token);
$ipaddress = get_ip_address();
$hpatient_ip = ssl_encrypt_input($ipaddress);
$cookie_data = $hpatient_id.":".$cookie_token.":".$hpatient_ip;
$expiretime = time()+(86400 * 365); // 1 year
//INSERT COOKIE DATA INTO DB AND CREATE DATA
$cookie = new cookie_data('admin');
$cookie->token = $h_token;
$cookie->ipaddress = $ipaddress;
$cookie->expiretime = $expiretime;
$insert = $cookie->insert_cookie();
if($insert === true){setcookie("_jyualdj",$cookie_data,$expiretime,"/","",true,true);}
?>