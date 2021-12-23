<!DOCTYPE html>

<html lang="it">

<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/style.css" type="text/css">
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>
  <script src="../script/login_script.js"></script>
  <script src="../script/sha512.js"></script>
  <script src="../script/forms.js"></script>
</head>

<body class="w3-modal-content w3-card-4">


  <!-- Login -->
  <div id="ViewLogin" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
      <div class="w3-center "><br>
        <div class="w3-display-topleft w3-bar " style="width:100%">
          <input type="button" id="first" class="w3-bar-item w3-button" value="Affamato" style="width:34%">
          <input type="button" id="second" class="w3-bar-item w3-button " value="Fornitore" style="width:33%">
          <input type="button" id="third" class="w3-bar-item w3-button" value="Admin" style="width:33%">
        </div>
        <img id="immagine" src="../img/kungfood.png" alt="Logo" style="width:50%">
      </div>
      <div>
        <form id="logAffamato" class="w3-container"  method="post" action="./process_login_affamato.php">
          <div class="w3-section">
            <label for="logaffuser">Username</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="logaffuser" type="text" placeholder="Enter Username" name="username" required>
            <label for="logaffpass">Password</label>
            <input class="w3-input w3-round-xxlarge w3-border" id="logaffpass" type="password" placeholder="Enter Password" name="psw" required>
            <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Login" type="submit">
            <div id="regButtonAff">
              <input type="button" class="w3-button  w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Registrati">
            </div>
          </div>
        </form>

        <form id="logFornitore" class="w3-container"  method="post" action="./process_login_fornitore.php">
          <div class="w3-section">
            <!--<label for="fornicatore">Type</label>
            <input  type="text" value="logFornitore" id="fornicatore" style="display:none" >-->
            <label for="logforuse">Username</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="logforuse" type="text" placeholder="Enter Username" name="username" required>
            <label for="logforpass">Password</label>
            <input class="w3-input w3-round-xxlarge w3-border" id="logforpass" type="password" placeholder="Enter Password" name="psw" required>
            <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Login" type="submit">
            <div id="regButtonForn">
             <input type="button" class="w3-button  w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Registrati">
            </div>
          </div>
        </form>

        <form id="logAdmin" class="w3-container" method="post" action="./process_login_admin.php">
          <div class="w3-section">
          <!--  <label for="adm">Type</label>
            <input  type="text" value="logFornitore" id="adm" >-->
            <label for="logaduse">Username</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="logaduse" type="text" placeholder="Enter Username" name="username" required>
            <label for="logadpass">Password</label>
            <input class="w3-input w3-round-xxlarge w3-border" id="logadpass" type="password" placeholder="Enter Password" name="psw"required>
            <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" value="Login" type="submit">
          </div>
        </form>

        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
        </div>


        <form id="regAffamato" class="w3-container" method="post" action="./process_registration.php">
          <div class="w3-section">
            <label for="regusen">Nome</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regusen" type="text" placeholder="Enter Name" name="nome" required>
            <label for="reguses">Cognome</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="reguses" type="text" placeholder="Enter Surname" name="surname" required>
            <label for="reguseuse">Username</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="reguseuse" type="text" placeholder="Enter Username" name="username" required>
            <label for="regusepass">Password</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regusepass" type="text" placeholder="Enter Password" name="psw" required>
            <label for="regusepassc">Conferma Password</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regusepassc" type="text" placeholder="Enter Password" name="repsw" required>

            <div class="w3-section">
              <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" type="submit" value="Registrati">
            </div>
          </div>
        </form>

        <form id="regFornitore" class="w3-container" method="post" action="">
          <div class="w3-section">
            <label for="regforn">Produttore</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regforn" type="text" placeholder="Enter Name" name="name" required>
            <label for="regforpro">Proprietario</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regforpro" type="text" placeholder="Enter Surname" name="name" required>
            <label for="regforuse">Username</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regforuse" type="text" placeholder="Enter Username" name="username" required>
            <label for="regforpass">Password</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regforpass" type="text" placeholder="Enter Password" name="psw" required>
            <label for="regforpassc">Conferma Password</label>
            <input class="w3-input w3-round-xxlarge w3-border w3-margin-bottom" id="regforpassc" type="text" placeholder="Enter Password" name="repsw" required>

            <div class="w3-section">
              <input class="w3-button w3-round-xxlarge w3-block w3-amber w3-section w3-padding" type="submit" value="Registrati">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>
