<?php

include '../db_connect.php';
include '../functions.php';
include '../mail.php';

sec_session_start();




$notify="";
$errors="";

if(isset($_SESSION['username'], $_SESSION['login_string'])){
    $user = $_SESSION['username'];
    if ($stmtq = $mysqli->prepare("SELECT `Id`, `StatoOrdine`, `notifyPreparation`, `notifyShipment` FROM `ordine` WHERE IdCliente = '$user'")) {
        $stmtq->execute(); // esegue la query appena creata.
        $stmtq->store_result();
        $i = 0;

        if ($stmtq->num_rows > 0) {
            while ($i < $stmtq->num_rows) {
                $stmtq->bind_result($id, $stato, $nPrep,$nShip); // recupera le variabili dal risultato ottenuto.
                $stmtq->fetch();

                if($stato == "Preparazione"){
                    if($nPrep == '0'){
                        //notifica non ancora inviata
                        
                        $_SESSION['notifiche'] .= "<br/> L'ordine ".$id." é in preparazione";
                        $_SESSION['numero'] += 1;
                        if ($stmtP = $mysqli->prepare("UPDATE `ordine` SET `notifyPreparation`= '1' WHERE id = ?")) {
                            $stmtP->bind_param("s", $id); // esegue il bind del parametro '$email'.
                            $stmtP->execute(); // esegue la query appena creata.
                            $stmtP->close();
                        }else{
                            $errors .= "<br/>update preparazione";
                        }
                        send_mail_notify($user, "L'ordine ".$id." é in preparazione");
                    }
                }
                else if($stato == "Spedito"){
                    if($nShip == '0'){
                        //notifica non ancora inviata
                        $_SESSION['notifiche'] .= "<br/> L'ordine ".$id." é in spedizione";
                        $_SESSION['numero'] += 1;
                        if ($stmtS = $mysqli->prepare("UPDATE `ordine` SET `notifyShipment`= '1' WHERE id = ?")) {
                            $stmtS->bind_param("s", $id); // esegue il bind del parametro '$email'.
                            $stmtS->execute(); // esegue la query appena creata.
                            $stmtS->close();
                        }else{
                            $errors .= "<br/>update spedito";
                        }
                        send_mail_notify($user, "L'ordine ".$id." é in spedizione");

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