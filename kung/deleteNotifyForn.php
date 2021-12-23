<?php

include 'db_connect.php';
include 'functions.php';

sec_session_start();

if(isset($_SESSION['username'], $_SESSION['login_string'])){
    unset($_SESSION['notifiche']);
    unset($_SESSION['numero']);
}
header('Location: ./startPageFornitore.php');

?>
