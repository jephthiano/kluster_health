<?php
require_once(file_location('doctor_inc_path','session_start.inc.php'));
//DELETE SESSION
if(isset($_SESSION['doctor_id'])){
    @session_regenerate_id();// regenarate session include destroy_session
    //invalidate the session cookie
    if(isset($_COOKIE[session_name()])){
        $param = session_get_cookie_params();
        setcookie(session_name(),'',time()-86400,$param['path'],$param['domain'],$param['secure'],$param['httponly']); //24hours ago
        unset($_COOKIE[session_name()]);
    }
    //end session and redirect
    $_SESSION['doctor_id'] = [];//empty the $_SESSION array
    unset($_SESSION['doctor_id']);
    session_unset();
    session_destroy();
}
//DELETE BROWSER COOKIE AND STORED COOKIE DATA IN DATABASE
if(isset($_COOKIE['_manyanter'])){
    $cookie = $_COOKIE['_manyanter'];
    list($hdoctor_id,$cookie_token,$hdoctor_ip) = explode(':',$cookie);
    
    if(isset($_SESSION['doctor_id'])){$did = test_input(ssl_decrypt_input($_SESSION['doctor_id']));}else{$did = removenum(ssl_decrypt_input($hdoctor_id));}
    
    $h_token = hash_input($cookie_token);
    $doctor_ip = ssl_decrypt_input($hdoctor_ip);
    //UNSET COOKIE IN USER BROWSER
    setcookie("_manyanter","",time()-3600,"/","",true,true);
}
$cookie_data = new cookie_data('admin');
$cookie_data->token = $h_token;
$cookie_data->ipaddress = $doctor_ip;
$cookie_data->did = $did;
$cookie_data->delete_doctor_cookie('current');
?>