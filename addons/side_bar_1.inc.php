<div class="j-col m1 min-height j-hide-small j-hide-large j-hide-xlarge j-border-color6 dmb6"style="border-right:solid 2px ;"></div>
<div class="j-hide-small j-hide-medium">
	<nav class="j-side-nav">
		<div>
			<div style="height:120px;border-bottom:1px solid black;">
				<div class="j-xxlarge j-center j-italic j-text-color1"style="padding-top:35px;">KlusterHealth</div>
			</div>
			<div style="padding: 2rem 1rem;">
            <div class="j-nav-structure <?=(php_self('/index.php','home'))?"j-nav-current":"";?>">
				<a href="<?=file_location('home_url','')?>"class="j-nav-btn"><img src="<?=file_location('media_url','home/home-2.png')?>"/> Home</a>
			</div>
            <div class="j-nav-structure <?=(php_self('/health/index.php','home'))?"j-nav-current":"";?>">
				<a href="<?=file_location('home_url','health/')?>"class="j-nav-btn"><img src="<?=file_location('media_url','home/medication_icon.png')?>"/> My Medications</a>
			</div>
            <div class="j-nav-structure <?=(php_self('/reminders/index.php','home'))?"j-nav-current":"";?>">
				<a href="<?=file_location('home_url','reminders/')?>"class="j-nav-btn"><img class="adherence" src="<?=file_location('media_url','home/monitor.png')?>"/>Reminders</a>
			</div>
            <div class="j-nav-structure <?=(php_self('/account/medical_professional.enc.php','home'))?"j-nav-current":"";?>">
				<a href="<?=file_location('home_url','account/medical_professional/')?>"class="j-nav-btn"><img src="<?=file_location('media_url','home/medication_icon.png')?>"/>Medical Professionals</a>
			</div>
        </div>
		</div>
		<a href="<?=file_location('home_url','account/')?>">
		<div class=""style="padding:32px 16px;border-top:1px solid #7b7b7b;">
			<div class="j-nav-bottom"style="position:fixed;bottom:20px;width:300px;">
				<span style="margin-right:10px;"><img src="<?=file_location('media_url',get_media('patient',$p_id))?>"class='j-circle j-border-2 j-border-color4'style="width:50px;height:50px;"/></span>
				<div style="line-height:23px;"><div class="j-bolder j-text-color7"><?=ucwords(content_data('patient_table','p_fullname',$p_id,'p_id'))?></div><div><?=content_data('patient_table','p_email',$p_id,'p_id')?></div></div>
			</div>
		</div>
		</a>
	</nav>
</div>
<span id='st'></span>