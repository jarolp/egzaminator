<?php

include('const/header.php');

?>
<?php
include 'log/db.php'; 
?>
<div style="width:800px; margin:0 auto; border:1px solid #000; background-color:#00AE09; text-align:center;">
<br />


<br /><br />
<?php


mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki
$pytania="SELECT * FROM pytania WHERE id_egzaminu=".$_POST['id_egzaminu'];
$pytania = mysql_query($pytania);
$ilosc_wierszy = mysql_num_rows($pytania);

$a = 0;

while ($pytania1 = mysql_fetch_assoc($pytania)) {

$odpowiedzi ="SELECT * FROM odpowiedzi WHERE id_pytania=".$pytania1['id'];
$odpowiedzi = mysql_query($odpowiedzi);
$odpowiedzi1 = mysql_fetch_assoc($odpowiedzi);

//echo $pytania1['id'];


if (($_POST[$pytania1['id'].'_odp1'] && $_POST[$pytania1['id'].'_odp2']) || ($_POST[$pytania1['id'].'_odp1'] && $_POST[$pytania1['id'].'_odp3']) || ($_POST[$pytania1['id'].'_odp1'] && $_POST[$pytania1['id'].'_odp4']) || ($_POST[$pytania1['id'].'_odp2'] && $_POST[$pytania1['id'].'_odp3']) || ($_POST[$pytania1['id'].'_odp2'] && $_POST[$pytania1['id'].'_odp4']) || ($_POST[$pytania1['id'].'_odp3'] && $_POST[$pytania1['id'].'_odp4']) || ($_POST[$pytania1['id'].'_odp1'] && $_POST[$pytania1['id'].'_odp2'] && $_POST[$pytania1['id'].'_odp3']) || ($_POST[$pytania1['id'].'_odp1'] && $_POST[$pytania1['id'].'_odp2'] && $_POST[$pytania1['id'].'_odp4']) || ($_POST[$pytania1['id'].'_odp1'] && $_POST[$pytania1['id'].'_odp3'] && $_POST[$pytania1['id'].'_odp4']) || ($_POST[$pytania1['id'].'_odp2'] && $_POST[$pytania1['id'].'_odp3'] && $_POST[$pytania1['id'].'_odp4']) || ($_POST[$pytania1['id'].'_odp1'] && $_POST[$pytania1['id'].'_odp2'] && $_POST[$pytania1['id'].'_odp3'] && $_POST[$pytania1['id'].'_odp4'])) {

//echo "za duzo zaznaczeń";
$a=$a-1;
} else {

if ($_POST[$pytania1['id'].'_odp1']){
$data = $pytania1['id']."_odp1";
$tablica = explode("_", $data);
} elseif ($_POST[$pytania1['id'].'_odp2']) {
$data = $pytania1['id']."_odp2";
$tablica = explode("_", $data);
} elseif ($_POST[$pytania1['id'].'_odp3']) {
$data = $pytania1['id']."_odp3";
$tablica = explode("_", $data);
} elseif ($_POST[$pytania1['id'].'_odp4']) {
$data = $pytania1['id']."_odp4";
$tablica = explode("_", $data);
} else {
echo "";
}


//echo "-";

	if (!$_POST[$pytania1['id'].'_odp1'] && !$_POST[$pytania1['id'].'_odp2'] && !$_POST[$pytania1['id'].'_odp3'] && !$_POST[$pytania1['id'].'_odp4']) {
	$a=$a;
	} else {
	
	
	$odp_podana =  mysql_query("SELECT ".$tablica[1]."_tf FROM odpowiedzi WHERE id_pytania=".$pytania1['id']);
	$odp_podana1 = mysql_fetch_assoc($odp_podana);
	//echo $odp_podana1[$tablica[1].'_tf'];
	
	
		if ($odp_podana1[$tablica[1].'_tf'] == 1) {
		$a=$a+1;
		
		} else {
		
		$a=$a;
		
		}
	}
}
}


echo '<table border=0 bordercolor="#fff" cellpadding="2" cellspacing="0" style="margin:0 auto;">';
echo '<tr><td width=350 align=right><span class="text_4">Poprawne odpowiedzi: </span></td><td width=180 align=left><span class="text_1">'.$a.'</span></td></tr>';
echo '<tr><td align=right><span class="text_4">Wszystkich pytań: </span></td><td align=left><span class="text_1">'.$ilosc_wierszy.'</span></td></tr>';


$wynik = ($a/$ilosc_wierszy)*100;
$wynik = round($wynik, 2);

if ($wynik>=50 && $wynik<60) {
$ocena = '3';
} elseif ($wynik>=60 && $wynik<70) {
$ocena = '3+';
} elseif ($wynik>=70 && $wynik<80) {
$ocena = '4';
} elseif ($wynik>=80 && $wynik<90) {
$ocena = '4+';
} elseif ($wynik>=90 && $wynik<=100) {
$ocena = '5';
} else {
$ocena = '2';
}



echo '<tr><td align=right><span class="text_4">Poprawne odpowiedzi wynoszą: </span></td><td align=left><span class="text_1">'.$wynik.'%</span></td></tr>';
echo '<tr><td align=right><span class="text_4">Uzyskana ocena: </span></td><td align=left><span class="text_5">'.$ocena.'</span></td></tr>';

echo '</table>';


$wynik_do_bazy = "INSERT INTO wyniki (id_egzaminu, ocena, procent, l_pop_odp, l_wsz_odp, imie_stud, nazwisko_stud, album) VALUES ('".$_POST['id_egzaminu']."','".$ocena."','".$wynik."','".$a."','".$ilosc_wierszy."','".$_POST['imie']."','".$_POST['nazwisko']."','".$_POST['album']."')";
mysql_query($wynik_do_bazy);

?>

<br /><br />

<form action="index.php" method="POST">
<input type="submit" value="Zakończ" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" />
</form>



<br /><br />
<br />
</div>

<?php

include('const/footer.php');

?>