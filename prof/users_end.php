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
}
include('const/menu_admin.php');

?>

<div style="border:1px solid #000; background-color:#00AE09;">
<span style="display:block; background:#003300; color:#FFFFFF; font-family:'Courier New', Courier, monospace; font-weight:bold;">&raquo; Użytkownicy &laquo;</span>

<?php
include 'log/db.php'; 

if (isset($_SESSION['login'])) { // dostęp dla zalogowanego użytkownika

?>

<br /><br /><br />
<?php
mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki

if ($_POST['new_log']) {
//SELECT * FROM rejestracja WHERE login='admin' ORDER BY nazwisko ASC
$login="SELECT * FROM rejestracja WHERE login='".$_POST['new_log']."' ORDER BY nazwisko ASC";
$login=mysql_query($login);
$login1=mysql_num_rows($login);

if ($login1 == 0){ 

$email="SELECT * FROM rejestracja WHERE email='".$_POST['email']."' ORDER BY nazwisko ASC";
$email=mysql_query($email);
$email1=mysql_num_rows($email);

	if ($email1 == 0){ 

@$data = date("Y-m-d");
$dane="INSERT INTO rejestracja (stopien, imie, nazwisko, login, haslo, email, data) VALUES ('".$_POST['stopien']."' ,'".$_POST['imie']."', '".$_POST['nazwisko']."', '".$_POST['new_log']."', 'e10adc3949ba59abbe56e057f20f883e', '".$_POST['email']."', '".$data."')";
$dane=mysql_query($dane);
echo "<span class='text_1'>Dodano użytkownika:<br /><br />".$_POST['new_log']."</span><br /><br />";
	} else {
echo "<span class='text_1'>Użytkownik o takim adresie e-mail już istnieje</span>";

echo '<form action="users.php" method="POST" >';
echo '<input value="'.$_POST['stopien'].'" type="hidden" name="stopien" />';
echo '<input value="'.$_POST['imie'].'" type="hidden" name="imie" />';
echo '<input value="'.$_POST['nazwisko'].'" type="hidden" name="nazwisko" />';
echo '<input value="'.$_POST['new_log'].'" type="hidden" name="login" />';
echo '<input value="'.$_POST['email'].'" type="hidden" name="email" />';
echo '<input type="submit" value="<< Cofnij" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: Courier New, Courier, monospace; font-size:14px;" >';
echo '</form>';

	}
} else {

echo "<span class='text_1'>Użytkownik o takim loginie już istnieje</span>";

echo '<form action="users.php" method="POST" >';
echo '<input value="'.$_POST['stopien'].'" type="hidden" name="stopien" />';
echo '<input value="'.$_POST['imie'].'" type="hidden" name="imie" />';
echo '<input value="'.$_POST['nazwisko'].'" type="hidden" name="nazwisko" />';
echo '<input value="'.$_POST['new_log'].'" type="hidden" name="login" />';
echo '<input value="'.$_POST['email'].'" type="hidden" name="email" />';
echo '<input type="submit" value="<< Cofnij" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: Courier New, Courier, monospace; font-size:14px;" >';
echo '</form>';

}

}

if ($_POST['user']) {

$dane="SELECT * FROM rejestracja WHERE id='".$_POST['user']."'";
//echo $_POST['user'];
$dane=mysql_query($dane);
$dane1=mysql_fetch_array($dane);

echo '<span class="text_1">Usunięto użytkownika<br /><br />'.$dane1['stopien'].' '.$dane1['nazwisko'].' '.$dane1['imie'].'</span>';


$egz="SELECT * FROM egzaminy WHERE id_prof='".$_POST['user']."'";
$egz=mysql_query($egz);

while ($egz1=mysql_fetch_assoc($egz)) {
$usun_odpowiedzi="DELETE FROM odpowiedzi WHERE id_egzaminu=".$egz1['id'];
mysql_query($usun_odpowiedzi);

$usun_pytania="DELETE FROM pytania WHERE id_egzaminu=".$egz1['id'];
mysql_query($usun_pytania);

$usun_wyniki="DELETE FROM wyniki WHERE id_egzaminu=".$egz1['id'];
mysql_query($usun_wyniki);

$usun_egzamin="DELETE FROM egzaminy WHERE id_prof=".$_POST['user'];
mysql_query($usun_egzamin);
}

$dane_do_usuniecia = "DELETE FROM rejestracja WHERE id=".$_POST['user'];
mysql_query($dane_do_usuniecia);


}



?>
<br /><br /><br />

<a href="users.php" class="powrot"> << POWRÓT</a><br /><br />


<?php	
}

else {
	echo "<span style='font-family:Courier New, Courier, monospace; font-size:12x; color:#000000; text-decoration:none; font-weight:bold;'>Nie jesteś zalogowany!<br><br>Dostęp tylko dla zalogowanych użytkowników.</span><br><br> 
	<a href='index.php' style='font-family: Courier New , Courier, monospace; font-size:18px; color:#000000;; font-weight:bold;'><i> << Wróć do strony logowania</i></a>";
}
?>


</div>
</div>
<?php
include 'const/footer.php';
?>