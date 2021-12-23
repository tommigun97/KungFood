<?php
include '../db_connect.php';
include '../functions.php';

sec_session_start();

/*if(login_check($mysqli) == true){*/

$userName = $_SESSION['username'];
$ordineId = $_POST['idordine'];
$ora = $_POST['ora'];
$blocco = $_POST['blocco'];
$state = "Pronto";
$data = '2019/01/29';

if ($stmt = $mysqli->prepare("UPDATE `ordine` SET `StatoOrdine`= ?, `BloccodiConsegna` = ?, `Orario` = ?, `Data` = ? WHERE Id = ?")) {
  $stmt->bind_param('sssss', $state, $blocco, $ora, $data, $ordineId);
  $stmt->execute();
  $stmt->store_result();
  $stmt->close();
  header('Location: ./paginaTemplate.php?showYeah=si');

}
 ?>
