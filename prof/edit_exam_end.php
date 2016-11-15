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
<span style="display:block; background:#003300; color:#FFFFFF; font-family:'Courier New', Courier, monospace; font-weight:bold;">&raquo; Dodaj egzamin &laquo;</span>

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


echo "<br /><span class='text_3'>".$nazwa_egzamin['nazwa']."</span><br /><hr />";

//zmiana pytania------------------------------

$pyt ="SELECT * FROM pytania WHERE id_egzaminu=".$_POST['egz'];
$pyt1 = mysql_query($pyt);


while ($pyt2 = mysql_fetch_assoc($pyt1)) {

$id = $pyt2['id'];
$laczenie = $_POST[$id.'_pytanie_update'];
$zmiana = "UPDATE pytania SET pytanie='".$laczenie."' WHERE id=".$id;
mysql_query($zmiana);



// zmiana odpowiedzi-----------

$odpowiedzi = "SELECT * FROM odpowiedzi WHERE id_pytania=".$id;
$odpowiedzi = mysql_query($odpowiedzi);
$odpowiedzi1 = mysql_fetch_assoc($odpowiedzi);
$laczenie_odp1 = $_POST[$id."_odpowiedz1"];
$laczenie_odp2 = $_POST[$id."_odpowiedz2"];
$laczenie_odp3 = $_POST[$id."_odpowiedz3"];
$laczenie_odp4 = $_POST[$id."_odpowiedz4"];

if ($_POST[$id.'_odp1'] == 'on') {
$zmiana_odp1 = "UPDATE odpowiedzi SET odp1='".$laczenie_odp1."', odp1_tf = 1 WHERE id_pytania=".$id;
mysql_query($zmiana_odp1);

} else {
$zmiana_odp1 = "UPDATE odpowiedzi SET odp1='".$laczenie_odp1."', odp1_tf = 0 WHERE id_pytania=".$id;
mysql_query($zmiana_odp1);


}
if ($_POST[$id.'_odp2'] == 'on') {
$zmiana_odp2 = "UPDATE odpowiedzi SET odp2='".$laczenie_odp2."', odp2_tf = 1 WHERE id_pytania=".$id;
mysql_query($zmiana_odp2);

} else {
$zmiana_odp2 = "UPDATE odpowiedzi SET odp2='".$laczenie_odp2."', odp2_tf = 0 WHERE id_pytania=".$id;
mysql_query($zmiana_odp2);


}
if ($_POST[$id.'_odp3'] == 'on') {
$zmiana_odp3 = "UPDATE odpowiedzi SET odp3='".$laczenie_odp3."', odp3_tf = 1 WHERE id_pytania=".$id;
mysql_query($zmiana_odp3);

} else {
$zmiana_odp3 = "UPDATE odpowiedzi SET odp3='".$laczenie_odp3."', odp3_tf = 0 WHERE id_pytania=".$id;
mysql_query($zmiana_odp3);


}
if ($_POST[$id.'_odp4'] == 'on') {
$zmiana_odp4 = "UPDATE odpowiedzi SET odp4='".$laczenie_odp4."', odp4_tf = 1 WHERE id_pytania=".$id;
mysql_query($zmiana_odp4);

} else {
$zmiana_odp4 = "UPDATE odpowiedzi SET odp4='".$laczenie_odp4."', odp4_tf = 0 WHERE id_pytania=".$id;
mysql_query($zmiana_odp4);


}


}

?>

<br /><br />
<span class="text_1">Wprowadzono zmiany do pytań i odpowiedzi.</span><br /><br />
<br /><a href="myexams.php" class="powrot"> << POWRÓT</a><br /><br />

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