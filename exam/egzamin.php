<?php

include('const/header.php');

?>
<?php
include 'log/db.php'; 
?>
<?php


mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki
$info = "SELECT * FROM egzaminy WHERE id=".$_POST['przedmiot'];
$RES = mysql_query($info); // wykonujemy zapytanie
$AFR = mysql_fetch_assoc($RES);


$info_prof = "SELECT * FROM rejestracja WHERE id=".$_POST['profesor'];
$info_prof = mysql_query($info_prof); // wykonujemy zapytanie
$info_prof = mysql_fetch_assoc($info_prof);

?>

<div style="width:800px; margin:0 auto; border:1px solid #000; background-color:#00AE09; text-align:center;">
<br />
<fieldset class="fieldset_dane"><legend><span class="text_1">Wybraleś przedmiot</span></legend>
<span class="instrukcja"><p style="font-size:16px;"><?php echo $AFR['nazwa']; ?></p></span>
<br />
<span class="text_1">Rok: <?php echo $AFR['rok']; ?><br />Tryb: <?php echo $AFR['tryb']; ?><br />Stopień: <?php echo $AFR['poziom']; ?></span>
</fieldset><br />
<span class="text_1">który wykłada</span><br /><span class="text_1"><?php echo $info_prof['stopien'].' '.$info_prof['imie'].' '.$info_prof['nazwisko']; ?></span>
<br /><br />
<form action="dane.php" method="POST">
<?php
echo '<input type="hidden" name="imie" value="'.$_POST['imie'].'" />';
echo '<input type="hidden" name="nazwisko" value="'.$_POST['nazwisko'].'" />';
echo '<input type="hidden" name="album" value="'.$_POST['album'].'" />';
echo '<input type="hidden" name="profesor" value="'.$_POST['profesor'].'" />';
echo '<input type="hidden" name="przedmiot" value="'.$_POST['przedmiot'].'" />';


echo '<input type="submit" value="<< Powrót" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: Courier New, Courier, monospace; font-size:14px;">';

echo '<span class="blad"> || jeśli wybrałeś zły przedmiot, kliknij na powrót i zmień go.</span>';
echo '</form><hr /><br />';
if ($_POST['przedmiot'] == 0) {
echo '<span class="instrukcja">Nie wybrano żadnego egzaminu!!<br>Kliknij na przycisk [ << Powrót ] i wybierz egzamin który chcesz zdawać</span><br>';
} else {

?>
<span class="instrukcja1">
Punktacja egzaminu/kolokwium:<br />
&nbsp;1 pkt - za udzielenie poprawnej odpowiedzi.<br />
&nbsp;0 pkt - za zaznaczenie błędnej odpowiedzi lub nieudzielenie odpowiedzi<br />
-1 pkt - w przypadku zaznaczenia dwóch lub więcej odpowiedzi do jednego pytania<br /><br />
Czas egzaminu/kolokwium ustala wykładowca.
</span><br />
<p class="przedmiot">Jeśli wszystko się zgadza kliknij na '!! Chcę zdawać !!'.</p><br />


<form action="egzamin_end.php" method="POST">

<?php

// ukryte dane !!
echo '<input type="hidden" name="id_egzaminu" value="'.$_POST['przedmiot'].'">';
echo '<input type="hidden" name="imie" value="'.$_POST['imie'].'" />';
echo '<input type="hidden" name="nazwisko" value="'.$_POST['nazwisko'].'"  />';
echo '<input type="hidden" name="album" value="'.$_POST['album'].'" />';

?>


<input type="submit" value="!! Chcę zdawać !!" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" />

</form>


<br />
</div>

<?php
}
include('const/footer.php');

?>