<?php
include 'db_connect.php';
include 'functions.php';

    if (!isset($_POST["id"]) || strlen($_POST["id"]) == 0) {
        $errors .= "Id è obbligatorio e deve essere almeno un carattere <br/>";
    }
    if (!isset($_POST["nome"])) {
        $errors .= "Cognome è obbligatorio e deve essere almeno 2 caratteri";
    }
    if (!isset($_POST["costo"])) {
        $errors .= "Costo è obbligatoria e deve essere valida <br/>";
    }
    if (!isset($_POST["presente"])) {
        $errors .= "Password è obbligatoria e deve essere valida <br/>";
    }
    if (!isset($_POST["desc"])) {
        $errors .= "Conferma Password è obbligatoria e deve essere valida <br/>";
    }
    if (!isset($_POST["urlfoto"])) {
        $errors .= "Conferma Password è obbligatoria e deve essere valida <br/>";
    }
    if (strlen($errors) == 0) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $costo = $_POST['costo'];
        $presente = $_POST['presente'];
        $desc = $_POST['desc'];
        $urlfoto = $_POST['urlfoto'];
        $id_forn = $_POST['id_forn'];

        if ($stmt = $mysqli->prepare("UPDATE prodotto SET `Nome`=?,`Costo`=?,`Presente`=?,`Descrizione`=?,`UrlFoto`=? WHERE Id = ?")){
            $stmt->bind_param("sdssss", $nome, $costo, $presente, $desc, $urlfoto, $id); // esegue il bind del parametro '$email'.
            $stmt->execute(); // esegue la query appena creata.
            $stmt->close();

            header('Location: ./startPageFornitore.php');
        }else{
          echo "errro insert";
        }

    } else {
        echo "error1";
    }

?>