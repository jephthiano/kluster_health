<script>
<?php
$js = ['general','message','patient','media','health','medication','chart'];
foreach($js AS $section){require_once(file_location('inc_path',"js/$section.js.php"));}
?>
</script>