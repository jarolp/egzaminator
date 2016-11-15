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
<span style="display:block; background:#003300; color:#FFFFFF; font-family:'Courier New', Courier, monospace; font-weight:bold;">&raquo; Dodaj pytanie &laquo;</span>

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

if (!$_POST['pytanie'] || !$_POST['odpowiedz1'] || !$_POST['odpowiedz2'] || !$_POST['odpowiedz3'] || !$_POST['odpowiedz4'] || (!$_POST['check1'] && !$_POST['check2'] && !$_POST['check3'] && !$_POST['check4'])) {


	
	echo "<span class='instrukcja'>Aby poprawnie dodać pytanie, musisz wypełnić wszystkie pola. <a href='#' title='Po wypełnieniu wszystkich pól i kliknięciu przycisku DODAJ PYTANIE pojawi się komunikat o poprawnym dodaniu pytania. Natomaist jeśli nie pojawi się, oznacza to że któreś pole nie zostało wypełnione.'><img src='../template/prof/img/pytajnik.png' class='obramowanie_off' /></a></span><br />";
	
	echo "<fieldset style='margin:0 auto; text-align:center; width:600px; border: 1px solid #003300;' ><legend class='text_4'>Pytanie </legend>";
	echo "<form action='add_query.php' method='POST'>";

	echo "<input type='hidden' name='egzamin' value='".$egzamin."'>";

	echo "<textarea style='width:596px; height:100px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:13px;' name='pytanie'></textarea><br />";
	
	
	for ($y = 1 ; $y <= 4; $y++){
		echo "<input type='checkbox' id='".$y."' name='check".$y."' value='".$y."'><input id='".$y.$y."' type='text' name='odpowiedz".$y."' style='width:574px; height:15px; font-size:11px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace;'><br />";
	
		
		
	}
	
	
	echo "<br /><input type='submit' value='Dodaj pytanie' style='background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;'>";
	echo "</form>";
	echo "</fieldset>";

} else {

if (($_POST['check1'] && $_POST['check2']) || ($_POST['check1'] && $_POST['check3']) || ($_POST['check1'] && $_POST['check4']) || ($_POST['check2'] && $_POST['check3']) || ($_POST['check2'] && $_POST['check4']) || ($_POST['check3'] && $_POST['check4']) || ($_POST['check1'] && $_POST['check2'] && $_POST['check3']) || ($_POST['check1'] && $_POST['check2'] && $_POST['check4']) || ($_POST['check1'] && $_POST['check3'] && $_POST['check4']) || ($_POST['check2'] && $_POST['check3'] && $_POST['check4']) || ($_POST['check1'] && $_POST['check2'] && $_POST['check3'] && $_POST['check4']) ) {
	
	echo "<span class='instrukcja'>Aby poprawnie dodać pytanie, musisz wypełnić wszystkie pola. <a href='#' title='Po wypełnieniu wszystkich pól i kliknięciu przycisku DODAJ PYTANIE pojawi się komunikat o poprawnym dodaniu pytania. Natomaist jeśli nie pojawi się, oznacza to że któreś pole nie zostało wypełnione.'><img src='../template/prof/img/pytajnik.png' class='obramowanie_off' /></a></span><br />";
	
	echo "<fieldset style='margin:0 auto; text-align:center; width:600px; border: 1px solid #003300;' ><legend class='text_4'>Pytanie </legend>";
	echo "<form action='add_query.php' method='POST'>";

	echo "<input type='hidden' name='egzamin' value='".$egzamin."'>";

	echo "<textarea style='width:596px; height:100px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:13px;' name='pytanie'></textarea><br />";
	
	
	for ($y = 1 ; $y <= 4; $y++){
		echo "<input type='checkbox' id='".$y."' name='check".$y."' value='".$y."'><input id='".$y.$y."' type='text' name='odpowiedz".$y."' style='width:574px; height:15px; font-size:11px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace;'><br />";
	
		
		
	}
	
	
	echo "<br /><input type='submit' value='Dodaj pytanie' style='background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;'>";
	echo "</form>";
	echo "</fieldset>";
} else {


$add_pytanie = "INSERT INTO pytania (pytanie, id_egzaminu) VALUES ('".$_POST['pytanie']."',".$egzamin.")";
mysql_query($add_pytanie);

$select_pytanie = "SELECT * FROM pytania ORDER BY id DESC LIMIT 1";
$select_pytanie = mysql_fetch_assoc(mysql_query($select_pytanie));


if ($_POST['check1'] == 1){
$a='1';
} else {
$a='0';
}

if ($_POST['check2'] == 2){
$b='1';
} else {
$b='0';
}

if ($_POST['check3'] == 3){
$c='1';
} else {
$c='0';
}

if ($_POST['check4'] == 4){
$d='1';
} else {
$d='0';
}


$add_odpowiedzi = "INSERT INTO odpowiedzi (id_pytania, odp1, odp2, odp3, odp4, odp1_tf, odp2_tf, odp3_tf, odp4_tf, id_egzaminu) VALUES (".$select_pytanie['id'].", '".$_POST['odpowiedz1']."', '".$_POST['odpowiedz2']."', '".$_POST['odpowiedz3']."', '".$_POST['odpowiedz4']."', '".$a."', '".$b."', '".$c."', '".$d."', '".$egzamin."')";

mysql_query($add_odpowiedzi); // wykonujemy zapytanie



echo "<span class='text_1'>Dodano pytanie do egzaminu/kolokwium!</span><br /><br />";

echo "<form action='add_query.php' method='POST'>";
echo "<input type='hidden' value='".$_POST['egzamin']."' name='egzamin'>";
echo "<input type='submit' value='Dodaj kolejne pytanie' style='background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;'>";

echo "</form>";
}
}

echo '<br /><a href="add.php" class="powrot"> << POWRÓT</a><br />';

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