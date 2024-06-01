<?php if(php_self('/health/medication.enc.php','home')){ //show pie chart
$total_taken = get_numrow('patient_adherence_table','pmd_id',$pmd_id,"return",'no round',"AND pma_status = 'taken'");
$total_missed = get_numrow('patient_adherence_table','pmd_id',$pmd_id,"return",'no round',"AND pma_status = 'missed'");
?>
var chartD ;
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart(){
const data = google.visualization.arrayToDataTable([<?="['Adherence','Data'],['Taken',{$total_taken}],['Missed',$total_missed]"?>]);<?php  // Set Data?>
const options = {title:'Adherence Data Chart',is3D:true};<?php // Set Options?>
<?php // Draw?>
const chart = new google.visualization.PieChart(document.getElementById('myChart'));
chart.draw(data, options);
}
<?php } ?>