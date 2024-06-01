<script>
<?php
require_once(file_location('inc_path',"js/general.js.php"));
$js = ['doctor','request','chart'];
foreach($js AS $section){require_once(file_location('doctor_inc_path',"js/$section.js.php"));}
?>
</script>