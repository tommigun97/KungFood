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

if ($stmt = $mysqli->prepare("SELECT Id, Nome, Costo, Presente, Descrizione, UrlFoto FROM prodotto WHERE IdFornitore = ?")) {
    $stmt->bind_param('s', $id_forn);
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
  <!--Fine Imporate-->

  <script src="../script/jquery_script.js"></script>
  <script src="../script/ajaxForn.js"></script>
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
  <header class="w3-container w3-padding-large w3-margin" >
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
  <h2>Listino dei Prodotti</h2>

  <table class="w3-table-all w3-centered w3-responsive">
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Costo</th>
      <th>Presente</th>
      <th>Descrizione</th>
      <th>Url Foto</th>
      <!--<th>Cambia Foto</th>-->
      <th colspan="2" >Edit</th>
    </tr>
    <tr>
    <form method="post" action="./insert.php">
      <td><input class="w3-input w3-border w3-round" type="text" name="id" placeholder="Id Univoco"> </td>
      <td><input class="w3-input w3-border w3-round" type="text" name="nome" placeholder="Nome"></td>
      <td><input class="w3-input w3-border w3-round" type="text" name="costo" placeholder="Costo"></td>
      <td><select name="presente" class="w3-input w3-border w3-middle w3-round">
            <option value="s">Si</option>
              <option value="n">No</option>
        </select>
      </td>
      <td><input class="w3-input w3-border w3-round" type="text" name="desc" placeholder="Descr."></td>
      <td><input class="w3-input w3-border w3-round" type="text" name="urlfoto" placeholder="Url"></td>
      <td colspan="2"><input type="submit" class="w3-button w3-teal w3-round-large" value="+" name="insert"></td>
      <input type="hidden" name="id_forn" value="<?php echo $id_forn ?>">
    </form>
    </tr>
    <?php
if ($stmt->num_rows > 0) {
        while ($i < $stmt->num_rows) {
            $stmt->bind_result($id, $nome, $costo, $presente, $desc, $url); // recupera le variabili dal risultato ottenuto.
            $stmt->fetch();
            ?>
    <tr>
    <form method="post" action="./update.php">
      <td><input class="w3-input w3-border w3-round" type="text" name="id" value="<?php echo $id; ?>"> </td>
      <td><input class="w3-input w3-border w3-round" type="text" name="nome" value="<?php echo $nome; ?>"></td>
      <td><input class="w3-input w3-border w3-round" type="text" name="costo" value="<?php echo $costo; ?>"></td>
      <td><select name="presente" class="w3-input w3-border w3-middle w3-round">
            <option <?php if ($presente == "s") {echo "selected";}?> value="s">Si</option>
              <option <?php if ($presente == "n") {echo "selected";}?> value="n">No</option>
        </select>
      </td>
      <td><input class="w3-input w3-border w3-round" type="text" name="desc" value="<?php echo $desc; ?>"></td>
      <td><input class="w3-input w3-border w3-round" type="text" name="urlfoto" value="<?php echo $url; ?>"></td>
      <td><input type="submit" class="w3-button w3-teal w3-round-large" name="edit" value="Edit"></td>
      <input type="hidden" name="id_forn" value="<?php echo $id_forn ?>">

      </form>

      <td><a class="w3-button w3-red w3-round-large" href="./delete.php?id=<?php echo $id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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



  <?php
if (!isset($_SESSION['username'], $_SESSION['login_string'])) {
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
         <img id="immagine" src="../img/kungfood.png" alt="Logo" style="width:50%">
       </div>
       <div>
         <form id="logAffamato" class="w3-container"  method="post" action="./process_login.php">
           <div class="w3-section">
           <label for="logaffuse">Email</label>
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="logaffuse" type="email" placeholder="Enter Email" name="username" required>
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
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="logforuse" type="email" placeholder="Enter Email" name="username" required>
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
             <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="logaduse" type="email" placeholder="Enter Email" name="username" required>
             <label for="logadpass">Password</label>
             <input class="w3-input w3-round-xxlarge w3-border" id="logadpass" type="password" placeholder="Enter Password" name="psw"required>
             <input type="hidden" name="type" value="admin">
             <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Login" type="submit">
           </div>
         </form>

         <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
           <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
         </div>


         <form id="regAffamato" class="w3-container" method="post" action="./user/process_registration.php">
         <p>Al termine della registrazione, arriverà una mail di conferma all'indirizzo inserito.</p>
           <div class="w3-section">
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

         <form id="regFornitore" class="w3-container" method="post" action="./user/process_registration.php">
         <p>Al termine della registrazione, arriverà una mail di conferma all'indirizzo inserito.</p>
           <div class="w3-section">
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
   <?php
} else {
    ?>

<div id="ViewLogin" class="w3-modal " style="display:none">
     <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
       <div class="w3-center "><br>
           <div class="w3-display-topleft w3-bar " style="width:100%">
             <span onclick="document.getElementById('ViewAccount').style.display='none'" class="w3-button w3-center w3-xlarge w3-transparent w3-margin-bottom w3-display-topright" style="width:10%" title="Close Modal">X</span>
          </div>
         <img id="immagine" src="../img/kungfood.png" alt="Logo" style="width:50%">
       </div>
       <div>
       <div class="w3-container w3-section">
       <a href="#" class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding">Modifica Profilo</a>
       </div>
         <form  class="w3-container"  method="post" action="./user/logout.php">
            <div class="w3-section">
              <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Logout" type="submit">
            </div>
        </form>
      </div>
    </div>
</div>
         </form>

    <?php
}
?>


 <!-- Footer -->
 <!--<footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
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
    </footer>-->


    <!-- End page content -->
  </div>


</body>

</html>
