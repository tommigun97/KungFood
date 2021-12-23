<?php
include 'db_connect.php';
include 'functions.php';
$errors = "";
echo $_POST["name"];
echo $_POST["psw"];
echo $_POST["owner"];
echo $_POST["p_iva"];
    if (!isset($_POST["name"]) || strlen($_POST["name"]) < 2) {
        $errors .= "Nome deve essere almeno 2 caratteri";
    }
    if (!isset($_POST["psw"]) || strlen($_POST["psw"]) < 2) {
        $errors .= "Cognome deve essere almeno 2 caratteri";
    }
    if (!isset($_POST["owner"]) || strlen($_POST["owner"]) < 2) {
        $errors .= "Password deve essere valida ";
    }
    if ( strlen($_POST["p_iva"]) < 2) {
        $errors .= "P_IVA non corretta";
    }


    if (strlen($errors) == 0) {

        if ($stmt = $mysqli->prepare("UPDATE `fornitore` SET `Nome`=?,`Password`=?,`Propietario`=?,`P_IVA`=?,`Descrizione`=?  WHERE Username = ?")) {
            $stmt->bind_param('ssssss', $_POST['name'], $_POST['psw'], $_POST['owner'], $_POST['p_iva'], $_POST['desc'], $_POST['username']); // esegue il bind del parametro '$email'.
            $stmt->execute(); // esegue la query appena creata.
            //$password = hash('sha512', $password); // codifica la password usando una chiave univoca.
            $stmt->close();
            header('Location: ./startPageFornitore.php');

        } else {
            // Password incorretta.
            echo "error2";
        }

    } else {
        //Registrazione fallita
        //header('Location: ./CustomerLogin.php');
        echo "errore";
    }

    ?>
