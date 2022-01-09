<?php
require 'connexionPDO.php';

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
if (!empty($_POST['NomM']) ){
    $reqIdM = $linkpdo->prepare("SELECT *
                                FROM medecin
                                WHERE Nom = :nomM");
    $reqIdM -> bindParam(':nomM', $_POST['NomM']);
    $reqIdM -> execute();
    
    $data = $reqIdM->fetch();
    $idM = $data['Id_Medecin'];
}else{
    $reqIdMed = $linkpdo->prepare("SELECT *
                                FROM patient
                                WHERE Id_Patient = :idP");
    $reqIdMed -> bindParam(':idP', $idP);
    $reqIdMed -> execute();
    
    $data = $reqIdMed->fetch();
    $idM = $data['Id_Medecin'];
}

//On formate la date pour la mettre dans le tableau
$dateC = new DateTime($_POST['Date'] . $_POST['HeureC'] . $_POST['MinutesC']);
$stringDate = $dateC->format('Y-m-d H:i');

//Duree consultation en minute
$dureeConsultation = $_POST['duree'] *60;


$req = $linkpdo->prepare('INSERT INTO consultation(DateEtHeureConsultation, DureeConsultation, Id_Medecin, Id_Patient)
VALUES (?,?,?,?)');

$req->execute([ $stringDate,  $dureeConsultation, $idM, $idP]);


header('Location: ./consultation.php');


?>