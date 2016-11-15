<?php
ob_start();
session_start(); // rozpoczęcie sesji
?>
<?php

include('const/header.php');

?>
<?php
include 'log/db.php'; 
?>

<div style="width:800px; margin:0 auto; border:1px solid #000; background-color:#00AE09; text-align:center;">
<span style="display:block; background:#003300; color:#FFFFFF; font-family:'Courier New', Courier, monospace; font-weight:bold;">&raquo; Podgląd egzaminu &laquo;</span>
<br />

<?php
mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki
$info = "SELECT * FROM egzaminy WHERE id=".$_GET['id'];
$RES = mysql_query($info); // wykonujemy zapytanie
$AFR = mysql_fetch_assoc($RES);

echo "<br /><span class='text_3'>".$AFR['nazwa']."</span><br /><hr />";


$pytania="SELECT * FROM pytania WHERE id_egzaminu=".$_GET['id'];
$pytania = mysql_query($pytania);

$y=0;
while ($pytania1 = mysql_fetch_assoc($pytania)) {
$y=$y+1;
echo '<fieldset class="fieldset_dane1"><legend class="legend_dane">Pytanie '.$y.'</legend>';
echo '<span class="text_1">'.$pytania1['pytanie'].'</span><br>';

$odpowiedzi ="SELECT * FROM odpowiedzi WHERE id_pytania=".$pytania1['id'];
$odpowiedzi = mysql_query($odpowiedzi);
$odpowiedzi1 = mysql_fetch_assoc($odpowiedzi);

if ($odpowiedzi1['odp1_tf'] == 1) {
echo '- <span class="text_2_pop">'.$odpowiedzi1['odp1'].'</span><br>';

} else {
echo '- <span class="text_2">'.$odpowiedzi1['odp1'].'</span><br>';

}
if ($odpowiedzi1['odp2_tf'] == 1) {
echo '- <span class="text_2_pop">'.$odpowiedzi1['odp2'].'</span><br>';

} else {
echo '- <span class="text_2">'.$odpowiedzi1['odp2'].'</span><br>';

}
if ($odpowiedzi1['odp3_tf'] == 1) {
echo '- <span class="text_2_pop">'.$odpowiedzi1['odp3'].'</span><br>';

} else {
echo '- <span class="text_2">'.$odpowiedzi1['odp3'].'</span><br>';

}
if ($odpowiedzi1['odp4_tf'] == 1) {
echo '- <span class="text_2_pop">'.$odpowiedzi1['odp4'].'</span><br>';

} else {
echo '- <span class="text_2">'.$odpowiedzi1['odp4'].'</span><br>';

}


echo '</fieldset><br>';
}
?>
</div>
<?php

include('const/footer.php');

?>