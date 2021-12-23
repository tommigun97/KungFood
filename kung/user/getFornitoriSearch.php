<?php
include '../db_connect.php';
include '../functions.php';

sec_session_start();

$q = $_REQUEST['q'];
$arrRist = array();

$hint = "";

if ($stmt = $mysqli->prepare("SELECT Nome FROM fornitore")) {
    $stmt->execute(); // esegue la query appena creata.
    $stmt->store_result();
    $i = 0;
    if($stmt->num_rows > 0){
      while($stmt->num_rows > $i){
        $stmt->bind_result($nomeRIst);
        $stmt->fetch();
        $arrRist[$i] = $nomeRIst;
        $i++;
      }
    } else{
      echo 'nessun ristorante disponibile';
    }

  if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($arrRist as $name) {
      if (stristr($q, substr($name, 0, $len))) {
        if ($hint === "") {
          $hint = $name;
        } else {
          $hint .= ", $name";
        }
      }
    }
  }
}
echo $hint === "" ? "no suggestion" : $hint;
?>
