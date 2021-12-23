
<?php

//fetch_data.php
//include "db_connect.php";

$connect = new PDO("mysql:host=localhost;dbname=kungfood", "root", "");

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET')
{
 $data = array(
  ':id'   => "%" . $_GET['id'] . "%",
  ':nome'   => "%" . $_GET['nome'] . "%",
  ':costo'   => "%" . $_GET['costo'] . "%",
  ':presente'     => "%" . $_GET['presente'] . "%",
  ':descrizione'    => "%" . $_GET['descrizione'] . "%",
  ':urlfoto'    => "%" . $_GET['urlfoto'] . "%",
  //':idfornitore'   => "%" . $_GET['idfornitore'] . "%"
 );
 $query = "SELECT * FROM prodotto WHERE nome LIKE :nome AND costo LIKE :costo AND presente LIKE :presente AND descrizione LIKE :descrizione AND urlfoto LIKE :urlfoto ORDER BY id ASC";

 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'id'    => $row['id'],   
   'nome'  => $row['nome'],
   'costo'   => $row['costo'],
   'presente'    => $row['presente'],
   'descrizione'   => $row['descrizione'],
   'urlfoto'    => $row['urlfoto'],
   'idfornitore'    => $row['idfornitore']
   
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")
{
    $data = array(
        ':id'   => "%" . $_POST['id'] . "%",
        ':nome'   => "%" . $_POST['nome'] . "%",
        ':costo'   => "%" . $_POST['costo']. "%",
        ':presente'     => "%" . $_POST['presente'] . "%",
        ':descrizione'    => "%" . $_POST['descrizione'] . "%",
        ':urlfoto'    => "%" . $_POST['urlfoto'] . "%",
        ':idfornitore'    => "%" . $_POST['idfornitore'] . "%",

       );



 $query = "INSERT INTO prodotto (id, nome, costo, presente, descrizione, urlfoto, idfornitore) VALUES (:id, :nome, '10.2', :presente, :descrizione, :urlfoto, 'FishGnam')";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == 'PUT')
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
  ':id'   => $_PUT['id'],
  ':nome' => $_PUT['nome'],
  ':costo' => $_PUT['costo'],
  ':presente'   => $_PUT['presente'],
  ':descrione'  => $_PUT['descrizione'],
  ':urlfoto'   => $_PUT['urlfoto']
 );
 $query = "UPDATE prodotto SET nome = :nome, costo = :costo, presente = :presente, descrizione = :descrizione, urlfoto = :urlfoto WHERE id = :id";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM prodotto WHERE id = '".$_DELETE["id"]."'";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>