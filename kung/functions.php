<?php

function sec_session_start()
{
    $session_name = 'sec_session_id'; // Imposta un nome di sessione
    $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
    $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
    ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
    $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
    session_start(); // Avvia la sessione php.
    session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}

function loginAffamato($user, $password, $mysqli)
{
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.

    if ($stmtA = $mysqli->prepare("SELECT Username, Password FROM cliente WHERE Username = ? LIMIT 1")) {
        $stmtA->bind_param('s', $user); // esegue il bind del parametro '$email'.
        $stmtA->execute(); // esegue la query appena creata.
        $stmtA->store_result();
        $stmtA->bind_result($username, $db_password); // recupera il risultato della query e lo memorizza nelle relative variabili.
        $stmtA->fetch();

        //$password = hash('sha512', $password); // codifica la password usando una chiave univoca.
        if ($stmtA->num_rows == 1) { // se l'utente esiste
            if ($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                // Password corretta!
                $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

                $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                // Login eseguito con successo.
                $stmtA->close();
                return true;
            } else {
                // Password incorretta.
                $stmtA->close();
                return false;
            }
        } else {
            // L'utente inserito non esiste.
            $stmtA->close();
            return false;
        }
    }
}

function loginFornitore($user, $password, $mysqli)
{
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.

    if ($stmtF = $mysqli->prepare("SELECT Username, Password FROM fornitore WHERE Username = ? LIMIT 1")) {
        $stmtF->bind_param('s', $user); // esegue il bind del parametro '$email'.
        $stmtF->execute(); // esegue la query appena creata.
        $stmtF->store_result();
        $stmtF->bind_result($username, $db_password); // recupera il risultato della query e lo memorizza nelle relative variabili.
        $stmtF->fetch();
        //$password = hash('sha512', $password); // codifica la password usando una chiave univoca.
        if ($stmtF->num_rows == 1) { // se l'utente esiste
            if ($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                // Password corretta!
                $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

                //$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                // Login eseguito con successo.
                $stmtF->close();
                return true;
            } else {
                // Password incorretta.
                $stmtF->close();
                return false;
            }
        } else {
            // L'utente inserito non esiste.
            $stmtF->close();
            return false;
        }
    }
}

function loginAdmin($user, $password, $mysqli)
{
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.

    if ($stmt = $mysqli->prepare("SELECT Username, Password FROM amministratore WHERE Username = ? LIMIT 1")) {
        $stmt->bind_param('s', $user); // esegue il bind del parametro '$email'.
        $stmt->execute(); // esegue la query appena creata.
        $stmt->store_result();
        $stmt->bind_result($username, $db_password); // recupera il risultato della query e lo memorizza nelle relative variabili.
        $stmt->fetch();
        //$password = hash('sha512', $password); // codifica la password usando una chiave univoca.
        if ($stmt->num_rows == 1) { // se l'utente esiste
            if ($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                // Password corretta!
                $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

                //$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                // Login eseguito con successo.
                $stmt->close();
                return true;
            } else {
                // Password incorretta.
                $stmt->close();
                return false;
            }
        } else {
            // L'utente inserito non esiste.
            $stmt->close();
            return false;
        }
    }
}

function regAffamato($nome, $cognome, $user, $password, $mysqli)
{
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
    //$password = hash('sha512', $password); // codifica la password usando una chiave univoca.
    if ($stmt = $mysqli->prepare("INSERT INTO `cliente` (`Username`, `Nome`, `Cognome`, `Password`, `Telefono`) VALUES (?, ?, ?, ?, NULL);")) {
        $stmt->bind_param("ssss", $user, $nome, $cognome, $password); // esegue il bind del parametro '$email'.
        $isInserted = $stmt->execute(); // esegue la query appena creata.
        echo $isInserted;
        if (!$isInserted) {
            $stmt->close();
            return false;
        } else {
            $stmt->close();
            return true;
        }
    }
}
///DA SISTEMARE
function regFornitore($nome, $proprietario, $user, $password, $mysqli)
{
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
    if ($stmt = $mysqli->prepare("INSERT INTO `fornitore`(`Nome`, `Username`, `Password`, `Propietario`, `Banned`, `IdCategoria`, `P_IVA`, `Descrizione`, `Logo`) VALUES (?,?,?,?, NULL, NULL, NULL, NULL, NULL)")) {
        $stmt->bind_param("ssss", $nome, $user, $password, $proprietario); // esegue il bind del parametro '$email'.
        $isInserted = $stmt->execute(); // esegue la query appena creata.
        echo $isInserted;
        if (!$isInserted) {
            $stmt->close();
            return false;
        } else {
            $stmt->close();
            return true;
        }
    }

    $password = hash('sha512', $password); // codifica la password usando una chiave univoca.
    if ($stmt = $mysqli->prepare("INSERT INTO `fornitore`(`Nome`, `Username`, `Propietario`, `P_IVA`, `Logo`) VALUES (?,?,?,NULL,NULL)")) {
        $stmt->bind_param("ssss", $user, $nome, $cognome, $password); // esegue il bind del parametro '$email'.
        $stmt->execute(); // esegue la query appena creata.
        $stmt->close();
    }
}

function login_check($mysqli)
{
    // Verifica che tutte le variabili di sessione siano impostate correttamente
    if (isset($_SESSION['username'], $_SESSION['login_string'])) {
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
        $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
        if ($stmt = $mysqli->prepare("SELECT Password FROM CLIENTE WHERE Username = ? LIMIT 1")) {
            $stmt->bind_param('i', $username); // esegue il bind del parametro '$user_id'.
            $stmt->execute(); // Esegue la query creata.
            $stmt->store_result();

            if ($stmt->num_rows == 1) { // se l'utente esiste
                $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
                if ($login_check == $login_string) {
                    // Login eseguito!!!!
                    return true;
                } else {
                    //  Login non eseguito
                    return false;
                }
            } else {
                // Login non eseguito
                return false;
            }
        } else {
            // Login non eseguito
            return false;
        }
    } else {
        // Login non eseguito
        return false;
    }
}

// inserisco in prodotto ordinato (il carrello) e nell'ordine il prodotto selezionato
function insert_into_cart($mysqli, $quantita, $prodottoId, $idCliente){
  $ordine = trova_ordine($mysqli, $idCliente, $prodottoId);
  echo $ordine;
  if($quantita == 0){
    $quantita++;
  }
  if(!controlPres($mysqli, $quantita, $prodottoId, $ordine)){
    if ($stmt = $mysqli->prepare("INSERT INTO `prodotto_ordinato` (`Numero`, `IdOrdine`, `IdProdotto`) VALUES (?, ?, ?)")) {
        $stmt->bind_param("sss", $quantita, $ordine, $prodottoId);
        $isInserted = $stmt->execute();
      if(!$isInserted){
        $stmt->close();
        return false;
      } else{
        $stmt->close();
        return true;
       }
     } else{
       return false;
     }
   } else{
     return true;
   }
}

//controllo se esiste un ordine non ancora completato
function trova_ordine($mysqli, $idCliente, $prodottoId){
  $fornitore = find_fornitore($mysqli, $prodottoId);
  if(blockOrder($mysqli, $idCliente, $fornitore)){
    return false;
  }
  $stateFault = 'Attesa';
  if ($stmt = $mysqli->prepare("SELECT Id FROM ordine WHERE IdCliente = ? AND StatoOrdine = ?")) {
    $stmt->bind_param('ss', $idCliente, $stateFault);
    $stmt->execute();
    $stmt->store_result();
    //esiste un ordine in sospeso
    if ($stmt->num_rows >= 1) {
      $stmt->bind_result($idOrd);
      $stmt->fetch();
      return $idOrd;
    }else{ //non esiste allora bisogna crearne uno nuovo
      $newOrderNumb = create_new_oreder($mysqli, $idCliente, $prodottoId, $fornitore);
      return $newOrderNumb;
    }
  } else{
    return false;
  }
}

//crea un nuovo ordine in quanto non ce ne sono piu in stato Attesa
function create_new_oreder($mysqli, $idCliente, $prodottoId, $fornitore){
    //prendi l'ordine con id piu alto
  $state = "Attesa";
  if ($stmt = $mysqli->prepare("SELECT MAX(Id) FROM ordine")) {
    $stmt->execute();
    $stmt->store_result();
    //esistono ordini
    if($stmt->num_rows == 1){
      $stmt->bind_result($idOrd);
      $stmt ->fetch();
      $idOrd++;
      if ($stmt = $mysqli->prepare("INSERT INTO `ordine`(`Id`, `Costo`, `BloccodiConsegna`, `Orario`, `Data`, `StatoOrdine`, `IdCliente`, `IdFornitore`) VALUES (?, NULL, NULL, NULL, NULL, ?, ?, ?)")) {
        $stmt->bind_param("ssss", $idOrd, $state, $idCliente, $fornitore); // esegue il bind del parametro '$email'.
        $isInsert = $stmt->execute();
        if(!$isInsert){
          $stmt->close();
          return false;
        } else{
          $stmt->close();
          return $idOrd;
        }
      }
    } else{ //creo il primo ordine in quanto non ne esistono altri
      if ($stmt = $mysqli->prepare("INSERT INTO `ordine`(`Id`, `Costo`, `BloccodiConsegna`, `Orario`, `Data`, `StatoOrdine`, `IdCliente`, `IdFornitore`) VALUES (?, NULL, NULL, NULL, NULL, ?, ?, ?)")) {
            $stmt->bind_param("1", $state, $idCliente, $fornitore); // esegue il bind del parametro '$email'.
            $isInserted = $stmt->execute();
            if(!$isInserted){
              $stmt->close();
              return false;
            } else{
              $stmt->close();
              return "1";
             }
       } else{
          return false;
      }
    }
  } else{
    return false;
  }
}

//trova il giusto fornitore a cui associare l'ordine
function find_fornitore($mysqli, $prodottoId){
  if ($stmt = $mysqli->prepare("SELECT F.Username FROM prodotto As P, fornitore As F WHERE P.Id = ? AND P.IdFornitore = F.Username")) {
    $stmt->bind_param('s', $prodottoId);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 0){
      return false;
    }
    $stmt->bind_result($forn);
    $stmt->fetch();
    return $forn;
  } else{
    return false;
  }
}

function controlPres($mysqli, $quantita, $prodottoId, $ordine){
  if ($stmt = $mysqli->prepare("SELECT Numero FROM prodotto_ordinato WHERE IdOrdine = ? AND IdProdotto = ?")) {
    $stmt->bind_param('ss', $ordine, $prodottoId);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 0){
      return false;
    } else{
      $stmt->bind_result($numero);
      $stmt->fetch();
      $numero = $numero + $quantita;
      if ($stmt = $mysqli->prepare("UPDATE `prodotto_ordinato` SET `Numero`= ? WHERE IdOrdine = ? AND IdProdotto = ?")) {
        $stmt->bind_param('sss', $numero, $ordine, $prodottoId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->close();
        return true;
      }else{
        return false;
      }
    }
  } else{
    return false;
  }
}


function blockOrder($mysqli, $Idcliente, $fornitore){
  $state = "Attesa";
  if ($stmt = $mysqli->prepare("SELECT IdFornitore FROM ordine WHERE IdCliente = ? AND StatoOrdine = ?")) {
    $stmt->bind_param('ss', $Idcliente, $state);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($IdF);
    $stmt->fetch();
    if($IdF == $fornitore || $stmt->num_rows == 0){
      //ok non c'è bisogno di bloccarlo
      return false;
    } else{
      //esiste già blocca!
      header('Location: ./paginaTemplate.php?blocca=1');
      return true;
    }
  }
}


//delete prodotto_ordinato
function delete_product($mysqli, $Idordine, $idProdotto){
  $zero = "0";
  $statoDelete = "Eliminato";
  if ($stmt = $mysqli->prepare("UPDATE `prodotto_ordinato` SET `Numero`= ? WHERE IdOrdine = ? AND IdProdotto = ?")){
    $stmt->bind_param('sss', $zero, $Idordine, $idProdotto); // esegue il bind del parametro '$email'.
    $stmt->execute(); // esegue la query appena creata.
    $stmt->store_result();
    if ($stmt = $mysqli->prepare("SELECT IdOrdine FROM prodotto_ordinato WHERE IdOrdine = ? AND Numero > ?")){
      $stmt->bind_param('ss', $Idordine, $zero); // esegue il bind del parametro '$email'.
      $stmt->execute();
      $stmt->store_result();
      if($stmt->num_rows == 0){
        if($stmt = $mysqli->prepare("UPDATE `ordine` SET `StatoOrdine`= ? WHERE Id = ?")){
            $stmt->bind_param('ss', $statoDelete, $Idordine); // esegue il bind del parametro '$email'.
            $stmt->execute(); // esegue la query appena creata.
            $stmt->store_result();
          }else{
            return false;
          }
      }else{
        return true;
      }
    }else{
      return false;
    }
  }else{
    return false;
  }
}

?>
