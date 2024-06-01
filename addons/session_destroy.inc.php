<?php
require_once(file_location('inc_path','session_start.inc.php'));
//DELETE SESSION
if(isset($_SESSION['patient_id'])){
    @session_regenerate_id();// regenarate session include destroy_session
    //invalidate the session cookie
    if(isset($_COOKIE[session_name()])){
        $param = session_get_cookie_params();
        setcookie(session_name(),'',time()-86400,$param['path'],$param['domain'],$param['secure'],$param['httponly']); //24hours ago
        unset($_COOKIE[session_name()]);
    }
    //end session and redirect
    $_SESSION['patient_id'] = [];//empty the $_SESSION array
    unset($_SESSION['patient_id']);
    session_unset();
    session_destroy();
}
//DELETE BROWSER COOKIE AND STORED COOKIE DATA IN DATABASE
if(isset($_COOKIE['_jyualdj'])){
    $cookie = $_COOKIE['_jyualdj'];
    list($hpatient_id,$cookie_token,$hpatient_ip) = explode(':',$cookie);
    
    if(isset($_SESSION['patient_id'])){$pid = test_input(ssl_decrypt_input($_SESSION['patient_id']));}else{$pid = removenum(ssl_decrypt_input($hpatient_id));}
    
    $h_token = hash_input($cookie_token);
    $patient_ip = ssl_decrypt_input($hpatient_ip);
    //UNSET COOKIE IN USER BROWSER
    setcookie("_jyualdj","",time()-3600,"/","",true,true);
}
$cookie_data = new cookie_data('admin');
$cookie_data->token = $h_token;
$cookie_data->ipaddress = $patient_ip;
$cookie_data->pid = $pid;
$cookie_data->delete_cookie('current');
?>