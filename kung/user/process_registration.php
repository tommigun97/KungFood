<?php

include '../db_connect.php';
include '../functions.php';
include '../mail.php';


$errors = "";
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if (isset($_POST['type'])) {
    $type = $_POST['type'];
    if ($type == "affamato") {
        if (!isset($_POST["name"]) || strlen($_POST["name"]) < 2) {
            $errors .= "Nome è obbligatorio e deve essere almeno 2 caratteri <br/>";
        }
        if (!isset($_POST["surname"]) || strlen($_POST["surname"]) < 2) {
            $errors .= "Cognome è obbligatorio e deve essere almeno 2 caratteri";
        }
        if (!isset($_POST["username"]) || !filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
            $errors .= "Email è obbligatoria e deve essere valida <br/>";
        }
        if (!isset($_POST["psw"]) || strlen($_POST["psw"]) < 2) {
            $errors .= "Password è obbligatoria e deve essere valida <br/>";
        }
        if (!isset($_POST["repsw"]) || strlen($_POST["repsw"]) < 2) {
            $errors .= "Conferma Password è obbligatoria e deve essere valida <br/>";
        }
        if (strcmp($_POST["repsw"], $_POST['psw']) != 0) {
            $errors .= "Password e Conferma Password devono essere uguali<br/>";
        }
        if (strlen($errors) == 0) {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $username = $_POST['username'];
            $password = $_POST['psw'];

            if (regAffamato($name, $surname, $username, $password, $mysqli) == true) {
                //registrazione eseguita
                if(send_mail_registration($name, $username)){
                    header('Location: ./paginaTemplate.php');
                }else{
                    echo "invio mail fallita";
                }

            } else {
                //Registrazione fallita
                //header('Location: ./CustomerLogin.php');
                echo "registrazione fallita";
            }
        } else {
            // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
            echo $errors;
        }
    } else if ($type == "fornitore") {
        if (!isset($_POST["nome"]) || strlen($_POST["nome"]) < 2) {
            $errors .= "Nome è obbligatorio e deve essere almeno 2 caratteri <br/>";
        }
        if (!isset($_POST["proprietario"]) || strlen($_POST["proprietario"]) < 2) {
            $errors .= "Proprietario è obbligatorio e deve essere almeno 2 caratteri";
        }
        if (!isset($_POST["username"]) || !filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
            $errors .= "Email è obbligatoria e deve essere valida <br/>";
        }
        if (!isset($_POST["psw"]) || strlen($_POST["psw"]) < 2) {
            $errors .= "Password è obbligatoria e deve essere valida <br/>";
        }
        if (!isset($_POST["repsw"]) || strlen($_POST["repsw"]) < 2) {
            $errors .= "Conferma Password è obbligatoria e deve essere valida <br/>";
        }
        if (strcmp($_POST["repsw"], $_POST['psw']) != 0) {
            $errors .= "Password e Conferma Password devono essere uguali<br/>";
        }
        if (strlen($errors) == 0) {
            $nome = $_POST['nome'];
            $proprietario = $_POST['proprietario'];
            $username = $_POST['username'];
            $password = $_POST['psw'];

            if (regFornitore($nome, $proprietario, $username, $password, $mysqli) == true) {
                //registrazione eseguita
                if(send_mail_registration($nome, $username)){
                    header('Location: ./paginaTemplate.php');
                }else{
                    echo "invio mail fallita";
                }
            } else {
                //Registrazione fallita
                //header('Location: ./CustomerLogin.php');
                echo "registrazione fallita";
            }
        } else {
            // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
            echo $errors;
        }
    } else {
        // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
        echo 'Invalid Request';
    }
}

?>
