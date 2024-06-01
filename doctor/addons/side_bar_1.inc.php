<div class="j-col m1 min-height j-hide-small j-hide-large j-hide-xlarge j-border-color6 dmb6"style="border-right:solid 2px ;"></div>
<div class="j-hide-small j-hide-medium">
	<?php
	$request_counter = get_numrow('guidance_request_table','gr_status','pending',"return",'no round',"AND d_id = {$d_id}");
	if($request_counter > 9){$request_counter = "9+";}
	$patient_counter = distinct_numrow('guidance_request_table','p_id','gr_status','accepted',"return",'no round',"AND d_id = {$d_id}");
	if($patient_counter > 9){$patient_counter = "9+";}
	?>
	<nav class="j-side-nav">
		<div>
			<div style="height:120px;border-bottom:1px solid black;">
				<div class="j-xxlarge j-center j-italic j-text-color1"style="padding-top:35px;">KlusterHealth</div>
			</div>
			<div style="padding: 2rem 1rem;">
            <div class="j-nav-structure <?=(php_self('/index.php','home'))?"j-nav-current":"";?>">
				<a href="<?=file_location('doctor_url','')?>"class="j-nav-btn"><img src="<?=file_location('media_url','home/home-2.png')?>"/> Home</a>
			</div>
            <div class="j-nav-structure <?=(php_self('/patient/index.php','home'))?"j-nav-current":"";?>">
				<a href="<?=file_location('doctor_url','patient/')?>"class="j-nav-btn"><img src="<?=file_location('media_url','home/medication_icon.png')?>"/>
				Patients <span>(<span class='pat'><?=$patient_counter?></span>)</span>
				</a>
			</div>
            <div class="j-nav-structure <?=(php_self('/request/index.php','home'))?"j-nav-current":"";?>">
				<a href="<?=file_location('doctor_url','request/')?>"class="j-nav-btn"><img class="adherence" src="<?=file_location('media_url','home/monitor.png')?>"/>
				Requests <span>(<span class='req'><?=$request_counter?></span>)</span>
				</a>
			</div>
        </div>
		</div>
		<a href="<?=file_location('doctor_url','account/')?>">
		<div class="j-nav-bottom"style="padding:32px 16px;border-top:1px solid #7b7b7b;">
			<span style="margin-right:10px;"><img src="<?=file_location('media_url',get_media('doctor',$d_id))?>"class='j-circle j-border-2 j-border-color4'style="width:50px;height:50px;"/></span>
			<div style="line-height:23px;"><div class="j-bolder j-text-color7"><?=ucwords(content_data('doctor_table','d_fullname',$d_id,'d_id'))?></div><div><?=content_data('doctor_table','d_email',$d_id,'d_id')?></div></div>
		</div>
		</a>
	</nav>
</div>
<span id='st'></span>