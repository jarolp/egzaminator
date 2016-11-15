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

$id_prof = mysql_fetch_assoc(mysql_query("SELECT * FROM rejestracja WHERE login='".$_SESSION["login"]."'"));

mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki

$egz1 = "SELECT nazwa FROM egzaminy WHERE id_prof=".$id_prof['id']."";
$RES2 = mysql_fetch_assoc(mysql_query($egz1)); // wykonujemy zapytanie


$egz = "SELECT * FROM egzaminy WHERE id_prof=".$id_prof['id']."";
$RES1 = mysql_query($egz); // wykonujemy zapytanie

if (!empty($RES2)) {


echo '<br />';

echo '<fieldset style="width:520px; margin:0 auto; border: 1px solid #003300;" ><legend class="text_2">Wybór egzaminu/kolokwium <a href="#" title="Użytkownik wybiera egzamin do którego chce dodać pytania."><img src="../template/prof/img/pytajnik.png" class="obramowanie_off" /></a></legend>';
echo '<form action="add_query.php" method="POST">';

echo '<select name="egz" style="width:500px; background-color:#BFFFC5; border: 1px solid #003300; text-align:left; box-shadow:0px 0px 5px #003300; font-family: Courier New, Courier, monospace; font-size:12px;">';


while($AFR1 = mysql_fetch_assoc($RES1)){

echo "<option value='".$AFR1['id']."'>rok: ".$AFR1['rok']."-".$AFR1['semestr']."-".$AFR1['tryb']."-".$AFR1['poziom']."- ".$AFR1['nazwa']."<br>";

}

echo '</select><br /><br />';
echo '<input type="submit" value="Dodaj pytanie" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: Courier New, Courier, monospace; font-size:14px;"/>';
echo '</form></fieldset>';
} 
?>

<form action="add_exam.php" method="POST">
<br />
<fieldset style="width:520px; margin:0 auto; border: 1px solid #003300;" ><legend class="text_2">Nazwa egzaminu/kolokwium <a href="#" title="Użytkownik wprowadza nazwę przedmiotu z którego jest egzamin."><img src="../template/prof/img/pytajnik.png" class="obramowanie_off" /></a></legend>
<textarea style="width:500px; height:50px; background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:13px;" name="nazwa_egz"></textarea>
<br />
<br />

<table width="350" align="center" border="0">
<tr><td align="right">
<select name="rok_studiow"  style="background-color:#BFFFC5; border: 1px solid #003300; text-align:left; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px; ">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
</select>
</td><td align="left">
<span class="text_2">Rok studiów <a href="#" title="Rok studiów dla którego przygotowany jest egzamin/kolokwium."><img src="../template/prof/img/pytajnik.png" class="obramowanie_off" /></a></span>
</td></tr>
<tr><td align="right">
<select name="semestr"  style="background-color:#BFFFC5; border: 1px solid #003300; text-align:left; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px; ">
<option>letni</option>
<option>zimowy</option>
</select>
</td><td align="left">
<span class="text_2">Semestr <a href="#" title="Semestr dla którego przygotowany jest egzamin/kolokwium."><img src="../template/prof/img/pytajnik.png" class="obramowanie_off" /></a></span>
</td></tr>
<tr><td align="right">
<select name="tryb"  style="background-color:#BFFFC5; border: 1px solid #003300; text-align:left; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px; ">
<option>stacjonarny</option>
<option>niestacjonarny</option>
</select>
</td><td align="left">
<span class="text_2">Tryb <a href="#" title="Tryb studiów dla którego przygotowany jest egzamin/kolokwium."><img src="../template/prof/img/pytajnik.png" class="obramowanie_off" /></a></span>
</td></tr>
<tr><td align="right">
<select name="stopien"  style="background-color:#BFFFC5; border: 1px solid #003300; text-align:left; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px; ">
<option>lic.</option>
<option>inż.</option>
<option>mgr.</option>
</select>
</td><td align="left">
<span class="text_2">Stopień <a href="#" title="Stopień kształcenia dla którego przygotowany jest egzamin/kolokwium."><img src="../template/prof/img/pytajnik.png" class="obramowanie_off" /></a></span>
</td></tr></table>

<input type="hidden" name="prof" value="<?php echo $id_prof['id']; ?>"/>

<br />
<input type="submit" value="Stwórz" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" />
</form>
</fieldset>
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