<?php

include '../db_connect.php';
include '../functions.php';
//if(!empty($_SESSION['username']) && !empty($_SESSION['login_string'])){
    sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
    if (isset($_POST['type'])) {
    $type = $_POST['type'];
    if($type == "affamato"){
        if (isset($_POST['username'], $_POST['psw'])) {
            $username = $_POST['username'];
            $password = $_POST['psw']; // Recupero la password criptata.
            if (loginAffamato($username, $password, $mysqli) == true) {
                // Login eseguito
                header('Location: ./paginaTemplate.php');
            } else {
                // Login fallito
                header('Location: ./paginaTemplate.php');

            }
        } else {
            // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
            echo 'Invalid Request';
        }
    }else if ($type == "fornitore"){
        if (isset($_POST['username'], $_POST['psw'])) {
            $username = $_POST['username'];
            $password = $_POST['psw']; // Recupero la password criptata.
            if (loginFornitore($username, $password, $mysqli) == true) {
                // Login eseguito
                header('Location: ../startPageFornitore.php');//cosi dovrei passare l'id fornitore
            } else {
                // Login fallito
                header('Location: ./paginaTemplate.php');
            }
        } else {
            // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
            echo 'Invalid Request';
        }
    }else if ($type == "admin"){
        if (isset($_POST['username'], $_POST['psw'])) {
            $username = $_POST['username'];
            $password = $_POST['psw']; // Recupero la password criptata.
            if (loginAdmin($username, $password, $mysqli) == true) {
                // Login eseguito
                header('Location: ../AdminPanel.php');
            } else {
                // Login fallito
                header('Location: ./paginaTemplate.php');
              }
        } else {
            // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
            echo 'Invalid Request';
        }
    }else{
        // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
        echo 'Invalid Request';
    }
    } else {
        // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
        echo 'Invalid Request';
    }
//}else{
  //  echo"Sessione già occupata";
//}
?>
