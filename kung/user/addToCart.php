<?php
include '../db_connect.php';
include '../functions.php';

//if(isset($_SESSION['username']) && isset($_SESSION['login_string'])){
sec_session_start();
//questo post usI mi serviva per memorizzare il fornitore in modo da poter tornare indietro, ma come la passo?
if (isset($_POST['idPr']) && isset($_POST['inputNumb'])) {
  $prodottoId = $_POST['idPr'];
  $quantita = $_POST['inputNumb'];
  $forn = $_POST['fornId'];
  $userName = $_SESSION['username'];
  //$clienteId = $_POST['usI'];
  if (insert_into_cart($mysqli, $quantita, $prodottoId, $userName) == true) {
    header('Location: ./homeFornitore.php?username='.$forn);
  } else{
    echo 'inserimento carrello fallito';
  }
} else{
  echo 'passaggio variabili errato';
}


?>
