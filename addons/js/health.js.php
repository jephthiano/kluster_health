<?php //HEALTH JS STARTS ?>
<?php if(php_self('/health/index.php','home')){ ?> <?php //Add health condition?>
$(document).ready(function(){
$('#adhcfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Adding','id','adhcbtn');
$.ajax({type:'POST',url:dar+"act/ahc/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_m2(err_msg+'Error occurred while adding data, try again','mdst');r_b('Add','id','adhcbtn');})
.done(function(s){
	if(s.status === 'error'){
		for(let x in s.errors){$('#'+x).html(s.errors[x]);}
	}else{
		if(s.status === 'success'){
			$('#health_form_modal').fadeOut('slow');$('.ip').val('');r_m2(s.message);gepid('hth');
		}else{
		r_m2(s.message,'mdst');
		}
	};r_b('Add','id','adhcbtn');
});alertoff();
})
})
<?php } ?>
<?php if(php_self('/health/medical_professional.enc.php','home')){ ?> <?php //send request?>
function sgr(i,d){
loading('Sending Request','id','srbtn');
$.ajax({type:'GET',url:dar+'act/sgr/'+i+'/'+d+'/',cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_m2(err_msg+'Error occurred while sending request, try again','mdst');r_b('Send Request','id','srbtn');})
.done(function(s){gedd('ill_doc','<?=$raw_val?>');r_m2(s.message);r_b('Send Request','id','srbtn');})
}
<?php } ?>