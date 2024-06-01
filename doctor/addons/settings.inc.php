<div style="margin-left:16px;">
	<div class="j-color7 j-padding">Settings</div>
	<div class='j-color6'>
		<div>
			<div class=''style='line-heght:30px;'>
			 <div class='j-padding j-round'>
			  <a href="<?= file_location('doctor_url','account/edit_profile/');?>">
			  <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color9 j-xlarge <?=icon('user');?>"></i></div>
			  <div style="display:inline;line-height:15px;">
			   <span class='j-bolder j-text-color7 j-text-color7'>Edit Profile</span>
			   <div class='j-small'style='margin-left:38px;'>Edit your profile information.</div>
			  </div>
			  </a>
			 </div>
			 <div class='j-padding j-round'>
			  <a href="<?= file_location('doctor_url','account/account_security/');?>">
			  <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color9 j-xlarge <?=icon('shield-alt');?>"></i></div>
			  <div style="display:inline;line-height:15px;">
			   <span class='j-bolder j-text-color7'>Account & Security</span>
			   <div class='j-small'style='margin-left:38px;'>Change email, change password, delete account.</div>
			  </div>
			  </a>
			 </div>
			 <div class='j-padding j-round j-clickable'onclick="$('#logout_modal').fadeIn('slow');$('#settings_modal').fadeOut('slow');">
			  <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color8 j-xlarge <?=icon('power-off');?>"></i></div>
			  <div style="display:inline;line-height:15px;">
			   <span class='j-bolder j-text-color8'>Sign Out</span>
			   <div class='j-small j-text-color8'style='margin-left:38px;'>Sign out of your account.</div>
			  </div>
			 </div>
			</div>
		   </div>
	</div>
</div>