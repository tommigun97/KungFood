<?php
include '../db_connect.php';
include '../functions.php';

sec_session_start();
if (isset($_SESSION['username'])) {
    $userName = $_SESSION['username'];
    if (isset($_SESSION['notifiche'])) {
        $notifiche = $_SESSION['notifiche'];
    }else{
      $notifiche ="Nessuna Notifica";
    }
    if (isset($_SESSION['numero'])) {
      $numNotifiche = $_SESSION['numero'];
    }else{
      $numNotifiche = 0;
    }

    if ($stmtA = $mysqli->prepare("SELECT Nome FROM cliente WHERE Username = ? LIMIT 1")) {
        $stmtA->bind_param('s', $userName);
        $stmtA->execute();
        $stmtA->store_result();
        $stmtA->bind_result($nameUs);
        $stmtA->fetch();
        $stmtA->close();
    }
} else {
    $nameUs = "";
}

/*if(login_check($mysqli) == true){*/
if ($stmt = $mysqli->prepare("SELECT Nome, Descrizione, Logo, Username FROM fornitore WHERE Banned = 0 ORDER BY RAND() LIMIT 6")) {
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
  <link rel="stylesheet" href="../../css/style.css" type="text/css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="../../script/jquery_script.js"></script>
  <script src="../../script/script.js"></script>
  <script src="../../script/easteregg.js"></script>
  <script src="../../script/ajaxUser.js"></script>
</head>


<body class="w3-display-container">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-amber w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><a href="./paginaTemplate.php">Kung Food</a></h3>
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
    <p class="w3-left">Benvenuto <?php echo $nameUs ?>, pronto a combattere la fame?</p><br/><br/>
    <p class="w3-right">
      <i class="fa fa-user" id="Login"></i>
      <label for="ricerca"></label>
        <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" style="display:none" type="text" id="ricerca" placeholder="Search.." name="search">
    </p>
    <?php
        if (isset($_SESSION['username'])) {
    ?>
      <div class="username" style="display:none"><?php echo $userName ?></div>
    <br/>


    <button class="w3-btn w3-border w3-left"  onclick="document.getElementById('id01').style.display='block'">Mostra Notifiche ( <?php echo $numNotifiche ?> )</button>
    <br/>
    <br/>

    <div id="id01" class="w3-panel w3-green w3-display-container" style="display:none">
      <span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright"><a href="./deleteNotifyUser.php">X</a></span>
      <p><?php echo $notifiche ?></p>
    </div>
    <?php
        }
    ?>

  </header>

  <!-- Image header -->
  <div class="w3-display-container w3-container ">
    <div style="margin-left: 20%">
      <img class="mySlides" src="../../img/kungfood2.png" alt="logo"
      style="width:70%">
    </div>
    <div class="w3-display-topleft w3-text-white" style="padding:24px 48px"></div>
  </div>

  <div class="w3-container w3-text-grey" style="margin-bottom: 5%">
    <p id="easter" style="text-align: center">C'è un uomo al ristorante e fa al cameriere:<br/>
      - "Cameriere, c'è un capello nella mia pizza!!"<br/>
      - "è impossibile signore, l'abbiamo fatta con i pelati".</p>
  </div>
  <div class="w3-center w3-margin-left">
  <?php
if ($stmt->num_rows > 0) {
        while ($i < $stmt->num_rows) {
            $stmt->bind_result($nome, $logo, $img, $user_id); // recupera le variabili dal risultato ottenuto.
            $stmt->fetch();
            ?>
  <!-- Product grid  -->
    <div class="w3-hover-opacity">
        <div class="w3-container w3-round-xxlarge w3-margin-bottom w3-third w3-card-4">
          <a href="homeFornitore.php?nomeFornitore=<?php echo $nome ?>&immagine=<?php echo $img ?>&username=<?php echo $user_id ?>" id="imgRist">
            <p><?php echo $nome?></p>
            <img src="../../img/Ristoranti/<?php echo $img ?>" alt="<?php echo $nome ?>">
            <p><?php echo $logo; ?></p>
          </a>
        </div>
      </div>
      <?php
          $i++;
        }
    } else {
        echo 'error1';
    }
} else {
    echo 'error2';
}
?>
</div>

  <?php
    if(isset($_GET['blocca'])){
      if($_GET['blocca'] == 1){
   ?>
      <div id="ViewBlock" class="w3-modal" style="display:block">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
          <div class="w3-center"><br>
              <div class="w3-display w3-bar" style="width:100%">
                <span onclick="document.getElementById('ViewBlock').style.display='none'" class="w3-button w3-center w3-xlarge w3-transparent w3-margin-bottom w3-display-topright" style="width:10%" title="Close Modal">X</span>
                <p class="w3-center w3-xlarge">L'ordine può essere relativo ad un solo fornitore</p>
                <img id="immagine" src="../../img/kungfood.png" alt="Logo" style="width:50%">
            </div>
          </div>
        </div>
      </div>

  <?php
    }
  }
  ?>

  <?php
    if(isset($_GET['showYeah'])){
      if($_GET['showYeah'] == 'si'){
   ?>
   <div id="ViewBlock" class="w3-modal" style="display:block">
     <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
       <div class="w3-center"><br>
           <div class="w3-display w3-bar" style="width:100%">
             <span onclick="document.getElementById('ViewBlock').style.display='none'" class="w3-button w3-center w3-xlarge w3-transparent w3-margin-bottom w3-display-topright" style="width:10%" title="Close Modal">X</span>
             <img src="../../img/yeah.png" alt="Avatar" style="width:60%" class=" w3-margin-top">
           </div>
           <div class="w3-center w3-green">
             <p>PAGAMENTO ACCETTATO<br>ora non ti resta che abbuffarti</p>
           </div>
       </div>
     </div>
   </div>
  <?php
    }
  }
  ?>


   <div id="ViewLogin" class="w3-modal " style="display:none">
     <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
       <div class="w3-center "><br>
           <div class="w3-display-topleft w3-bar " style="width:100%">
             <span onclick="document.getElementById('ViewLogin').style.display='none'" class="w3-button w3-center w3-xlarge w3-transparent w3-margin-bottom w3-display-topright" style="width:10%" title="Close Modal">X</span>
           <input type="button" id="first" class="w3-bar-item w3-button" value="Affamato" style="width:30%">
           <input type="button" id="second" class="w3-bar-item w3-button " value="Fornitore" style="width:30%">
           <input type="button" id="third" class="w3-bar-item w3-button" value="Admin" style="width:30%">
         </div>
         <img id="immagine" src="../../img/kungfood.png" alt="Logo" style="width:50%">
       </div>
       <div>
         <form id="logAffamato" class="w3-container"  method="post" action="./process_login.php">
           <div class="w3-section">
           <label for="logaffuse">Email</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="logaffuse" type="text" placeholder="Enter Email" name="username" required>
             <label for="logaffpass">Password</label>
             <input class="w3-input w3-round-xxlarge w3-border" id="logaffpass" type="password" placeholder="Enter Password" name="psw" required>
             <input type="hidden" name="type" value="affamato">
             <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Login" type="submit">
             <div id="regButtonAff">
               <input type="button" class="w3-button  w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Registrati">
             </div>
           </div>
         </form>

         <form id="logFornitore" class="w3-container"  method="post" action="./process_login.php">
           <div class="w3-section">
           <label for="logforuse">Email</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="logforuse" type="text" placeholder="Enter Email" name="username" required>
             <label for="logforpass">Password</label>
             <input class="w3-input w3-round-xxlarge w3-border" id="logforpass" type="password" placeholder="Enter Password" name="psw" required>
             <input type="hidden" name="type" value="fornitore">
             <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Login" type="submit">
             <div id="regButtonForn">
              <input type="button" class="w3-button  w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Registrati">
             </div>
           </div>
         </form>

         <form id="logAdmin" class="w3-container" method="post" action="./process_login.php">
           <div class="w3-section">
             <label for="logaduse">Email</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="logaduse" type="text" placeholder="Enter Email" name="username" required>
             <label for="logadpass">Password</label>
             <input class="w3-input w3-round-xxlarge w3-border" id="logadpass" type="password" placeholder="Enter Password" name="psw" required>
             <input type="hidden" name="type" value="admin">
             <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Login" type="submit">
           </div>
         </form>

         <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
           <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
         </div>


         <form id="regAffamato" class="w3-container" method="post" action="./process_registration.php">
           <div class="w3-section">
           <p>Al termine della registrazione, arriverà una mail di conferma all'indirizzo inserito.</p>
             <label for="regusen">Nome</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regusen" type="text" placeholder="Enter Name" name="name" required>
             <label for="reguses">Cognome</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="reguses" type="text" placeholder="Enter Surname" name="surname" required>
             <label for="reguseuse">Email</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="reguseuse" type="email" placeholder="Enter Email" name="username" required>
             <label for="regusepass">Password</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regusepass" type="password" placeholder="Enter Password" name="psw" required>
             <label for="regusepassc">Conferma Password</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regusepassc" type="password" placeholder="Enter Password" name="repsw" required>
             <input type="hidden" name="type" value="affamato">

             <div class="w3-section">
               <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" type="submit" value="Registrati">
             </div>
           </div>
         </form>

         <form id="regFornitore" class="w3-container" method="post" action="./process_registration.php">
           <div class="w3-section">
           <p>Al termine della registrazione, arriverà una mail di conferma all'indirizzo inserito.</p>
             <label for="regforn">Nome Attività</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regforn" type="text" placeholder="Enter Shop's Name" name="nome" required>
             <label for="regforpro">Proprietario</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regforpro" type="text" placeholder="Enter Owner" name="proprietario" required>
             <label for="regforuse">Email</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regforuse" type="email" placeholder="Enter Email" name="username" required>
             <label for="regforpass">Password</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regforpass" type="password" placeholder="Enter Password" name="psw" required>
             <label for="regforpassc">Conferma Password</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regforpassc" type="password" placeholder="Enter Password" name="repsw" required>
             <input type="hidden" name="type" value="fornitore">
             <div class="w3-section">
               <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" type="submit" value="Registrati">
             </div>
           </div>
         </form>
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
          <a class="fa fa-facebook-official w3-hover-opacity w3-large" title="facebook" href="https://it-it.facebook.com"></a>
          <a class="fa fa-instagram w3-hover-opacity w3-large" title="instagram" href="https://www.instagram.com/?hl=it"></a>
        </div>
      </div>
    </footer>


    <!-- End page content -->
  </div>

</body>

</html>
