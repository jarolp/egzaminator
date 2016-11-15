<?php
ob_start();
session_start(); // rozpoczęcie sesji
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="Stylesheet" type="text/css" href="../../template/prof/style.css">
</head>
<body>
<div style="text-align:center; margin: 0 auto;">

<?php

if (!isset($_SESSION['login'])) { // dostęp dla niezalogowanego użytkownika

    include 'db.php'; // połączenie się z bazą danych
    $tabela = 'rejestracja'; // zdefiniowanie tabeli MySQL

    if ($_POST['wyslane']) { // jeżeli formularz został wysłany, to wykonuje się poniższy skrypt

        $login = htmlspecialchars(stripslashes(strip_tags(trim($_POST["login"]))), ENT_QUOTES); // filtrowanie $_POST['login']

        $hasloodszyfrowane = uniqid(rand()); // tworzenie nowe hasła
        $haslo = md5($hasloodszyfrowane); // szyfrowanie hasła

        // użytkownikowi zostaje zmienione hasło, które system wygenerował
        // jeżeli podanego loginu nie ma w bazie, wyświetla się komunikat
        $wynik = mysql_query("UPDATE ".$tabela." SET haslo='".$haslo."' WHERE login='".$login."'");

        $wynik = mysql_query("SELECT * FROM ".$tabela." WHERE login='$login'");

        if (mysql_num_rows($wynik) == 1) {
            $informacja = mysql_fetch_array($wynik);
            $email = $informacja["email"];
            $list="Twoje nowe wygenerowane hasło to: $hasloodszyfrowane";
            @mail($email, "Przypomnienie hasla", $list, "From: <kontakt@twoja-strona.pl>");
            echo '<span class="ok">Nowe hasło zostało wysłane na adres e-mail wykorzystany podczas rejestracji konta.</span>';
        } else {
            echo '<span class="blad">Użytkownik o podanym loginie nie istnieje!</span>';
        }
        mysql_close($polaczenie);
    }

    // tworzenie formularza HTML
    echo <<< KONIEC

    <form class="form" action="przypomnienie.php" method="post">
    <input type="hidden" name="wyslane" value="TRUE" />

    <p>
	  <div class="label"><label for="login" class="text_2">Podaj swój login</label></div>
	  <input type="text" name="login" id="login" />
	</p>

    <p class="zaloguj"><input type="submit" value="Wyslij mi nowe hasło" /></p>

KONIEC;

} else {
    header('Location: /index.php'); // zalogowany użytkownik zostaje przekierowany na stronę główną
}

?>

</div></body></html>