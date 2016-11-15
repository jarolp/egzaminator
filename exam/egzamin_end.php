<?php

include('const/header.php');

?>
<?php
include 'log/db.php'; 
?>
<div style="width:800px; margin:0 auto; border:1px solid #000; background-color:#00AE09; text-align:center;">
<br />

<form action="result.php" method="POST">

<?php
mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki
$pytania="SELECT * FROM pytania WHERE id_egzaminu=".$_POST['id_egzaminu'];
$pytania = mysql_query($pytania);

$y=0;
while ($pytania1 = mysql_fetch_assoc($pytania)) {
$y=$y+1;
echo '<fieldset class="fieldset_dane1"><legend class="legend_dane">Pytanie '.$y.'</legend>';
echo '<span class="text_1">'.$pytania1['pytanie'].'</span><br>';

$odpowiedzi ="SELECT * FROM odpowiedzi WHERE id_pytania=".$pytania1['id'];
$odpowiedzi = mysql_query($odpowiedzi);
$odpowiedzi1 = mysql_fetch_assoc($odpowiedzi);

echo '<input type="checkbox" name="'.$pytania1['id'].'_odp1" ><span class="text_3">'.$odpowiedzi1['odp1'].'</span><br>';
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp2" ><span class="text_3">'.$odpowiedzi1['odp2'].'</span><br>';
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp3" ><span class="text_3">'.$odpowiedzi1['odp3'].'</span><br>';
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp4" ><span class="text_3">'.$odpowiedzi1['odp4'].'</span><br>';

echo '</fieldset><br>';
}


echo '<input type="hidden" name="id_egzaminu" value="'.$_POST['id_egzaminu'].'">';
echo '<input type="hidden" name="imie" value="'.$_POST['imie'].'" />';
echo '<input type="hidden" name="nazwisko" value="'.$_POST['nazwisko'].'"  />';
echo '<input type="hidden" name="album" value="'.$_POST['album'].'" />';

?>


<input type="submit" value="Odpowiedz" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" />


</form>


<br />
</div>

<?php

include('const/footer.php');

?>