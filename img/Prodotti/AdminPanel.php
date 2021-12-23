<?php
include 'db_connect.php';
include 'functions.php';

sec_session_start();

/*if(login_check($mysqli) == true){*/
  if($stmt = $mysqli->prepare("SELECT Nome, Descrizione, Logo FROM fornitore")){
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
<link rel="stylesheet" href="../css/style.css" type="text/css">
<script src="../script/script.js" type="text/javascript"></script>
<script src="../script/eastereag.js" type="text/javascript"></script>

<!--Questi tre stylesheet successivi si possono usare, se non si può, non va il login-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body  style="max-width:1200px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-amber w3-collapse w3-top" style="z-index:3; width:18%;" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>Kung Food</b></h3>
  </div>
  <div class="w3-padding-64 w3-large " style="font-weight:bold">
    <a href="#" class="w3-bar-item w3-button">Ristoranti</a>
    <a href="#" class="w3-bar-item w3-button">Utenti</a>
    <a href="#" class="w3-bar-item w3-button">Ordini</a>
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
      <i class="fa fa-search " id="search"></i>
      <i class="fa fa-user " ></i>
    </p>
  </header>

  <div class="w3-row w3-grayscale">
    <?php
    if($stmt->num_rows > 0) {
      while($i < $stmt->num_rows){
        $stmt->bind_result($nome, $logo, $img); // recupera le variabili dal risultato ottenuto.
        $stmt->fetch();
    ?>
   <div class="w3-col l3 s6">
     <div class="w3-container">
       <div class="w3-display-container">
         <img src="../img/Ristoranti/<?php echo $img ?>" style="width:100%">
         <div class="w3-display-middle w3-bar w3-amber  w3-round-xxlarge w3-display-hover">
           <button class="w3-button"><i class="fa fa-bed" aria-hidden="true"></i></button>
           <button class="w3-button"><i class="fa fa-eye" aria-hidden="true"></i></button>
           <button class="w3-button"><i class="fa fa-eye-slash " aria-hidden="true"></i></button>
           <button class="w3-button" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
         </div>
         <p><?php echo $logo;?></p>
       </div>
     </div>
   </div>
   <?php
   $i++;
   }
 } else {
   echo 'error1';
 }
}
else{
 echo 'error2';
}
?>
    <!-- <div class="w3-container">
       <div class="w3-display-container">
         <img src="../img/ristoranti/Ciccia.jpg" style="width:100%">
         <div class="w3-display-middle w3-bar w3-amber  w3-round-xxlarge w3-display-hover">
           <button class="w3-button "><i class="fa fa-bed" aria-hidden="true"></i></button>
           <button class="w3-button "><i class="fa fa-eye" aria-hidden="true"></i></button>
           <button class="w3-button "><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
           <button class="w3-button" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
         </div>
       </div>
     </div>
   </div>
   <div class="w3-col l3 s6">
     <div class="w3-container">
       <div class="w3-display-container">
         <img src="../img/ristoranti/Grill.jpg" style="width:100%">
         <div class="w3-display-middle w3-bar w3-amber  w3-round-xxlarge w3-display-hover">
           <button class="w3-button"><i class="fa fa-bed" aria-hidden="true"></i></button>
           <button class="w3-button"><i class="fa fa-eye " aria-hidden="true"></i></button>
           <button class="w3-button"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
           <button class="w3-button" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
         </div>
       </div>
     </div>
     <div class="w3-container">
       <div class="w3-display-container">
         <img src="../img/ristoranti/Ciccia.jpg" style="width:100%">
         <div class="w3-display-middle w3-bar w3-amber  w3-round-xxlarge w3-display-hover">
           <button class="w3-button "><i class="fa fa-bed" aria-hidden="true"></i></button>
           <button class="w3-button "><i class="fa fa-eye" aria-hidden="true"></i></button>
           <button class="w3-button "><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
           <button class="w3-button" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
         </div>
       </div>
     </div>
   </div>
   <div class="w3-col l3 s6">
     <div class="w3-container">
       <div class="w3-display-container">
         <img src="../img/ristoranti/Sakura.png" style="width:100%">
         <div class="w3-display-middle w3-amber w3-bar  w3-round-xxlarge w3-display-hover">
           <button class="w3-button"><i class="fa fa-bed" aria-hidden="true"></i></button>
           <button class="w3-button"><i class="fa fa-eye " aria-hidden="true"></i></button>
           <button class="w3-button"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
           <button class="w3-button" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
         </div>
       </div>
     </div>
     <div class="w3-container">
       <div class="w3-display-container">
         <img src="../img/ristoranti/Ciccia.jpg" style="width:100%">
         <div class="w3-display-middle w3-bar w3-amber w3-round-xxlarge w3-display-hover">
           <button class="w3-button "><i class="fa fa-bed" aria-hidden="true"></i></button>
           <button class="w3-button "><i class="fa fa-eye" aria-hidden="true"></i></button>
           <button class="w3-button "><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
           <button class="w3-button" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
         </div>
       </div>
     </div>
   </div>


 </div>-->
 <div id="id01" class="w3-modal">
<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
  <div class="w3-center"><br>
    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-margin-bottom w3-display-topright" title="Close Modal">×</span>
    <div class="w3-container">
      <div class="w3-display-container">
        <img src="../img/ristoranti/Grill.jpg" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
        <div class="w3-display-bottomright w3-amber w3-round-xxlarge">
          <button class="w3-button w3-round-xxlarge"><i class=" fa fa-file-image-o" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>

  <form class="w3-container" action="/action_page.php">
    <div class="w3-section">
      <label><b>Nome</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" placeholder="Enter Username" name="usrname" required>
      <label><b>Proprietario</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" placeholder="Enter Password" name="psw" required>
      <label><b>Username</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" placeholder="Enter Username" name="usrname" required>
      <label><b>Password</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" placeholder="Enter Password" name="psw" required>
      <label><b>P.IVA</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" placeholder="Enter Username" name="usrname" required>
      <label><b>Descrizione</b></label>
      <input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" placeholder="Enter Password" name="psw" required>
      <button class="w3-button w3-block w3-amber w3-round-xxlarge w3-section w3-padding" type="submit">Modifica</button>
    </div>
  </form>

  <div class="w3-container w3-border-top w3-padding-16 w3-amber">
    <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-round-xxlarge w3-green">Confirm</button>
    <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-round-xxlarge w3-right w3-red">Cancel</button>
  </div>

</div>
</div>
<!-- End page content -->
</div>
</body>
</html>
