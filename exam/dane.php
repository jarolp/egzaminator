<?php

include('const/header.php');

?>
<?php
include 'log/db.php'; 
?>
<div style="width:800px; margin:0 auto; border:1px solid #000; background-color:#00AE09; text-align:center;">
<br />
<fieldset class="fieldset_dane"><legend class="legend_dane">Twoje dane</legend>

<table width="500" style="border: 0px solid #000;" align="center">
    <tr>
        <td width="250"><p class="text_1">
        Imię:</p>
        </td>

        <td>
        <p class="text_2"><?php echo $_POST['imie']; ?></p>
        </td>
    </tr>
    <tr>
        <td><p class="text_1">
        Nazwisko:</p>
        </td>

        <td>
        <p class="text_2"><?php echo $_POST['nazwisko']; ?></p>
        </td>
    </tr>
    <tr>
        <td><p class="text_1">
        Nr albumu:</p>
        </td>

        <td>
        <p class="text_2"><?php echo $_POST['album']; ?></p>
        </td>
    </tr>
    
</table>
</fieldset>
<form action="index.php" method="POST"><br />
<?php

echo '<input type="hidden" name="imie" value="'.$_POST['imie'].'" />';
echo '<input type="hidden" name="nazwisko" value="'.$_POST['nazwisko'].'" />';
echo '<input type="hidden" name="album" value="'.$_POST['album'].'" />';

echo '<input type="submit" value="<< Powrót" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: Courier New, Courier, monospace; font-size:14px;">';
echo '<span class="blad"> || jeśli w powyższych danych znajduje się błąd, kliknij na powrót i popraw go.</span>';
?>
</form>
<br />

	<hr />

    <p class="przedmiot">Jeśli wszystkie dane są prawidłowe, wybierz wykładowcę<br /> a następnie egzamin który chcesz zdawać:</p>
    <br />
    <form action="dane.php" method="POST">
        <select name="profesor" style="width:600px; background-color:#BFFFC5; border: 1px solid #003300; text-align:left; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" />
        <option value="0">------------------------------- wybierz wykładowcę -------------------------------</option>

<?php
mysql_query("SET NAMES 'utf8'"); //super funkcja która gwarantuje polskie znaki
$wykl = "SELECT * FROM rejestracja WHERE id != 1 ORDER BY id ASC";
$RES = mysql_query($wykl); // wykonujemy zapytanie
while($AFR = mysql_fetch_assoc($RES)){
if ($_POST['profesor'] == $AFR['id']) {
echo '<option value="'.$AFR['id'].'" selected=selected>'.$AFR['stopien'].' '.$AFR['imie'].' '.$AFR['nazwisko'].'</option>';
}
if ($_POST['profesor'] != $AFR['id']) {
echo '<option value="'.$AFR['id'].'">'.$AFR['stopien'].' '.$AFR['imie'].' '.$AFR['nazwisko'].'</option>';
}


}

?>
        </select>
            <input type="hidden" name="imie" value="<?php echo $_POST['imie']; ?>" />
    <input type="hidden" name="nazwisko" value="<?php echo $_POST['nazwisko']; ?>"  />
    <input type="hidden" name="album" value="<?php echo $_POST['album']; ?>" />

        <br /><br />
        
        <input type="submit" value="Wyświetl przedmioty" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" />
    </form>    

<?php
    
if (!$_POST['profesor']){	

}
else
{	
?>	
<form action="egzamin.php" method="POST">    
    <br />
        <select name="przedmiot" style="width:600px; background-color:#BFFFC5; border: 1px solid #003300; text-align:left; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" />
        <option value="0">------------------------------- wybierz przedmiot --------------------------------</option>
        
<?php

$wykl = "SELECT * FROM egzaminy WHERE id_prof='".$_POST['profesor']."' ORDER BY id ASC";
$RES = mysql_query($wykl); // wykonujemy zapytanie
while($AFR = mysql_fetch_assoc($RES)){
if ($_POST['przedmiot'] == $AFR['id']) {
echo '<option value="'.$AFR['id'].'" selected=selected>'.$AFR['nazwa'].'</option>';
}
if ($_POST['przedmiot'] != $AFR['id']) {
echo '<option value="'.$AFR['id'].'">'.$AFR['nazwa'].'</option>';
}
}

?>        

        </select>
    <br /><br />
    <input type="hidden" name="imie" value="<?php echo $_POST['imie']; ?>" />
    <input type="hidden" name="nazwisko" value="<?php echo $_POST['nazwisko']; ?>"  />
    <input type="hidden" name="album" value="<?php echo $_POST['album']; ?>" />
    <input type="hidden" name="profesor" value="<?php echo $_POST['profesor']; ?>" />
    
    <input type="submit" value="Wybieram ten test >>" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" />
    </form>
<?php
}
?>
<br />

</div>

<?php

include('const/footer.php');

?>