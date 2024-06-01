<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "SIGN UP | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','signup/');
?>
<!DOCTYPE html >
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name;?></title></head>
<body class='j-color4'style='font-family:Roboto,sans-serif;width:100%;'>
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
	<br><br>
	<center>
	<div class="j-round j-panel j-border j-border-color5"style="width:100%;max-width:400px;height:auto;">
		<br><br>
		<center>
			<span class="j-text-color1 j-large"style=''>
				<a href='<?=file_location('home_url','')?>'>
				<p class="logo j-bolder">KlusterHealth</p>
				</a>
				<b class='j-bolder j-xlarge j-text-color7'>PATIENT SIGN UP</b>
			</span><br>
		</center>
		<form id='sgfrm'method='post'>
			<br>
			<?php
			get_form_type('email','ema','sgpbtn','Email','','1','70');//for email input
			get_form_type('text','fnm','sgpbtn','Fullname','','3','30');//for fullname input
			get_form_password('sgpbtn');//for password input
			get_form_button('sgpbtn','Sign Up','')// submit button
			?>
		</form>
		<br>
		<center><a class="j-text-color3 j-center j-bolder"href="<?= file_location('home_url','login/');?>">Already a member? Login In</a></center>
		<br><br><br>
	</div>
	</center>
	<span id='st'></span>
<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>