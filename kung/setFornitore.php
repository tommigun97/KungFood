<?php
include './db_connect.php';
include './functions.php';

sec_session_start();
$user_name = $_SESSION['username'];

$nomeFornitore="";
$passwordFornitore="";
$proprietarioFo="";
$p_iva="";
$desc="";
$immagineFornitore="";
/*if(login_check($mysqli) == true){*/
if ($stmt = $mysqli->prepare("SELECT `Nome`, `Password`, `Propietario`, `P_IVA`, `Descrizione`, `Logo` FROM `fornitore` WHERE username = ? LIMIT 1")) {
  $stmt->bind_param('s', $user_name);
  $stmt->execute(); // esegue la query appena creata.
  $stmt->store_result();
  $stmt->bind_result($nomeFornitore, $passwordFornitore, $proprietarioFo, $p_iva, $desc, $immagineFornitore);
  $stmt->fetch();
  $stmt->close();

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
  <div  id="fornView">
    <section class=" w3-container w3-margin">
        <form class="w3-center w3-padding w3-card-4" method="post" action="./modiForni.php" >
          <header class="w3-container w3-padding-large">
            <h1 class="w3-center  w3-round-xxlarge w3-green">Modifica le tue informazioni: </h1>
          </header>
      <label><b>Nome</b></label>
      <input id="ciao" class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" value="<?php echo $nomeFornitore?>" name="name" >
      <label><b>Username</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" value="<?php echo $user_name?>" name="username"  readonly>
      <label><b>Password</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" value="<?php echo $passwordFornitore?>" name="psw" >
      <label><b>Proprietario</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" value="<?php echo $proprietarioFo?>" name="owner" >
      <label><b>P.IVA</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" value="<?php echo $p_iva?>" name="p_iva" >
      <label><b>Descrizione</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" value="<?php echo $desc?>" name="desc" >
      <div class="w3-container w3-border-top  w3-padding-16 w3-amber" style="width:100%">
          <button type="submit" class="w3-button w3-round-xxlarge w3-left w3-green">Confirm</button>
          <a href="./startPageFornitore.php">
          <button type="button" class="w3-button w3-round-xxlarge w3-right w3-red">Cancel</button></a>
        </div>
          </form>
      </div>

  <?php
  }else
  {
  echo "error";
  }


  ?>

  </section>
  </div>
</body>

</html>
