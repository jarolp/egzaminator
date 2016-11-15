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
<span style="display:block; background:#003300; color:#FFFFFF; font-family:'Courier New', Courier, monospace; font-weight:bold;">&raquo; Moje konto &laquo;</span>

<?php
include 'log/db.php'; 
$tabela = 'rejestracja'; // zdefiniowanie tabeli MySQL
	mysql_query("SET NAMES 'utf8'");
if (isset($_SESSION['login'])) { // dostęp dla zalogowanego użytkownika

    if ($_POST['wyslane']) { // jeżeli formularz został wysłany, to wykonuje się poniższy skrypt

        // filtrowanie treści wprowadzonych przez użytkownika
		$stopien = $_POST['stopien'];
 		$imie = $_POST['imie'];
 		$nazwisko = $_POST['nazwisko'];
        $email = htmlspecialchars(stripslashes(strip_tags(trim($_POST["email"]))), ENT_QUOTES);
        $haslo = $_POST["haslo"];
        $haslo2 = $_POST["haslo2"];
		
		       // system sprawdza czy prawidłowo zostały wprowadzone dane
        if (!eregi("^[0-9a-z_.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$", $email)) {
            $blad++;
            echo '<span class="blad">!! Proszę wprowadzić poprawnie adres email !!</span>';
        }
		$wynik = mysql_query("SELECT * FROM ".$tabela." WHERE login='".$_SESSION["login"]."'");
		if ($wynik) {
			$informacja = mysql_fetch_array($wynik);
     
			if ($email !== $informacja['email']) {
				$wynik = mysql_query("SELECT * FROM ".$tabela." WHERE email='".$email."'");
				if (mysql_num_rows($wynik) <> 0) {
					$blad++;
					echo '<span class="blad">Podany adres e-mail jest już zajęty.</span>';
				}
			}	 
		}
        if ($haslo) {
            if (strlen($haslo) < 6 or strlen($haslo) > 30) {
                $blad++;
                echo '<span class="blad">Proszę poprawnie wpisać hasło (od 6 znaków do 30 znaków).</span>';
            }
        }
        if ($haslo !== $haslo2) {
            $blad++;
            echo '<span class="blad">Podane hasła nie są ze sobą zgodne.</span>';
        }

        // jeżeli błąd nie wystąpił, to dane zostają prawidłowo zapisane z bazie MySQL
        if ($blad == 0) {

            if ($haslo == false) {
			
                $wynik = mysql_query("UPDATE ".$tabela." SET email='".$email."', imie='".$imie."', nazwisko='".$nazwisko."', stopien='".$stopien."' WHERE login='".$_SESSION['login']."'");
            } else {
                $haslo = md5($haslo); // szyfrowanie hasla
                $wynik = mysql_query("UPDATE ".$tabela." SET haslo='".$haslo."', email='".$email."', imie='".$imie."', nazwisko='".$nazwisko."', stopien='".$stopien."' WHERE login='".$_SESSION['login']."'");
            }

            if ($wynik) {
                echo '<span class="ok">Dane zostały zmienione</span>';
            } else {
                echo '<span class="blad">!! Dane nie zostały zmienione !!</span>';
            }
        }
    }
	

    $wynik = mysql_query("SELECT * FROM ".$tabela." WHERE login='".$_SESSION["login"]."'");

    if ($wynik) {
        $informacja = mysql_fetch_array($wynik);

        // tworzenie formularza HTML z danymi użytkownika
        echo <<< KONIEC

    <form class="form" action="account.php" method="post">
    <input type="hidden" name="wyslane" value="TRUE" />
	<table border="0" width="500" align="center"><tr align="center"><td>
	<p>
	  <div><label for="stopien" class="text_2">Stopień naukowy</label></div>
		<input type="text" name="stopien" id="stopien" value="{$informacja['stopien']}" style="background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; text-align:center;" />
	</p>
	</td><td>
	<p>
		<div><label for="imie" class="text_2">Imię</label></div>
		<input type="text" name="imie" id="imie" value="{$informacja['imie']}" style="background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; text-align:center;" />
	</p>
	</td><td>
    <p>
		<div><label for="nazwisko" class="text_2">Nazwisko</label></div>
		<input type="text" name="nazwisko" id="nazwisko" value="{$informacja['nazwisko']}" style="background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; text-align:center;" />
	</p>
	</td></tr></table>
	<table border="0" align="center" width="500"><tr align="center"><td>
	<p>
		<div><label for="login" class="text_2">Login</label></div>
	  <input type="text" name="login" id="login" disabled="disabled" value="{$informacja['login']}" style="background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace; text-align:center;" />
	</p>
	</td><td>
	<p>
		<div><label for="email" class="text_2">E-mail</label></div>
		<input type="text" name="email" id="email" value="{$informacja['email']}" style="background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace;" />
	</p>
</td></tr><tr align="center"><td>
	<p>
		<div><label for="haslo" class="text_2">Nowe hasło</label></div>
		<input type="password" name="haslo" id="haslo" style="background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace;" />
	</p>
</td><td>
	<p>
		<div><label for="haslo2" class="text_2">Powtórz hasło</label></div>
		<input type="password" name="haslo2" id="haslo2" style="background-color:#BFFFC5; border: 1px solid #003300; box-shadow:0px 0px 5px #003300; font-family: 'Courier New', Courier, monospace;" />
	</p>
</td></tr><tr align="center"><td colspan="2">
    <p class="submit2">
		<input type="submit" value="Aktualizuj moje dane" style="background-color:#003300; border:1px solid #000000; color:#BFFFC5; font-family: 'Courier New', Courier, monospace; font-size:14px;" />
	</p>
</td></tr><table>
KONIEC;
    }
    mysql_close($polaczenie);

} else {
    header('Location: index.php'); // niezalogowany użytkownik zostaje przekierowany na stronę główną
}

?>

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