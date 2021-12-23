<?php
include 'db_connect.php';
include 'functions.php';

    if (!isset($_POST["name"]) || strlen($_POST["name"]) == 0) {
        $errors .= "Id è obbligatorio e deve essere almeno un carattere <br/>";
    }
    if (!isset($_POST["surname"])) {
        $errors .= "Cognome è obbligatorio e deve essere almeno 2 caratteri";
    }
    if (!isset($_POST["user"])) {
        $errors .= "Costo è obbligatoria e deve essere valida <br/>";
    }
    if (!isset($_POST["psw"])) {
        $errors .= "Password è obbligatoria e deve essere valida <br/>";
    }
    if (!isset($_POST["telefono"])) {
        $errors .= "Conferma Password è obbligatoria e deve essere valida <br/>";
    }
    if (strlen($errors) == 0) {
        $nome = $_POST['name'];
        $cognome = $_POST['surname'];
        $user= $_POST['user'];
        $psw = $_POST['psw'];
        $telefono = $_POST['telefono'];

        if ($stmt = $mysqli->prepare("INSERT INTO `cliente`(`Username`, `Nome`, `Cognome`, `Password`, `Telefono`) VALUES (?,?,?,?,?)")) {
            $stmt->bind_param("sssss", $user, $nome, $cognome, $psw, $telefono); // esegue il bind del parametro '$email'.
            $stmt->execute(); // esegue la query appena creata.
            $stmt->close();

            header('Location: ./adminViewUsers.php');
        }else{
          echo "errro insert";
        }

    } else {
        echo "error1";
    }

?>