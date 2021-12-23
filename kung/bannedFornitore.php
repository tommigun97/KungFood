<?php
include 'db_connect.php';
include 'functions.php';

$user_id = $_GET['user_id'];

/*if(login_check($mysqli) == true){*/
if ($stmt = $mysqli->prepare("UPDATE `fornitore` SET `Banned`= '1' WHERE Username = ? LIMIT 1")) {
  $stmt->bind_param('s', $user_id);
  $stmt->execute(); // esegue la query appena creata.
  $stmt->store_result();
  $stmt->close();
  header('Location: ./AdminPanel.php');
}else{
  echo "error";
}
?>
