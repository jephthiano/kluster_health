<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$page = "NOT FOUND";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class=""style="font-family: Roboto,sans-serif;width:100%;">
    <?php page_not_available('short');?>
    <?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>