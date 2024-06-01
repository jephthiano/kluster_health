<div class="j-hide-large j-hide-xlarge j-card-4 j-color6 j-fixed-nav" style="margin:0px; font-size:12px;z-index:1">
	<div class="j-row-padding j-center" style="padding: 10px 0px">
		<div class="j-col s3">
			<a id='doctor2'href="<?= file_location('doctor_url','');?>">
			<span class="j-small <?=php_self('/index.php','doctor')?'j-text-color9':'j-text-color7';?>">
				<i class="j-large <?=icon('clinic-medical');?>"style='display:block'></i>Home
			</span>
			</a>
		</div>
		<div class="j-col s3">
			<a id=''href="<?= file_location('doctor_url','patient/');?>"class='j-display-container'style='display:relative;'>
			<span class="j-small <?=php_self('/patient/index.php','doctor')?'j-text-color9':'j-text-color7';?>">
				<i class="j-large <?=icon('pills');?>"style='display:block'></i>Patient
			</span>
			<span class='j-circle j-color9 j-small pat'style='width:20px;height:20px;position:absolute;top:-5px;right:-13px;'><?=$patient_counter?></span>
			</a>
		</div>
		<div class="j-col s3">
			<a id=''href="<?= file_location('doctor_url','request/');?>"class='j-display-container'style='display:relative;'>
			<span class="j-small <?=php_self('/request/index.php','doctor')?'j-text-color9':'j-text-color7';?>">
				<i class="j-large <?=icon('bell');?>"style='display:block'></i>Request
			</span>
			<span class='j-circle j-color9 j-small req'style='width:20px;height:20px;position:absolute;top:-5px;right:-9px;'><?=$request_counter?></span>
			</a>
		</div>
		<div class="j-col s3">
			<a id=''href="<?= file_location('doctor_url','account/');?>"class='j-display-container'style='display:relative;'>
			<span class="j-small <?=php_self('/account/index.php','doctor')?'j-text-color9':'j-text-color7';?>">
				<i class="j-large <?=icon('user-md');?>"style='display:block'></i>Profile
			</span>
			</a>
		</div>
	</div>
</div>