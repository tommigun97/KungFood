<?php
include '../db_connect.php';
include '../functions.php';

sec_session_start();

$user_id = $_GET['username'];

if ($stmtA = $mysqli->prepare("SELECT Nome, Logo FROM fornitore WHERE Username = ?")) {
  $stmtA->bind_param('s', $user_id);
  $stmtA->execute(); // esegue la query appena creata.
  $stmtA->store_result();
  $stmtA->bind_result($nomeFornitore, $immagineFornitore);
  $stmtA->fetch();
}

//if(login_check($mysqli) == true) {
if ($stmt = $mysqli->prepare("SELECT Id, Nome, Costo, Presente, Descrizione, UrlFoto FROM prodotto WHERE IdFornitore = ?")) {
  $stmt->bind_param('s', $user_id);
  $stmt->execute(); // esegue la query appena creata.
  $stmt->store_result();
  $i = 0;

?>
<!DOCTYPE html>
<html lang ="it">
<head>
<title>Home Fornitore</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../css/style.css" type="text/css">
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
<script src="../../script/script.js" type="text/javascript"></script>
<script src="../../script/jquery_script.js"></script>


<!--Questi tre stylesheet successivi si possono usare, se non si può, non va il login-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
function mostraAllergie(IdProd){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      var myObj = JSON.parse(this.responseText);
      document.getElementById("txtHint").innerHTML = myObj[2];
    }
  };
  xmlhttp.open("GET", "allergieElenco.php?idP="+ IdProd, true);
  xmlhttp.send();
}
</script>


</head>
<body class="w3-display-container">

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-bar-block w3-amber w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
      <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
      <h2 class="w3-wide"><a href="./paginaTemplate.php">Kung Food</a></h2>
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


<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-amber w3-xlarge">
  <div class="w3-bar-item  w3-display-middle w3-padding-24 w3-wide">
    <div class="w3-center">Kung Food
    <img src="../../img/kungfood.png" alt="Logo" style="width:15%"></div>
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
  <header class="w3-container w3-padding-large">
    <p class="w3-right">
      <i class="fa fa-user w3-margin-right"></i>
      <input class="w3-hide w3-input w3-round-xxlarge w3-border w3-margin-bottom" type="text" placeholder="Search.." name="search" id="Demo">
    </p>
</header>
<div class="w3-center w3-margin">
  <div id="prodottiList">
    <h1><?php echo $nomeFornitore ?></h1>
    <div class="w3-hide-large" style="height:60%">
    <img src="../../img/Ristoranti/<?php echo $immagineFornitore?>" alt="Logo Fornitore">
  </div>
  <div class="w3-hide-small">
    <img src="../../img/Ristoranti/<?php echo $immagineFornitore?>" alt="Logo Fornitore">
  </div>
  </div>
</div>

  <div class="w3-container w3-text-grey">
    <p><?php echo $stmt->num_rows?> piatti</p>
  </div>

  <?php
  if($stmt->num_rows > 0) {
    while($i < $stmt->num_rows){
      $stmt->bind_result($idP, $nomeProd, $costo, $disponibile, $descrizione, $img);
      $stmt->fetch();
  ?>

  <!-- Product grid -->
  <form method="post" action="./addToCart.php" >
  <div class="w3-hide-small" style="margin-left:5%">
    <div class="w3-container w3-margin-bottom w3-center w3-round-xxlarge w3-third w3-card-4"  >
      <div id="img">
          <img class="w3-circle "src="../../img/Prodotti/<?php echo $img?>">
        <div class="w3-container w3-white">
          <p class="titleParagrafo"><?php echo $nomeProd?><p>
          <p style="font-size: 100%"><?php echo $descrizione?></p>
          <p><?php echo $costo?>€</p>
          <input class="w3-input w3-round-xxlarge w3-border" name="inputNumb" min="1" value="1" type="number"></input>
          <?php
            if($disponibile == 's'){
              ?>
              <i class="fa fa-check w3-margin-right w3-text-green" title="Prodotto disponibile"></i>
              <?php
            }else{
              ?>
              <i class="fa fa-close w3-margin-right w3-text-red" title="Prodotto non disponibile"></i>
              <?php
            }
          ?>
          <a href="allergieElenco.php?idP=<?php echo $idP?>"><i class="fa fa-exclamation-triangle w3-margin-right w3-text-yellow" title="Visualizza Allergie" id="triangle"></i></a>
        </div>
        <input type="hidden" name="fornId" value="<?php echo $user_id?>"></input>
        <input type="hidden" name="idPr" value="<?php echo $idP?>"></input>
        <?php
          if($disponibile == 's' && isset($_SESSION['username'])){
            ?>
            <input class="w3-input w3-round-xxlarge" type="submit" value="Aggiungi al carrello"></input>
            <?php
          }else{
            ?>
            <h3 class="w3-round-xxlarge w3-red">non disponible</h3>
            <?php
          }
        ?>
      </div>
    </div>
</div>
  </form>
  <?php
      $i++;
    }
  } else{
    echo "nessun prodotto disponibile";
  }
  ?>

  <!--dialog -->
  <div id="idCart" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
      <div class="w3-center w3-container"><br>
        <span id="close2" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
        <h4>CARRELLO</h4>
        <p>Ecco i prodotti selezionati: </p>
          <p id="txtHint"></p>
      </div>
    </div>
  </div>


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

  <div class="w3-black w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">Coglione</a></div>

  <!-- End page content -->
</div>

<!-- Newsletter Modal -->
<div id="newsletter" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide">NEWSLETTER</h2>
      <p>Join our mailing list to receive updates on new arrivals and special offers.</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('newsletter').style.display='none'">Subscribe</button>
    </div>
  </div>
</div>

<!-- Login -->
<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">

    <div class="w3-center"><br>
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
      <img src="avatar.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
    </div>

    <form class="w3-container" action="/action_page.php">
      <div class="w3-section">
        <label><b>Username</b></label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required>
        <label><b>Password</b></label>
        <input class="w3-input w3-border" type="text" placeholder="Enter Password" name="psw" required>
        <button class="w3-button w3-block w3-orange w3-section w3-padding" type="submit">Login</button>
        <p class="w3-center">Oppure</p>
        <button class="w3-button w3-block w3-orange w3-section w3-padding" type="submit" onclick="opening_registration()">Registrati</button>
        <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
      </div>
    </form>

    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-black">Cancel</button>
      <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
    </div>

  </div>
</div>

<!-- Register -->
<div id="id02" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:800px ">
    <div class="w3-center"><br>
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
      <button class="w3-button w3-orange w3-section w3-padding">Affamato</button>
      <button class="w3-button w3-orange w3-section w3-padding">Fornitore</button>
    </div>
    <form class="w3-container" action="/action_page.php">
      <div class="w3-section w3-left w3-margin-left">
        <label><b>Nome</b></label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required>
        <label><b>Cognome</b></label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Password" name="psw" required>
        <label><b>Cellulare</b></label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required>
        <label><b>Codice fiscale</b></label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Password" name="psw" required>
      </div>
        <div class="w3-section w3-right w3-margin-right">
        <label><b>Username</b></label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required>
        <label><b>Password</b></label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Password" name="psw" required>
        <button class="w3-button w3-block w3-orange w3-section w3-padding" type="submit">Registrati</button>
      </div>
    </form>
    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      <button onclick="login_return()" type="button" class="w3-button w3-black">Cancel</button>
    </div>

  </div>
</div>

<!-- Carrello -->
<div id="id03" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-display-topright w3-margin-right w3-margin-top" onmouseover="carrello_view()" onmouseout="carrello_out()" style="max-width:200px ">
  <header class="w3-container w3-orange">
    <h1>Carrello</h1>
  </header>
  <div class="w3-container">
    <p>ordine</p>
  </div>
  <footer class="w3-container w3-orange">
    <h5>Totale</h5>
  </footer>
</div>
</div>

</body>
</html>

<?php
} else {
  echo 'error2';
}
/*} else {
  echo 'You are not authorized to access this page, please login. <br/>';
}*/
?>
