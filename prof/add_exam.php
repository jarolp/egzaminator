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
<?php

echo "<br /><span class='text_1'>Utworzono egzamin/kolokwium z przedmiotu:</span><br />";
echo "<br /><span class='text_3'>".$_POST['nazwa_egz']."</span><br /><hr />";
mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki
$add_egz = "INSERT INTO egzaminy (nazwa,poziom,tryb,semestr,rok,id_prof) VALUES ('".$_POST['nazwa_egz']."' , '".$_POST['stopien']."', '".$_POST['tryb']."', '".$_POST['semestr']."', '".$_POST['rok_studiow']."', '".$_POST['prof']."')";
mysql_query($add_egz);

echo '<a href="add.php" class="powrot"> << POWRÓT</a><br />';
?>


<br />
</div>




<?php	
}

else {
	echo "<span style='font-family:Courier New, Courier, monospace; font-size:12x; color:#000000; text-decoration:none; font-weight:bold;'>Nie jesteś zalogowany!<br /><br />Dostęp tylko dla zalogowanych użytkowników.</span><br /><br /> 
	<a href='index.php' style='font-family: Courier New , Courier, monospace; font-size:18px; color:#000000;; font-weight:bold;'><i> << Wróć do strony logowania</i></a>";
}
?>

</div>

<?php
include 'const/footer.php';
?>