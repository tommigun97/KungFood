<?php
include 'db_connect.php';
include 'functions.php';

sec_session_start();

$id_forn = $_SESSION['username'];
if (isset($_SESSION['notifiche'])) {
  $notifiche = $_SESSION['notifiche'];
} else {
  $notifiche = "Nessuna Notifica";
}
if (isset($_SESSION['numero'])) {
  $numNotifiche = $_SESSION['numero'];
}else{
  $numNotifiche = 0;
}

$state = 'Eliminato';
$state2 = 'Attesa';
if ($stmt = $mysqli->prepare("SELECT ordine.Id, ordine.Costo, ordine.BloccodiConsegna, ordine.Orario, ordine.Data, ordine.StatoOrdine, cliente.Nome FROM ordine, cliente WHERE ordine.StatoOrdine != ? AND ordine.StatoOrdine != '$state2' AND ordine.IdFornitore = ? AND ordine.IdCliente = cliente.Username")) {
  $stmt->bind_param('ss', $state, $id_forn);
  $stmt->execute(); // esegue la query appena creata.
  $stmt->store_result();
  $i = 0;

?>

<!DOCTYPE html>

<html lang ="it">
<head>
  <title>Cliente</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <!--Importate-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
  <!--Fine Imporate-->

  <script src="../script/jquery_script.js"></script>
  <script src="../script/script.js" ></script>
  <script src="../script/index.js"></script>

 </head>

<body class="w3-display-container">

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-bar-block w3-amber w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
      <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide">Kung Food</h3>
  </div>
  <?php
if (!isset($_SESSION['username'], $_SESSION['login_string'])) {
        ?>
  <div class="w3-padding-64 w3-large " style="font-weight:bold">
          <p class="w3-red w3-center">Effettua il login</p>
    <a href="./allFornitori.php" class="w3-bar-item w3-button">Ristoranti</a>
    <a href="../fortune_wheel.php" class="w3-bar-item w3-button">Ruota della Fortuna</a>
  </div>
  <?php
} else {
        ?>
  <div class="w3-padding-64 w3-large " style="font-weight:bold">
    <a href="./startPageFornitore.php" class="w3-bar-item w3-button">Prodotti Vendibili</a>
    <a href="./orderPageFornitore.php" class="w3-bar-item w3-button">Ordini</a>
    <a href="./setFornitore.php" class="w3-bar-item w3-button">Gestione Account</a>
    <a href="./user/logout.php" class="w3-bar-item w3-button">Logout</a>
  </div>
  <?php
}
    ?>
</nav>
<!-- Top menu on small screens-->
<header class="w3-bar w3-top w3-hide-large w3-amber w3-xlarge">
  <div class="w3-bar-item  w3-display-middle w3-padding-24 w3-wide">
    <div class="w3-center">Kung Food
    <img src="../img/kungfood.png" alt="Logo" style="width:15%"></div>
  </div>

  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-padding-24" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>

  <!-- Top header  here-->
  <header class="w3-container w3-padding-large w3-margin"  >
    <p class="w3-left">Benvenuto <?php echo $id_forn ?>, gestisci i tuoi ordini, sfama la gente e fai i soldoni.</p>
    <p class="w3-right">
      <i class="fa fa-user" id="Login"></i>
      <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" style="display:none" type="text" placeholder="Search.." name="search" id="Demo">
    </p>
    <?php
        if (isset($_SESSION['username'])) {
    ?>
      <div class="username" style="display:none"><?php echo $userName ?></div>
    <br/>

    <br/>
    <br/>

    <button class="w3-btn w3-border w3-left"  onclick="document.getElementById('id01').style.display='block'">Mostra Notifiche ( <?php echo $numNotifiche ?> )</button>
    <br/>
    <br/>

    <div id="id01" class="w3-panel w3-green w3-display-container" style="display:none">
      <span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright"><a href="./deleteNotifyForn.php">X</a></span>
      <p><?php echo $notifiche ?></p>
    </div>
    <?php
        }
    ?>
  </header>


  <div class="w3-container w3-text-grey" style="margin-bottom: 5%">
    <p ></p>
  </div>

  <div class="w3-container w3-margin">
  <h2>Ordini</h2>

  <table class="w3-table w3-bordered w3-striped w3-centered w3-responsive">
    <tr>
      <th>Id</th>
      <th>Costo</th>
      <th>Blocco Consegna</th>
      <th>Orario</th>
      <th>Data</th>
      <th>Stato Ordine</th>
      <th>Nome Cliente</th>
      <th >Gestione</th>
    </tr>
    <tr>

    </tr>
    <?php
      if ($stmt->num_rows > 0) {
        while ($i < $stmt->num_rows) {
          $stmt->bind_result($id, $costo, $blocco, $orario, $data, $status, $nomeCliente); // recupera le variabili dal risultato ottenuto.
          $stmt->fetch();
    ?>
    <tr>
    <td><?php echo $id;?></td>
      <td><?php echo $costo;?></td>
      <td><?php echo $blocco;?></td>
      <td><?php echo $orario;?></td>
      <td><?php echo $data;?></td>
      <td><?php echo $status;?></td>
      <td><?php echo $nomeCliente;?></td>
      <td><a class="w3-button w3-yellow w3-round-large" href="./preparation.php?id=<?php echo $id;?>&status=<?php echo $status;?>"><i class="fa fa-briefcase" aria-hidden="true"></i></a>
      <a class="w3-button w3-green w3-round-large" href="./accepted.php?id=<?php echo $id;?>&status=<?php echo $status;?>"><i class="fa fa-truck" aria-hidden="true"></i></a></td>
      </tr>


    </tr>
    <?php
    $i++;
        }
}} else {
    echo 'error2';
}
?>
  </table>

  </div>





  </div>


</body>

</html>
