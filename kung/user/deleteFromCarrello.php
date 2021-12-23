<?php

include '../db_connect.php';
include '../functions.php';

sec_session_start();
if(isset($_POST['idP']) && isset($_SESSION['username'])){
  $IdPr = $_POST['idP'];
  $stateFault = 'Attesa';
  $cliente = $_SESSION['username'];
  if ($stmt = $mysqli->prepare("SELECT Id FROM ordine WHERE IdCliente = ? AND StatoOrdine = ?")) {
    $stmt->bind_param('ss', $cliente, $stateFault);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows >= 1) {
      $stmt->bind_result($idOrd);
      $stmt->fetch();
      delete_product($mysqli, $idOrd, $IdPr);
      header('Location: ./Carrello.php');
    }else{
      return false;
    }
  }
}else {
  echo '  undefined variable';
}

 ?>
