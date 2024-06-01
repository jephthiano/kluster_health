<?php //REQUEST JS STARTS ?>
<?php if(php_self('/request/index.php','doctor')){ ?> <?php //return quidance request?>
function rgr(s,i){
if(s === 'accepted'){var id = 'acbtn';var btn = 'Accept';}else{var id = 'rebtn';var btn = 'Reject';}loading('','id',id);
$.ajax({type:'GET',url:ddar+'act/rgr/'+s+'/'+i+'/',cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_m2(err_msg+'Error occurred while sending, try again','mdst');r_b(btn,'id',id);})
.done(function(s){gepid('pati',<?=addnum($d_id)?>);r_m2(s.message);r_b(btn,'id',id);if(s.status = 'success'){genr('req',<?=addnum($d_id)?>);genr('pat',<?=addnum($d_id)?>)}})
}
<?php } ?>