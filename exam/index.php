<?php

include('const/header.php');

?>

<div style="width:800px; margin:0 auto; border:1px solid #000; background-color:#00AE09;">
<br /><br /><br /><br />
<form action="dane.php" method="POST">
<table border="0" align="center">
    <tr>
        <td><p class="text_1">
        Imię:</p>
        </td>

        <td>
        <input type="text" name="imie" value="<?php echo $_POST['imie']; ?>" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:center; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" />
        </td>
    </tr>

    <tr>
        <td><p class="text_1">
        Nazwisko:</p>
        </td>

        <td>
        <input type="text" name="nazwisko" value="<?php echo $_POST['nazwisko']; ?>" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:center; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" />
        </td>
    </tr>

    <tr>
        <td><p class="text_1">
        Nr albumu:</p>
        </td>

        <td>
        <input type="text" name="album"  value="<?php echo $_POST['album']; ?>" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:center; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;" />
        </td>
    </tr>

   
    <tr>
        <td colspan="2" align="center">
<input type="submit" value="Wybierz przedmiot >>" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" >


        </td>
    </tr>
    
</table>
</form>
<br /><br /><br /><br />
</div>

<?php

include('const/footer.php');

?>