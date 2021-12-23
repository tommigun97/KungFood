<?php
include 'db_connect.php';
include 'functions.php';

$id = $_GET['id'];
$status = $_GET['status'];
if ($status == "pronto" || $status == "Pronto" || $status == "PRONTO") {
    if ($stmt = $mysqli->prepare("UPDATE `ordine` SET `StatoOrdine`='Preparazione' WHERE Id = ?")) {
        $stmt->bind_param("s", $id); // esegue il bind del parametro '$email'.
        $stmt->execute(); // esegue la query appena creata.
        $stmt->close();
    }
}
header('Location: ./orderPageFornitore.php');
?>