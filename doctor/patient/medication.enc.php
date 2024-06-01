<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('doctor_inc_path','session_check.inc.php'));
if(isset($_GET['val'])){
	$raw_val = test_input(removenum($_GET['val']));
	if(!empty($raw_val)){
		$pmd_id = content_data('patient_medication_table','pmd_id',$raw_val,'pmd_id');
		$ph_id = content_data('patient_medication_table','ph_id',$pmd_id,'pmd_id');
		$p_id = content_data('patient_medication_table','p_id',$pmd_id,'pmd_id');
		$doctor_id = content_data('guidance_request_table','gr_id',$ph_id,'ph_id',"AND d_id = {$d_id} AND p_id = {$p_id}");
		if($ph_id === false || $doctor_id === false){
			trigger_error_manual(404);
		}
	}else{
		trigger_error_manual(404);
	}
}else{
	trigger_error_manual(404);
}
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page = "MeDICATION";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title>
<script src="<?=file_location('home_url','plugins/google_chart.js');?>"></script>
</head>
<body id="boy"class=''style="font-family:Roboto,sans-serif;width:100%;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
	<div class="j-row">
			<?php require_once(file_location('doctor_inc_path','side_bar_1.inc.php')); //first side bar?>
			<div id=""class="j-col m10">
				<?php require_once(file_location('doctor_inc_path','navigation.inc.php'));?>
				<div class="j-main-body">
					<?php
					$status = (content_data('doctor_table','d_status',$d_id,'d_id'));
					if($status === 'pending'){
						?>
						<div class='j-paddng-large j-round-large j-color6 j-margin'style="line-height:30px;padding: 26px 24px">
							<div class='j-large j-text-color8 j-bolder'>Your Profile is awaiting confirmation</div>
							<div class='j-text-color8'>Our admin are working on verifying your medical certification</div>
							<div class=''>
								You can complete some account settings in the mean time.
							</div>
						</div>
						<br>
						<?php
					}else{
						$med = content_data('patient_medication_table','pmd_name',$pmd_id,'pmd_id');
						?>
						<div class=''style="width:100%;">
							<span class='j-hide-large j-hide-xlarge'>
								<?php $header="{$med} Data";$back="back"; get_header($header,$back,$menu='','','','j-color9'); ?>
							</span>
							<div class="j-row">
								<div class="j-col l8 j-color6">
									<div class="j-color9 j-padding j-hide-small j-hide-medium j-top-index"style="position:sticky;top:0;"><?=$header?></div>
									<div class=''>
										<div id="med"class="">
											<?php patient_section_data('medication',$pmd_id,'doctor');?>
										</div>
										<br>
									</div>
								</div>
								<div class="j-col l4 j-hide-small j-hide-medium">
									<div style="margin-left:16px;max-height:600px;overflow-y:scroll;">
										<div class="j-color7 j-padding">Track Adherence Data</div>
										<div>
											<?php
											$pma_id_array = multiple_content_data('patient_adherence_table','pma_id',$p_id,'p_id',"AND pmd_id = $pmd_id ORDER BY pma_id DESC");
											if($pma_id_array === false){
												?><div class="j-center ">No adherence data is available at the moment</div><?php
											}else{
												get_adherence_data($pma_id_array,'short');
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<br><br><br><br>
			</div>
			<?php require_once(file_location('doctor_inc_path','side_bar_2.inc.php')); //second side bar?>
		</div>
<?php require_once(file_location('doctor_inc_path','js.inc.php'));?>
</body>
</html>