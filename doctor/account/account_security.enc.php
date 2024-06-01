<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page = "ACCOUNT & SECURITY";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('doctor_inc_path','session_check.inc.php'));
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class='j-color4'style="font-family:Roboto,sans-serif;width:100%;"onload="">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
	<div class="j-row">
		<?php require_once(file_location('doctor_inc_path','side_bar_1.inc.php')); //first side bar?>
		<div id=""class="j-col m10">
			<?php require_once(file_location('doctor_inc_path','navigation.inc.php'));?>
			<div class="j-main-body">
				<div class=''style="width:100%;">
					<span class='j-hide-large j-hide-xlarge'>
						<?php
						$header="Account & Security";$back="back"; get_header($header,$back,$menu='','','','j-color9');
						?>
					</span>
					<div class="j-row">
						<div class="j-col l8">
							<div class="j-color9 j-padding j-hide-small j-hide-medium j-top-index"style="position:sticky;top:0;"><?=$header?></div>
							<div class=''>
								<div class='j-padding j-card j-border j-border-color5 j-round j-margin'>
                                    <a href="<?= file_location('doctor_url','account/email/');?>">
                                    <div style="display:inline-block;width:35px;position:relative;top:10px;"><i class="j-text-color9 j-xlarge <?=icon('envelope');?>"></i></div>
                                    <div style="display:inline;line-height:15px;">
                                        <span class='j-bolder j-text-color7'>Email</span>
                                        <div class='j-small'style='margin-left:40px;'>Update your email.</div>
                                    </div>
                                    </a>
                                </div>
                                <div class='j-padding j-card j-border j-border-color5 j-round j-margin'>
                                    <a href="<?= file_location('doctor_url','account/mobile_number/');?>">
                                    <div style="display:inline-block;width:35px;position:relative;top:10px;"><i class="j-text-color9 j-xlarge <?=icon('mobile');?>"></i></div>
                                    <div style="display:inline;line-height:15px;">
                                        <span class='j-bolder j-text-color7'>Mobile Number</span>
                                        <div class='j-small'style='margin-left:40px;'>Add or update your mobile number.</div>
                                    </div>
                                    </a>
                                </div>
                                <div class='j-padding j-card j-border j-border-color5 j-round j-margin'>
                                    <a href="<?= file_location('doctor_url','account/password/');?>">
                                    <div style="display:inline-block;width:35px;position:relative;top:10px;"><i class="j-text-color9 j-xlarge <?=icon('lock');?>"></i></div>
                                    <div style="display:inline;line-height:15px;">
                                        <span class='j-bolder j-text-color7'>Password</span>
                                        <div class='j-small'style='margin-left:40px;'>Change your password.</div>
                                    </div>
                                    </a>
                                </div>
                                <div class='j-padding j-card j-border j-border-color5 j-round j-margin j-clickable'>
                                    <a href="<?= file_location('doctor_url','account/delete_account/');?>">
                                    <div class='j-center'>
                                        <span class='j-text-color8'>Delete Account</span>
                                    </div>
                                    </a>
                                </div>
							</div>
						</div>
						<div class="j-col l4 j-hide-small j-hide-medium">
							<?php require_once(file_location('doctor_inc_path','settings.inc.php')); //settings bar?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<?php require_once(file_location('doctor_inc_path','side_bar_2.inc.php')); //second side bar?>
		<?php doctor_modal('log_out',$d_id);doctor_modal('settings',$d_id)?>
	</div>
	<?php require_once(file_location('doctor_inc_path','js.inc.php'));?>
</body>
</html>