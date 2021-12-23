<?php
include 'db_connect.php';
include 'functions.php';

sec_session_start();

/*if(login_check($mysqli) == true){*/
if ($stmt = $mysqli->prepare("SELECT Nome, Username, Descrizione, Logo FROM fornitore")) {
    $stmt->execute(); // esegue la query appena creata.
    $stmt->store_result();
    $i = 0;
    ?>

<!DOCTYPE html>

<html lang ="it">
<head>
<title>Prodotti</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/style.css" type="text/css">
<script src="../script/jquery_script.js" ></script>
<script src="../script/script.js" ></script>


<!--Questi tre stylesheet successivi si possono usare, se non si può, non va il login-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body  style="max-width:1200px">

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-bar-block w3-amber w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
      <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>Kung Food</b></h3>
  </div>
   <div class="w3-padding-64 w3-large " style="font-weight:bold">
     <a href="./AdminPanel.php" class="w3-bar-item w3-button">Ristoranti</a>
     <a href="./adminViewUsers.php" class="w3-bar-item w3-button">Utenti</a>
     <a href="./adminViewOrder.php" class="w3-bar-item w3-button">Ordini</a>
     <a href="./user/logout.php" class="w3-bar-item w3-button">Logout</a>
   </div>

</nav>

<!-- Top menu on small screens -->

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
  <header class="w3-container w3-padding-large">
    <p class="w3-right">
      <!--<i class="fa fa-user"></i>-->
    </p>
  </header>

  <div >
    <?php
if ($stmt->num_rows > 0) {
        while ($i < $stmt->num_rows) {
            $stmt->bind_result($nome, $username, $logo, $img); // recupera le variabili dal risultato ottenuto.
            $stmt->fetch();
            ?>
   <div class="w3-col l3 s6">
     <div class="w3-container">
       <div class="w3-display-container  w3-padding w3-round-xxlarge w3-card-4">
         <p><?php echo $nome ?></p>
         <img src="../img/Ristoranti/<?php echo $img ?>" alt="<?php echo $nome ?>" style="width:100%">
         <div id="coo" class="w3-display-middle w3-bar w3-amber  w3-round-xxlarge w3-display-hover">
           <a href="./unbannedFornitore.php?user_id=<?php echo $username ?>">
           <button class="w3-button"><i class="fa fa-eye" aria-hidden="true"></i></button> </a>
           <a href="./bannedFornitore.php?user_id=<?php echo $username ?>">
           <button class="w3-button"><i class="fa fa-eye-slash " aria-hidden="true"></i></button> </a>
           <a href="./modifyFornAdmin.php?user_id=<?php echo $username ?>">
           <button class="w3-button"><i class="fa fa-pencil-square" aria-hidden="true"></i></button> </a>


         </div>
         <p><?php echo $logo; ?></p>
       </div>
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

</div>



</body>
</html>
