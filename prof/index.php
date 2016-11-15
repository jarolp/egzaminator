<?php
ob_start();
session_start(); // rozpoczęcie sesji
?>

<?php
include 'const/header.php';
?>

<div style="width:800px; margin:0 auto; border:1px solid #000; background-color:#00AE09; text-align:center;">
	<br><br>
	<?php

if (!isset($_SESSION['login'])) { // dostęp dla niezalogowanego użytkownika

    if ($_POST['wyslane']) { // jeżeli formularz został wysłany, to wykonuje się poniższy skrypt

        include('log/db.php'); // połączenie się z bazą danych
        $tabela = 'rejestracja'; // zdefiniowanie tabeli MySQL 

        $login = $_POST["login"];
        $haslo = $_POST["haslo"];

        $haslo = md5($haslo); // szyfrowanie podanego hasła

		$wynik=mysql_query("SELECT * FROM ".$tabela." WHERE login='".$login."' and haslo='".$haslo."'");


        // jeżeli wszystko jest dobrze, użytkownik się loguje
        $wynik=mysql_query("SELECT * FROM ".$tabela." WHERE login='".$login."' and haslo='".$haslo."'");

        if (mysql_num_rows($wynik) == 1) {
            $informacja = mysql_fetch_array($wynik);
            $_SESSION["login"] = $informacja["login"];
            header('Location: index.php ');
        } else {
            echo '<span class="text_1">Błędny login lub hasło!</span>';
        }
        mysql_close($polaczenie);
    }

// tworzenie formularza HTML  
    echo <<< KONIEC

    <form class="form" action="index.php" method="post">
    <input type="hidden" name="wyslane" value="TRUE" />

    <p>
	  <div class="label"><label for="login" class="text_2">Login</label></div>
	  <input type="text" name="login" id="login" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:center; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;"  />
	</p>
	
	<p>
	  <div class="label"><label for="haslo" class="text_2">Hasło</label></div>
	  <input type="password" name="haslo" id="haslo" style="background-color:#BFFFC5; border: 1px solid #003300; text-align:center; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; font-size:12px;"  />
	</p>

    <p class="submit2">
      <input type="submit" value="Zaloguj mnie" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" />
    </p>
		<SCRIPT>
function displayWindow(url, width, height) {
var Win = window.open(url,"displayWindow",'width=' + width + ',height=' + height + ',resizable=0,scrollbars=yes,menubar=no' );
}
</SCRIPT> 
	<p>
		<a class="powrot" href="javascript:displayWindow('log/przypomnienie.php',300,150)">Nie pamiętasz hasła?</a>
	</p>
<br /><br />
    </form>
KONIEC;


} else {
    header('Location: myexams.php'); // zalogowany użytkownik zostaje przekierowany na stronę główną
}

if ($_GET["wylogowanie"] == "tak") {
    // niszczenie sesji użytkownika
    session_unset();
    session_destroy();
    header('Location: index.php'); // przekierwanie na stronę główną
}

?>

</div>

</div>

<?php
include 'const/footer.php';
?>

