<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "LOGIN | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','login');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
$company_name = get_xml_data('company_name');
?>
<!DOCTYPE html >
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name;?></title></head>
<body style='font-family:Roboto,sans-serif;width:100%;'>
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
	<center>
		<br><br>
		<div class="j-round j-panel j-border j-border-color5"style="width:100%;max-width:400px;height:auto;">
			<br><br>
			<span class="j-text-color1 j-large"style=''>
				<a href='<?=file_location('home_url','')?>'>
				<p class="logo j-bolder">KlusterHealth</p>
				</a>
				<b class='j-bolder j-xlarge j-text-color7'>PATIENT LOGIN</b>
			</span><br>
			<form id='plgfrm'onsubmit="event.preventDefault();">
				<br>
				<?php
				$re = isset($_GET['re'])?($_GET['re']):file_location('home_url','');
				get_form_type('email','pemail','lgbtn','Email','','3','70');//for email input
				get_form_password('lgbtn');//for password input
				get_form_hidden('re',$re);//for hidden id value
				?>
				<a class="j-right j-text-color3 j-bolder"href="<?=file_location('home_url','forgot_password/');?>">Forget Your Password?</a><br class='j-clearfix'><br>
				<?php get_form_button('lgbtn','Log In','')// submit button ?>
				<br><br>
				<center><a class="j-text-color7 j-center j-bolder"href="<?= file_location('home_url','signup/');?>">Not a member? Sign Up</a></center>
				<br><br><br>
			</form>
			<br>
		</div>
	</center>
	<span id='st'></span>
<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>