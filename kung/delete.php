<?php
include 'db_connect.php';
include 'functions.php';

        $id = $_GET['id'];

        if ($stmt = $mysqli->prepare("DELETE FROM `prodotto` WHERE Id = ?")){
            $stmt->bind_param("s", $id); // esegue il bind del parametro '$email'.
            $stmt->execute(); // esegue la query appena creata.
            $stmt->close();

            header('Location: ./startPageFornitore.php');
        }else{
            echo "not deleted";
        }
?>