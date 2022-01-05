<?php
require 'connexionPDO.php';

//Conversion de la date et heure en entier
$stringDate=3;

//Récupération id Patient
$reqIdP = $linkpdo->prepare("SELECT *
                            FROM patient
                            WHERE NomP = :nomP
                            AND PrenomP = :prenomP ");
$reqIdP -> bindParam(':nomP', $_POST['NomP']);
$reqIdP -> bindParam(':prenomP', $_POST['PrenomP']);
$reqIdP -> execute();

$data = $reqIdP->fetch();
$idP = $data['Id_Patient'];

//Récupération id Médecin
$reqIdM = $linkpdo->prepare("SELECT *
                            FROM medecin
                            WHERE Nom = :nomM");
$reqIdM -> bindParam(':nomM', $_POST['NomM']);
$reqIdM -> execute();

$data = $reqIdM->fetch();
$idM = $data['Id_Medecin'];

//Conversion de la durée en entier
$nbh = $_POST['HeureD'];
$nbmin = $_POST['MinutesD'];
$dureeInt = 60*$nbmin + 3600*$nbh;


//$req = $linkpdo->prepare('INSERT INTO consultation(DateEtHeureConsultation, DureeConsultation, Id_Medecin, Id_Patient)
//VALUES (:dateHeure, :duree, :idM, :idP)');

//$req -> bindParam(':dateHeure', $stringDate);
//$req -> bindParam(':duree', $dureeInt);
//$req -> bindParam(':idM', $idM);
//$req -> bindParam(':idP', $idP);

//$req->execute();

//header('Location: ./consultation.php');


?>