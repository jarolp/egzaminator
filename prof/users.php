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


<?php
mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki
$dane="SELECT * FROM rejestracja WHERE login!='".$_SESSION['login']."' ORDER BY nazwisko ASC";
$dane=mysql_query($dane);


?><br /><br />
<form action="users_end.php" method="POST">
<fieldset class="fieldset_dane1"><legend class="legend_dane">Dodaj użytkownika</legend><center>
<span class="text_2">Stopień:</span><input name="stopien" type="text" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:center; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" value="<?php echo $_POST['stopien']; ?>"/>
<span class="text_2">Imie:</span><input name="imie" type="text" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:center; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" value="<?php echo $_POST['imie']; ?>"/>
<span class="text_2">Nazwisko:</span><input name="nazwisko" type="text" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:center; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" value="<?php echo $_POST['nazwisko']; ?>"/><br /><br />
<span class="text_2">E-mail:</span><input name="email" type="text" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:center; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" value="<?php echo $_POST['email']; ?>"/>
<span class="text_2">Login:</span><input name="new_log" type="text" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:center; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" value="<?php echo $_POST['login']; ?>"/>



<br /><br />
<input type="submit" value="Dodaj" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" />
</center>
</fieldset>
</form>
<br /><br />

<form action="users_end.php" method="POST">
<fieldset class="fieldset_dane1"><legend class="legend_dane">Usuń użytkownika</legend><center>
<select name="user" style="width:500px; background-color:#BFFFC5; border: 1px solid #003300; text-align:left; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" >
<?php
while ($dane1=mysql_fetch_assoc($dane)) {
echo '<option value="'.$dane1["id"].'">'.$dane1["stopien"].' '.$dane1["nazwisko"].' '.$dane1["imie"].' - '.$dane1["login"].'</option>';
}

?>
</select><br /><br />
<input type="submit" value="Usuń" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');" />
</center>
</fieldset>
</form>
<br /><br />




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