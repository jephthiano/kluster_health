<div class="j-hide-large j-hide-xlarge j-card-4 j-color6 j-fixed-nav" style="margin:0px; font-size:12px;z-index:1">
	<div class="j-row-padding j-center" style="padding: 10px 0px">
		<div class="j-col s3">
			<a id='home2'href="<?= file_location('home_url','');?>">
			<span class="j-small <?=php_self('/index.php','home')?'j-text-color1':'j-text-color7';?>">
				<i class="j-large <?=icon('clinic-medical');?>"style='display:block'></i>Home
			</span>
			</a>
		</div>
		<div class="j-col s3">
			<a id=''href="<?= file_location('home_url','health/');?>"class='j-display-container'style='display:relative;'>
			<span class="j-small <?=php_self('/health/index.php','home')?'j-text-color1':'j-text-color7';?>">
				<i class="j-large <?=icon('pills');?>"style='display:block'></i>Medications
			</span>
			</a>
		</div>
		<div class="j-col s3">
			<a id=''href="<?= file_location('home_url','reminders/');?>"class='j-display-container'style='display:relative;'>
			<span class="j-small <?=php_self('/reminders/index.php','home')?'j-text-color1':'j-text-color7';?>">
				<i class="j-large <?=icon('clock');?>"style='display:block'></i>Reminders
			</span>
			</a>
		</div>
		<div class="j-col s3">
			<a id=''href="<?= file_location('home_url','account/');?>"class='j-display-container'style='display:relative;'>
			<span class="j-small <?=php_self('/account/index.php','home')?'j-text-color1':'j-text-color7';?>">
				<i class="j-large <?=icon('user');?>"style='display:block'></i>Profile
			</span>
			</a>
		</div>
	</div>
</div>