<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page = "DOCTOR HOME";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('doctor_inc_path','session_check.inc.php'));
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="boy"class=''style="font-family:Roboto,sans-serif;width:100%;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
	<?php
	require_once(file_location('inc_path','page_load.inc.php')); //page loader
	$name = ucwords(content_data('doctor_table','d_fullname',$d_id,'d_id'));
	$status = (content_data('doctor_table','d_status',$d_id,'d_id'));
	$profile_pics = file_location('media_url',get_media('doctor',$d_id));
	?>
	<div class="j-row">
			<?php require_once(file_location('doctor_inc_path','side_bar_1.inc.php')); //first side bar?>
			<div id=""class="j-col m10">
				<?php require_once(file_location('doctor_inc_path','navigation.inc.php'));?>
				<div class="j-main-body">
					<div class="j-hide-small j-hide-medium"style="margin-top:64px;"></div>
					<?php //index header for small and large?>
					<div id="index_header">
						<div class='j-hide-small j-hide-medium'>
							<div class="j-right">
								<div class="j-circle j-color5"style="display:inline-block;padding:12px 12px;margin-right:15px">
									<a href="<?=file_location('home_url','request/')?>">
									<img src="<?=file_location('media_url','home/notification.png')?>"/>
									</a>
								</div>
								<a href="<?=file_location('doctor_url','account/')?>">
								<img src="<?=$profile_pics?>"class='j-right j-circle j-border-2 j-border-color4'style="width:50px;height:50px;"/>
								</a>
							</div>
							<div class='j-xlarge j-text-color7'>Welcome, <span class='j-bolder j-text-color9'>Dr. <?=$name;?></span></div>
							<br>
						</div>
						<div class='j-color9 j-padding j-hide-large j-hide-xlarge'style="height:200px;border-radius:0px 0px 20px 60px">
							<div class='j-padding'>
								<a href="<?=file_location('doctor_url','account/')?>">
								<img src="<?=$profile_pics?>"class='j-right j-circle j-border-2 j-border-color4'style="width:50px;height:50px;"/>
								</a>
							</div><br class='j-clearfix'><br>
							<div class='j-xlarge'><b>Welcome,</b> <br> Dr. <?=$name?></div>
						</div>
						<div class='j-padding'style="margin-top:5px;">
							<div class='j-text-color5 j-large j-bolder'style="margin-bottom:4px;">Notice</div>
							<?php
							if($status === 'pending'){
								?>
								<div class='j-color9 j-paddng-large j-round-large'style="line-height:30px;padding: 26px 24px">
									<div class='j-large j-text-color6 j-bolder'>Your Profile is awaiting confirmation</div>
									<div class='j-text-color4'>Our admin are working on verifying your medical certification</div>
									<div class=''>
										You can complete some account settings in the mean time.
									</div>
								</div>
								<br>
								<?php
							}else{
								?><div>You have <?=$request_counter?> pending request from new patient(s)</div><?php
							}
							?>
							<?php
							//if user has completed profile dont show
							$profession = content_data('doctor_table','d_profession',$d_id,'d_id');
							if($profession === false || empty($profession)){
								?>
								<div class='j-color6 j-paddng-large j-round-large'style="line-height:30px;padding: 26px 24px">
									<div class='j-large j-text-color7 j-bolder'>Complete your profile data</div>
									<div class='j-text-color3'>Some datails are missing in your profile</div>
									<div class='j-center j-margin'>
										<a href="<?=file_location('doctor_url','account/edit_profile')?>">
										<span class='j-text-color5 j-button j-color9'style="padding:5px 24px;border-radius:15px;">Complete Profile</span>
										</a>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
				<br><br><br><br>
			</div>
			<?php require_once(file_location('doctor_inc_path','side_bar_2.inc.php')); //second side bar?>
		</div>
<?php require_once(file_location('doctor_inc_path','js.inc.php'));?>
</body>
</html>