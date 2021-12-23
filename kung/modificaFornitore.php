<?php
include 'db_connect.php';
include 'functions.php';
$errors="";


        if (!isset($_POST["name"]) || strlen($_POST["name"]) < 2) {
            $errors .= "Nome deve essere almeno 2 caratteri <br/>";
        }
        if (!isset($_POST["surname"]) || strlen($_POST["surname"]) < 2) {
            $errors .= "Cognome deve essere almeno 2 caratteri";
        }
        if (!isset($_POST["psw"]) || strlen($_POST["psw"]) < 2) {
            $errors .= "Password deve essere valida <br/>";
        }
        if (!isset($_POST["phone"]) || strlen($_POST["phone"]) < 2) {
            $errors .= "telefono non corretto <br/>";
        }


        if (strlen($errors) == 0) {


            if ($stmt = $mysqli->prepare("UPDATE `cliente` SET `Nome`=?,`Cognome`=?,`Password`=?,`Telefono`=? WHERE/WHERE Username = ?")) {
            $stmt->bind_param('ssssss', $_POST['name'],$_POST['surname'], $_POST['psw'], $_POST['phone'], $_POST['username']); // esegue il bind del parametro '$email'.
              $stmt->execute(); // esegue la query appena creata.
              //$password = hash('sha512', $password); // codifica la password usando una chiave univoca.
              $stmt->close();
              header('Location: ./getUser.php');

            } else {
                //Registrazione fallita
                //header('Location: ./CustomerLogin.php');
                echo "errore";
            }
          }
?>
