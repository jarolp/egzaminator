<?php
ob_start();
session_start(); // rozpoczęcie sesji

if ($_SESSION['login'] == 'admin') {
header('Location: users.php'); // zalogowany użytkownik zostaje przekierowany na stronę główną
}

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
include('const/menu.php');

?>

<div style="border:1px solid #000; background-color:#00AE09;">
<span style="display:block; background:#003300; color:#FFFFFF; font-family:'Courier New', Courier, monospace; font-weight:bold;">&raquo; Moje egzaminy &laquo;</span>

<?php
include 'log/db.php'; 

if (isset($_SESSION['login'])) { // dostęp dla zalogowanego użytkownika

?>

<?php
//usuwanie
if ($_POST['egzamin_do_usuniecia']) {
$usun_odpowiedzi="DELETE FROM odpowiedzi WHERE id_egzaminu=".$_POST['egzamin_do_usuniecia'];
mysql_query($usun_odpowiedzi);

$usun_pytania="DELETE FROM pytania WHERE id_egzaminu=".$_POST['egzamin_do_usuniecia'];
mysql_query($usun_pytania);

$usun_wyniki="DELETE FROM wyniki WHERE id_egzaminu=".$_POST['egzamin_do_usuniecia'];
mysql_query($usun_wyniki);

$usun_egzamin="DELETE FROM egzaminy WHERE id=".$_POST['egzamin_do_usuniecia'];
mysql_query($usun_egzamin);

}
?>

<?php
mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki
$zapytanie_id="SELECT id FROM rejestracja WHERE login='".$_SESSION['login']."' ORDER BY id ASC";
$zapytanie_id=mysql_query($zapytanie_id);
$zapytanie_id=mysql_fetch_assoc($zapytanie_id);

$SQL = "SELECT * FROM egzaminy WHERE id_prof=".$zapytanie_id['id']." AND nazwa LIKE '%".$_POST['szukaj']."%'";



if ($_POST['sortowanie']){

$SQL = $SQL."ORDER BY ".$_POST['sortowanie'];
}

if ($_POST['szukaj']){
	$szukanie = $_POST['szukaj'];
	
	if ($_POST['szukaj'] <> $_POST['szukaj']) {
	$szukanie = $_POST['szukaj'];
	}
}



$RES = mysql_query($SQL); // wykonujemy zapytanie

?>
<br />
<table align="center" width="780" border="0" bordercolor="#003300" cellpadding="0" cellspacing="2">
<tr><td align="left">
<form action="myexams.php" method="POST">



<input type="text" name="szukaj" style=" width:150px; height:15px;background-color:#BFFFC5; border: 1px solid #003300; text-align:left; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" value="<?php echo $_POST['szukaj']; ?>"/> 
<input type="submit" value="Szukaj" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:11px;" /> 

</form>
</td><td  align="right" valign="top">
<form action="myexams.php" method="POST">

<input type="hidden" name="szukaj" value="<?php echo $szukanie ?>" />

<select name="sortowanie" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:left; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;">
<option value="id">---------------</option>
<option value="rok">Rok rosnąco</option>
<option value="rok desc">Rok malejąco</option>
<option value="semestr">Semestr rosnąco</option>
<option value="semestr desc">Semestr malejąco</option>
<option value="tryb">Tryb rosnąco</option>
<option value="tryb desc">Tryb malejąco</option>
<option value="poziom">Stopień rosnąco</option>
<option value="poziom desc">Stopień malejąco</option>
<option value="nazwa">Nazwa rosnąco</option>
<option value="nazwa desc">Nazwa malejąco</option>
</select>
<input type="submit" value="Sortuj" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:11px;" /> 
</form>
</td></tr></table>

<table align="center" width="780" border="1" bordercolor="#003300" cellpadding="0" cellspacing="0">
<tr bgcolor="#FF6600" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><td width="35">Rok</td><td width="60">Semestr</td><td width="35">Tryb</td><td width="50">Stopień</td><td>Przedmiot</td><td width="80">Edytuj/Usuń</td><td width="50">Wyniki</td></tr>

<?php



while($AFR = mysql_fetch_assoc($RES)){
   /*Wyświetlanie wyników, przykładowo:*/
?>
<tr onmouseover="this.style.backgroundColor='#FFCC33'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFF99" style=" font-family:'Courier New', Courier, monospace; font-size:12px;">
<?php

echo '<td width="35">'.$AFR["rok"].'</td><td width="60">'.$AFR["semestr"].'</td><td width="35"><a href="#" title="'.$AFR["tryb"].'" style="text-decoration: none; color:#000000;">';

 if ($AFR["tryb"] == 'stacjonarny')
 {
 	echo 'S';
 } else {
 
 	echo 'NS';
 }

echo '</a></td><td width="50">'.$AFR["poziom"].'</td>

<td><a href="preview.php?id='.$AFR["id"].'" style="text-decoration:none; color:#000000;" target="_blank" title="Podgląd egzaminu">'.$AFR["nazwa"].'</a></td><td width="80">

<form action="edit_exam.php" method="POST" style="float:left; padding-left:10px;">
<input type="hidden" name="egz" value="'.$AFR["id"].'">

<a title="Edytuj"><input type="image" src="template/img/edytuj.png" ></a>
</form>


<form action="myexams.php" method="POST"  style="float:right; padding-right:10px;">

<input type="hidden" name="egzamin_do_usuniecia" value="'.$AFR["id"].'">';

$nazwa_egzaminu_do_usuniecia = $AFR["nazwa"];

?>

<a title="Usuń"><input type="image" src="template/img/usun.png" onclick="return confirm('Czy na pewno chcesz usunąć egzamin/kolokwium:\n\n<?php echo $nazwa_egzaminu_do_usuniecia; ?> ');"></a>

<?php
echo '</form>

</td><td width="50">

<form target="_blank" action="wyniki.php" method="POST">

<input type="hidden" name="id_egzaminu" value="'.$AFR["id"].'">


<a title="Wyniki"><input type="image" src="template/img/wyniki.png" ></a>
</form>



</td></tr>';

}


?>
</table>
<br />


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