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
echo "\n";
echo $idP;

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
echo "\n";
echo $idM;


//On formate la date pour la mettre dans le tableau
$dateC = new DateTime($_POST['Date'] . $_POST['HeureC'] . $_POST['MinutesC']);
$dateC->format('d-m-Y H:i');


//Duree consultation en minute
$dureeConsultation = $_POST['duree'] * 60;


//Date et heure consultation en int
$DateToInt = strtotime($_POST['Date']);
$HourToInt = $_POST['HeureC'] * 3600;
$MinuteToInt = $_POST['MinutesC'] * 60;

echo $DateToInt . '.' . $HourToInt . '.' . $MinuteToInt; // pour 15h30 1643729400

$req = $linkpdo->prepare('INSERT INTO consultation(DateEtHeureConsultation, DureeConsultation, Id_Medecin, Id_Patient)
VALUES (:dateHeure, :duree, :idM, :idP)');

$req->execute([ $dateC,  $dureeConsultation, $idM, $idP]);

$req->execute();

header('Location: ./consultation.php');


?>