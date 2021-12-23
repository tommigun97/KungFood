<?php
include '../db_connect.php';
include '../functions.php';

sec_session_start();

/*if(login_check($mysqli) == true){*/
/*$userName = $_SESSION['username'];
$state = "Attesa";
$numeroNo = "0";
if ($stmt = $mysqli->prepare("SELECT PO.Numero, P.Nome, P.UrlFoto, P.Costo FROM ordine As O, prodotto As P, prodotto_ordinato As PO WHERE O.IdCliente = ? AND O.StatoOrdine = ? AND PO.IdOrdine = O.Id AND PO.IdProdotto = P.Id AND PO.Numero != ?")) {
    $stmt->bind_param('sss', $userName, $state, $numeroNo);
    $stmt->execute(); // esegue la query appena creata.
    $stmt->store_result();
    $i = 0;
    $prezzoTot = 0;*/
    $ordId = $_POST['ordId'];


    ?>



<!DOCTYPE html>

<html lang ="it">
<head>
  <title>Esegui ordine</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../css/style.css" type="text/css">
  <link rel="stylesheet" href="../../css/styleCheckO.css" type="text/css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="../../script/jquery_script.js" type="text/javascript"></script>
  <script src="../../script/script.js" type="text/javascript"></script>
</head>


<body class="w3-display-container">

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-amber w3-xlarge">
  <div class="w3-bar-item  w3-display-middle w3-padding-24 w3-wide">
    <div class="w3-center">Kung Food
    <img src="../../img/kungfood.png" alt="Logo" style="width:15%"></div>
  </div>

  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-padding-24" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>


<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-amber w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><a href="./paginaTemplate.php">Kung Food</h3>
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
    <a href="./allFornitori.php" class="w3-bar-item w3-button">Ristoranti</a>
    <a href="./getOrdini.php" class="w3-bar-item w3-button">Ordini</a>
    <a href="../fortune_wheel.php" class="w3-bar-item w3-button">Ruota della Fortuna</a>
    <a href="./Carrello.php" class="w3-bar-item w3-button">Carrello</a>
    <a href="./getUser.php" class="w3-bar-item w3-button">Modifica account</a>
    <a href="./logout.php" class="w3-bar-item w3-button">Logout</a>
  </div>
  <?php
}
    ?>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>

  <!-- Top header  here-->
  <header id="change" class="w3-container w3-padding-large">
    <h1 class="w3-center w3-red w3-round-xxlarge w3-border">Check-out ordine</h1>
  </header>
  <?php
  /*if ($stmt->num_rows > 0) {
        while ($i < $stmt->num_rows) {
            $stmt->bind_result($numero, $nomeProdotto, $img, $pUnitario); // recupera le variabili dal risultato ottenuto.
            $stmt->fetch();
            $prezzoTot = ($numero * $pUnitario) + $prezzoTot;*/
  ?>

  <!-- Product grid  -->

<form method="post" action="startConsegna.php">

    <div class=" w3-center">
      <div>
        <img src="../../img/mappa.png" alt="Logo" style="width:40%">
        <div>
        <div class="w3-left w3-card-4 w3-padding w3-hide-small w3-margin-left w3-margin-top " style="width:40%">
          <p>Seleziona il blocco di consegna:</P>
          <input type="radio" name="blocco" value="Blocco A">Blocco A<br>
          <input type="radio" name="blocco" value="Blocco B">Blocco B<br>
          <input type="radio" name="blocco" value="Blocco C">Blocco C<br>
          <input type="radio" name="blocco" value="Blocco D">Blocco D<br>
          <input type="radio" name="blocco" value="Blocco E">Blocco E<br>
          <p>Seleziona l'orario di consegna:<p>
          <select name="ora">
            <option value="11:30">11:30</option>
            <option value="12:00">12:00</option>
            <option value="12:30">12:30</option>
            <option value="13:00">13:00</option>
            <option value="13:30">13:30</option>
            <option value="14:00">14:00</option>
          </select>
        </div>
        <div class="w3-center w3-card-4 w3-padding w3-hide-large w3-margin-top ">
          <p>Seleziona il blocco di consegna:</P>
          <input type="radio" name="blocco" value="Blocco A">Blocco A<br>
          <input type="radio" name="blocco" value="Blocco B">Blocco B<br>
          <input type="radio" name="blocco" value="Blocco C">Blocco C<br>
          <input type="radio" name="blocco" value="Blocco D">Blocco D<br>
          <input type="radio" name="blocco" value="Blocco E">Blocco E<br>
          <p>Seleziona l'orario di consegna:<p>
          <select name="ora">
            <option value="11:30">11:30</option>
            <option value="12:00">12:00</option>
            <option value="12:30">12:30</option>
            <option value="13:00">13:00</option>
            <option value="13:30">13:30</option>
            <option value="14:00">14:00</option>
          </select>
        </div>
      </div>
    </div>
<div>
    <div class="w3-right w3-hide-small w3-card-4 w3-padding w3-margin-top">
      <p>Seleziona il metodo di pagamento:</P>
      <input type="radio" name="pagamento" value="contanti">Contanti<br>
      <input type="radio" name="pagamento" value="Pagamento elettronico">Pagamento elettronico<br>
      <p>Inserisci le credenziali:</p>
      <div class="w3-hide-small">
      <div class="w3-left">
        <ul>
        <li>Nome titolare:<br></li>
        <input type="text"><br>
        <li>Cognome:<br></li>
        <input type="text"><br>
        <li>Indirizzo:<br></li>
        <input type="text"><br>
      </div>
      <div class="w3-right">
        <ul>
        <li>Numero carta:<br></li>
        <input type="text"style="background-color:white"><br>
        <li>CVV:<br></li>
        <input type="text"><br>
        <li>Scadenza:<br></li>
        <input type="month"><br>
        </div>
      </div>
    </div>
  </div>
  <div class="w3-hide-large ">
        <div class="w3-card-4 w3-padding w3-margin-top">
          <p>Seleziona il metodo di pagamento:</P>
          <input type="radio" name="pagamento" value="contanti">Contanti<br>
          <input type="radio" name="pagamento" value="Pagamento elettronico">Pagamento elettronico<br>
          <p>Inserisci le credenziali:</p>
            <p>
            <p>Nome titolare:<br></p>
            <input type="text"><br>
            <p>Cognome:<br></p>
            <input type="text"><br>
            <p>Indirizzo:<br></p>
            <input type="text"><br>
            <p>Numero carta:<br></p>
            <input type="text"style="background-color:white"><br>
            <p>CVV:<br></p>
            <input type="text"><br>
            <p>Scadenza:<br></p>
            <input type="month"><br>
          </p>
        </div>
  </div>
  </div>
  <div class="w3-center" style="margin-top:40%">
    <input type="hidden" name="idordine" value="<?php echo $ordId?>"></input>
    <button type="submit" class="w3-margin-top w3-margin-bottom w3-center w3-amber w3-padding-large w3-round-xxlarge">Conferma pagamento</button>
  </div>
</form>

 <!-- Footer -->
 <footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
      <div class="w3-row-padding">
        <div class="w3-col s4">
          <h4>About</h4>
          <p><a href="#">About us</a></p>
          <p><a href="#">We're hiring</a></p>
          <p><a href="#">Support</a></p>
          <p><a href="#">Shipment</a></p>
          <p><a href="#">Payment</a></p>
          <p><a href="#">Return</a></p>
          <p><a href="#">Help</a></p>
        </div>

        <div class="w3-col s4 w3-justify">
          <h4>Store</h4>
          <p><i class="fa fa-fw fa-map-marker"></i>KungFood S.R.L.</p>
          <p><i class="fa fa-fw fa-phone"></i> 056423435</p>
          <p><i class="fa fa-fw fa-envelope"></i> kung@food.it</p>
          <h4>We accept</h4>
          <p><i class="fa fa-fw fa-credit-card"></i>Credit Card</p>
          <p><i class="fa fa-fw fa-credit-card"></i>Cash</p>
          <br>
          <a class="fa fa-facebook-official w3-hover-opacity w3-large" href="https://it-it.facebook.com"></a>
          <a class="fa fa-instagram w3-hover-opacity w3-large" href="https://www.instagram.com/?hl=it"></a>
        </div>
      </div>
    </footer>


    <!-- End page content -->
  </div>


</body>

</html>


<?php
/*
} else {
echo 'You are not authorized to access this page, please login. <br/>';
}*/
?>
