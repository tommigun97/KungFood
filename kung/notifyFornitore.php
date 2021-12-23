<?php

include 'db_connect.php';
include 'functions.php';

sec_session_start();




$notify="";
$errors="";

if(isset($_SESSION['username'], $_SESSION['login_string'])){
    $user = $_SESSION['username'];
    if ($stmtq = $mysqli->prepare("SELECT `Id`, `StatoOrdine`, `notifyReception` FROM `ordine` WHERE IdFornitore = '$user'")) {
        $stmtq->execute(); // esegue la query appena creata.
        $stmtq->store_result();
        $i = 0;

        if ($stmtq->num_rows > 0) {
            while ($i < $stmtq->num_rows) {
                $stmtq->bind_result($id, $stato,$nRec); // recupera le variabili dal risultato ottenuto.
                $stmtq->fetch();

                if($stato == "Pronto"){
                    if($nRec == '0'){
                        //notifica non ancora inviata
                        $_SESSION['notifiche'] .= "<br/> L'ordine ".$id." é pagato";
                        $_SESSION['numero'] += 1;
                        if ($stmtP = $mysqli->prepare("UPDATE `ordine` SET `notifyReception`= '1' WHERE id = ?")) {
                            $stmtP->bind_param("s", $id); // esegue il bind del parametro '$email'.
                            $stmtP->execute(); // esegue la query appena creata.
                            $stmtP->close();
                        }else{
                            $errors .= "<br/>update preparazione";
                        }
                    }
                }
                $i++;
            }
            
            }else{
                $errors .= "<br/>numero righe 0";
            }
            $stmtq->close();
        }else{
            $errors .= "<br/>select iniziale";
        }
        echo $errors ;
    }
?>