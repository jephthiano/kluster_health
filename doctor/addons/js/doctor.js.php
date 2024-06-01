<?php //DOCTOR JS STARTS ?>
<?php if(php_self('/signup.enc.php','doctor')){ ?> <?php //sign up ?>
$(document).ready(function(){
$('#dsgfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Creating Account','id','sgpbtn');
$.ajax({type:'POST',url:ddar+"act/sp/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_m2(err_msg+'Error occurred while creating account, try again');r_b('Sign Up','id','sgpbtn');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){r_m2(s.message);};r_b('Sign Up','id','sgpbtn');}});alertoff();
})
})
<?php } ?>
<?php if(php_self('/login.enc.php','doctor')){ ?> <?php //sign in ?>
$(document).ready(function(){
$('#dlgfrm').on('submit',function(event){event.preventDefault();$('#error').html('');loading('Loggin in','id','lgbtn');
$.ajax({type:'POST',url:ddar+"act/l/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_m2(err_msg+'Error occurred while logging in, try again');r_b('Log In','id','lgbtn');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{r_m2(s.errors);r_b('Log In','id','lgbtn');}});alertoff();
})
})
<?php } ?>
<?php //sign out?>
function sg(){loading('Signing out','id','lobtn');
$.ajax({type:'POST',url:ddar+'act/sg/',cache:false,dataType:'JSON'}).fail(function(e,f,g){r_m2(err_msg+'Error occurred while signing out');r_b('Sign Out','id','lobtn');})
.done(function(s){if(!s.status){r_m(s.message);r_b('Log Out','id','lobtn');}else{window.location=s.message;}})
alertoff();
}
<?php if(php_self('/account/edit_profile.enc.php','doctor')){ ?> <?php //edit profile?>
$(document).ready(function(){
$('#eupfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Saving','id','sppbtn');
$.ajax({type:'POST',url:ddar+"act/upp/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_m('Error occurred while saving data, try again');r_b('Save','id','sppbtn');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){r_m(s.message);};r_b('Save','id','sppbtn');}});alertoff();
})
})
<?php } ?>
<?php if(php_self('/account/password.enc.php','doctor')){ //chnage password?>
$(document).ready(function(){
$('#cpfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Changing Password','id','enpsbtn');
$.ajax({type:'POST',url:ddar+"act/cp/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_m2('');r_b('Change Password');})
.done(function(s){if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{if(s.status === 'success'){$('.pss').val('');}r_m(s.message)};r_b('Change Password');});alertoff();
})
})
<?php } ?>
<?php if(php_self('/account/delete_account.enc.php','doctor')){ //delete account?>
$(document).ready(function(){
$('#ddafrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Deleting Account','id','ddasbtn');
$.ajax({type:'POST',url:ddar+"act/da/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_m2('');r_b('Delete Account','id','ddasbtn');})
.done(function(s){if(s.status === 'success'){window.location='';}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{r_m2(s.message);};r_b('Delete Account','id','ddasbtn');}})
})
})
<?php } ?>