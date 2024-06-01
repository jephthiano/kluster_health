<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
$page_url = file_location('home_url','account/password/');
require_once(file_location('inc_path','session_check.inc.php'));
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page = "PASSWORD";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
?>
<!DOCTYPE html >
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color4"style="font-family: Roboto,sans-serif;width: 100%;"onload="">
    <?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
    <div class="j-row">
		<?php require_once(file_location('inc_path','side_bar_1.inc.php')); //first side bar?>
		<div id=""class="j-col m10">
			<div class="j-main-body">
				<div class=''style="width:100%;">
					<span class='j-hide-large j-hide-xlarge'>
						<?php $header="Password";$back="back"; get_header($header,$back,$menu='','','','j-color1');?>
					</span>
					<div class="j-row">
						<div class="j-col l8 j-color6">
							<div class="j-color1 j-padding j-hide-small j-hide-medium j-top-index"style="position:sticky;top:0;"><?=$header?></div>
							<div class='j-padding'>
                                <form id='cpfrm'method='post'>
                                    <?php
                                    get_form_password('cpbtn','opss','Old Password','','Old Password');//for password input
                                    get_form_password('cpbtn','npss','New Password','','New Password');//for password input
                                    get_form_button('cpbtn','Change Password')// submit button
                                    ?>
                                    <br><br><a class="j-text-color3 j-bolder"href="<?=file_location('home_url','forgot_password/');?>">Forget Your Password?</a><br>
                                </form>
                            </div>
						</div>
						<div class="j-col l4 j-hide-small j-hide-medium">
							<?php require_once(file_location('inc_path','settings.inc.php')); //settings bar?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<?php require_once(file_location('inc_path','side_bar_2.inc.php')); //second side bar?>
		<?php patient_modal('log_out',$p_id);?>
	</div>
<?php require_once(file_location('inc_path','js.inc.php')); ?>
</body>
</html>