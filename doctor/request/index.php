<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page = "REQUEST";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('doctor_inc_path','session_check.inc.php'));
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="boy"class=''style="font-family:Roboto,sans-serif;width:100%;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
	<div class="j-row">
			<?php require_once(file_location('doctor_inc_path','side_bar_1.inc.php')); //first side bar?>
			<div id=""class="j-col m10">
				<?php require_once(file_location('doctor_inc_path','navigation.inc.php'));?>
				<div class="j-main-body">
					<div class='j-color4'style="width:100%;max-width:800px">
						<?php $header="Request <span>(<span class='req'>{$request_counter}</span>)</span>";$back="hide"; get_header($header,$back,'','','','j-color9');?>
						<?php
						$status = (content_data('doctor_table','d_status',$d_id,'d_id'));
						if($status === 'pending'){
							?>
							<div class='j-paddng-large j-round-large j-color6 j-margin'style="line-height:30px;padding: 26px 24px">
								<div class='j-large j-text-color8 j-bolder'>Your Profile is awaiting confirmation</div>
								<div class='j-text-color8'>Our admin are working on verifying your medical certification</div>
								<div class=''>You can complete some account settings in the mean time.</div>
							</div>
							<br>
							<?php
						}else{
							?><div id='pati'><?php patient_section_data('patient',$d_id);?></div><?php
						}
						?>
					</div>
				</div>
				<br><br><br><br>
			</div>
			<?php require_once(file_location('doctor_inc_path','side_bar_2.inc.php')); //second side bar?>
		</div>
<?php require_once(file_location('doctor_inc_path','js.inc.php'));?>
</body>
</html>