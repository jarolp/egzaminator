<?php
ob_start();
session_start(); // rozpoczęcie sesji
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="background-color:#FFFFCC">


<?php
include 'log/db.php'; 
mysql_query("SET NAMES 'utf8'");
?>

<?php
$nazwa_egz = mysql_query("SELECT * FROM egzaminy WHERE id=".$_POST['id_egzaminu']);
$nazwa_egz1 = mysql_fetch_assoc($nazwa_egz);

$wykladowca = mysql_query("SELECT * FROM rejestracja WHERE login='".$_SESSION['login']."'");
$wykladowca1 = mysql_fetch_assoc($wykladowca);


?>


<table border="1" cellpadding="5" cellspacing="0" style="border-style:double;" >
<tr><td colspan="5" bgcolor="#FFCC66">
Wykładowca: <?php echo '<b>'.$wykladowca1['stopien'].' '.$wykladowca1['imie'].' '.$wykladowca1['nazwisko'].'</b><br>';  ?>
Przedmiot:<br />
<?php

echo '<b>'.$nazwa_egz1['nazwa']."</b><br /><br />";
echo "Tryb studiów: ".$nazwa_egz1['tryb']."<br />";

if ($nazwa_egz1['poziom'] == 'lic.') {
echo "Rodzaj studiów: licencjackie<br />";
} elseif ($nazwa_egz1['poziom'] == 'mgr.') {
echo "Rodzaj studiów: magisterskie<br />";
} else {
echo "Rodzaj studiów: inżynierskie<br />";
}

echo "Rok: ".$nazwa_egz1['rok']."<br />";
echo "Semestr: ".$nazwa_egz1['semestr']."<br />";

?>
</td></tr>


<tr align="center" style="font-weight:bold; background-color:#FF6600;"><td width="40">id</td><td width="350">Nazwisko i imię</td><td width="80">Album</td><td width="100">Uzyskany %</td><td width="50">Ocena</td></tr>
<?php

$wyniki = mysql_query("SELECT * FROM wyniki WHERE id_egzaminu=".$_POST['id_egzaminu']." ORDER BY wyniki.nazwisko_stud ASC");


$y=0;
while ($DIS = mysql_fetch_assoc($wyniki)) {
$y=$y+1;
?>
<tr align='center' onMouseOver="this.style.backgroundColor='#FFCC33'" onMouseOut="this.style.backgroundColor=''" bgcolor="#FFFF99">

<?php echo "<td>".$y.".</td><td align='left'> ".$DIS['nazwisko_stud']." ".$DIS['imie_stud']."</td><td>".$DIS['album']."</td><td>".$DIS['procent']."%</td><td><b>".$DIS['ocena']."</b></td></tr>";




}

?>
</table>




</body>
</html>