<?php
require_once(file_location('doctor_inc_path','session_start.inc.php'));
$_SESSION['doctor_id'] = ssl_encrypt_input($doctor_id);
session_regenerate_id();
//COOKIE DATA (REMEMBER ME)
$hdoctor_id = ssl_encrypt_input(addnum($doctor_id));
$cookie_token = random_token();
$h_token = hash_input($cookie_token);
$ipaddress = get_ip_address();
$hdoctor_ip = ssl_encrypt_input($ipaddress);
$cookie_data = $hdoctor_id.":".$cookie_token.":".$hdoctor_ip;
$expiretime = time()+(86400 * 365); // 1 year
//INSERT COOKIE DATA INTO DB AND CREATE DATA
$cookie = new cookie_data('admin');
$cookie->token = $h_token;
$cookie->ipaddress = $ipaddress;
$cookie->expiretime = $expiretime;
$insert = $cookie->insert_doctor_cookie();
if($insert === true){setcookie("_manyanter",$cookie_data,$expiretime,"/","",true,true);}
?>