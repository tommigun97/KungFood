<?php
define("HOST", "localhost"); // E' il server a cui ti vuoi connettere.
define("USER", "root"); // E' l'utente con cui ti collegherai al DB.
define("PASSWORD", ""); // Password di accesso al DB.
define("DATABASE", "kungfood"); // Nome del database.
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
?>
