<?php
require 'connexionPDO.php';

//Conversion de la date et heure en entier
$stringDate

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

//$req -> bindParam(':civilite', $_POST['civilite']);
//$req -> bindParam(':nom', $_POST['nom']);
//$req -> bindParam(':prenom', $_POST['prenom']);
//$req->execute();

//header('Location: ./consultation.php');


?>