<?php

// dane do połączenia z bazą MySQL
$mysql_host = 'localhost';
$mysql_login = 'root';
$mysql_haslo = '';
$mysql_baza = 'baza_egzaminator';

// połączenie z bazą danych
@$polaczenie = mysql_connect($mysql_host, $mysql_login, $mysql_haslo) or die('<span class="blad_baza">!! Błąd !!<br>Nie udało się nawiązać połączenia z bazą danych.</span><br><a class="powrot" href="index.php"><< Wróć</a>');

// połączenie ze schematem bazy danych
@mysql_select_db($mysql_baza) or die('<span class="blad_baza">!! Błąd !!<br>Nie udało się wybrać schematu bazy danych.</span><br><a class="powrot" href="index.php"><< Wróć</a>');

?>