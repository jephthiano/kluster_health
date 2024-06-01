<?php //MEDIA JS STARTS ?>
<?php if(php_self('/account/edit_profile.enc.php','home')){ ?>
<?php // trigger file upload input ?>
function ti(t){t.trigger('click');}
<?php //change image (if success refresh the img section by getting it with ajax)?>
function ci(i,t){
let f = i.files[0];
if(f){
 let n = i.getAttribute('name');let d = new FormData();d.append(n,f),d.append('t',t);
 $.ajax({type:'POST',url:dar+'act/ci',data:d,cache:false,contentType:false,processData:false,dataType:'JSON'})
 .fail(function(e){r_m2(err_msg+'Error occurred while uploading image');})
 .done(function(s){r_m(s.message);if(s.status==='success'){gepid(t);}})
}else{
 r_m('No file selected');
}
alertoff();
}
<?php } ?>