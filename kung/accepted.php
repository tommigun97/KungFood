<?php
include 'db_connect.php';
include 'functions.php';

$id = $_GET['id'];
$status = $_GET['status'];
if ($status == "Preparazione" || $status == "preparazione" || $status == "PREPARAZIONE") {
    if ($stmt = $mysqli->prepare("UPDATE `ordine` SET `StatoOrdine`='Spedito' WHERE Id = ?")) {
        $stmt->bind_param("s", $id); // esegue il bind del parametro '$email'.
        $stmt->execute(); // esegue la query appena creata.
        $stmt->close();
    }
}
header('Location: ./orderPageFornitore.php');
?>