<?php
ob_start();
session_start(); // rozpoczęcie sesji
?>

<?php
include 'const/header.php';
?>


<div style=" border: 0px solid #000; width:800px; text-align:center; margin:0 auto;">
<?php
// jeżeli użytkownik jest zalogowany wyświetlamy inforamcję
if (isset($_SESSION['login'])) {  
?>
    <div style="position:absolute;">
    <span style="font-family:'Courier New', Courier, monospace; font-size:14px;">Jesteś zalogowany jako <b><?php echo $_SESSION['login']; ?></b>!</span>
    </div>
<?php

include('const/menu.php');

?>

<div style="border:1px solid #000; background-color:#00AE09;">
<span style="display:block; background:#003300; color:#FFFFFF; font-family:'Courier New', Courier, monospace; font-weight:bold;">&raquo; Edytuj egzamin &laquo;</span>

<?php
include 'log/db.php'; 
?>
<br />
<?php
mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki

if ($_POST['egz']) {
$egzamin = $_POST['egz'];

$nazwa_egzamin = mysql_fetch_assoc(mysql_query("SELECT nazwa FROM egzaminy WHERE id=".$egzamin));

}

if ($_POST['egzamin']) {
$egzamin = $_POST['egzamin'];
$nazwa_egzamin = mysql_fetch_assoc(mysql_query("SELECT nazwa FROM egzaminy WHERE id=".$egzamin));
}

echo "<br /><span class='text_3'>".$nazwa_egzamin['nazwa']."</span><br /><hr />";

echo "<form action='edit_exam_end.php' method='POST'>";

$pytania ="SELECT * FROM pytania WHERE id_egzaminu=".$_POST['egz'];
$pytania = mysql_query($pytania);

$y=0;
while ($pytania1 = mysql_fetch_assoc($pytania)) {
$y=$y+1;
echo '<fieldset class="fieldset_dane1"><legend class="legend_dane">Pytanie '.$y.'</legend>';
echo '<textarea style="width:696px; height:100px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: Courier New, Courier, monospace; font-size:13px;" name="'.$pytania1['id'].'_pytanie_update">'.$pytania1['pytanie'].'</textarea><br>';

echo "<input type='hidden' name='id_pytania' value='".$pytania1['id']."'>";

$odpowiedzi = "SELECT * FROM odpowiedzi WHERE id_pytania=".$pytania1['id'];
$odpowiedzi = mysql_query($odpowiedzi);
$odpowiedzi1 = mysql_fetch_assoc($odpowiedzi);

if ($odpowiedzi1['odp1_tf'] == 1) {
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp1" checked="yes"><input type="text" name="'.$pytania1['id'].'_odpowiedz1" style="width:676px; height:15px; font-size:11px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: Courier New, Courier, monospace;" value="'.$odpowiedzi1['odp1'].'" ><br>';
} else {
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp1"><input type="text" name="'.$pytania1['id'].'_odpowiedz1" style="width:676px; height:15px; font-size:11px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: Courier New, Courier, monospace;" value="'.$odpowiedzi1['odp1'].'" ><br>';
}

if ($odpowiedzi1['odp2_tf'] == 1) {
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp2" checked="yes"><input type="text" name="'.$pytania1['id'].'_odpowiedz2" style="width:676px; height:15px; font-size:11px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: Courier New, Courier, monospace;" value="'.$odpowiedzi1['odp2'].'"><br>';
} else {
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp2"><input type="text" name="'.$pytania1['id'].'_odpowiedz2" style="width:676px; height:15px; font-size:11px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: Courier New, Courier, monospace;" value="'.$odpowiedzi1['odp2'].'"><br>';
}

if ($odpowiedzi1['odp3_tf'] == 1) {
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp3" checked="yes"><input type="text" name="'.$pytania1['id'].'_odpowiedz3" style="width:676px; height:15px; font-size:11px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: Courier New, Courier, monospace;" value="'.$odpowiedzi1['odp3'].'"><br>';
} else {
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp3"><input type="text" name="'.$pytania1['id'].'_odpowiedz3" style="width:676px; height:15px; font-size:11px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: Courier New, Courier, monospace;" value="'.$odpowiedzi1['odp3'].'"><br>';
}

if ($odpowiedzi1['odp4_tf'] == 1) {
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp4" checked="yes"><input type="text" name="'.$pytania1['id'].'_odpowiedz4" style="width:676px; height:15px; font-size:11px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: Courier New, Courier, monospace;" value="'.$odpowiedzi1['odp4'].'"><br>';
} else {
echo '<input type="checkbox" name="'.$pytania1['id'].'_odp4"><input type="text" name="'.$pytania1['id'].'_odpowiedz4" style="width:676px; height:15px; font-size:11px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: Courier New, Courier, monospace;" value="'.$odpowiedzi1['odp4'].'"><br>';
}



echo '</fieldset><br>';
}

echo "<input type='hidden' value=".$_POST['egz']." name='egz'>";

echo "<input type='submit' value='Zmień' style='background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: Courier New, Courier, monospace; font-size:14px;'<br>";
echo "</form>";



echo '<br /><a href="myexams.php" class="powrot"> << POWRÓT</a><br />';

?>

<br />
</div>




<?php	
}

else {
	echo "<span style='font-family:Courier New, Courier, monospace; font-size:12x; color:#000000; text-decoration:none; font-weight:bold;'>Nie jesteś zalogowany!<br><br>Dostęp tylko dla zalogowanych użytkowników.</span><br><br> 
	<a href='index.php' style='font-family: Courier New , Courier, monospace; font-size:18px; color:#000000;; font-weight:bold;'><i> << Wróć do strony logowania</i></a>";
}
?>

</div>

<?php
include 'const/footer.php';
?>