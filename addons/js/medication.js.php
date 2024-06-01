<?php //MEDICATION JS STARTS ?>
<?php if(php_self('/health/health_condition.enc.php','home')){ ?> <?php //Add health condition?>
$(document).ready(function(){
$('#admdfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Adding Medication','id','admdbtn');
$.ajax({type:'POST',url:dar+"act/amd/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_m2(err_msg+'Error occurred while adding medication data, try again','mdst');r_b('Add Medication','id','admdbtn');})
.done(function(s){
	if(s.status === 'error'){
		for(let x in s.errors){$('#'+x).html(s.errors[x]);}
	}else{
		if(s.status === 'success'){
			$('#med_form_modal').fadeOut('slow');$('.ip').val('');r_m2(s.message);gepid('hth_con','<?=addnum($ph_id)?>');
		}else{
			r_m2(s.message,'mdst');
		}
	};r_b('Add Medication','id','admdbtn');
});alertoff();
})
})
<?php //delete guidance request?>
function dgr(t,i){var ld; var btn_val; var id;
if(t === 'remove'){ld = 'Removing';btn_val = 'Remove';id='rvbtn';}else{ld = 'Cancelling';btn_val = 'Cancel Request';id='cnbtn';} loading(ld,'id',id);
$.ajax({type:'GET',url:dar+'act/dgr/'+t+'/'+i+'/',cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_m2(err_msg+'Error occurred while running request, try again');r_b(btn_val,'id',id);})
.done(function(s){gedd('mcd',<?=addnum($ph_id)?>);r_m2(s.message);r_b(btn_val,'id',id);})
}
<?php } ?>
<?php if(php_self('/index.php','home') || php_self('/reminders/index.php','home') || php_self('/health/medication.enc.php','home')){ ?> <?php //Add health condition?>
function ca(i,s,t){$.ajax({type:'GET',url:dar+'act/ca/'+s+'/'+i,cache:false,dataType:'JSON'}).fail(function(e,f,g){r_m2(err_msg+'Error occurred while confirming adherence data, try again');}).done(function(s){gepid(t,i);r_m2(s.message);})}
<?php } ?>