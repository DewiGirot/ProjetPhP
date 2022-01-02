<?php
require 'connexionPDO.php';

//Insertion du nouveau patient
$req = $linkpdo->prepare('INSERT INTO medecin(Civilite, Nom,Prenom)
VALUES (:civilite, :nom, :prenom)');

$req -> bindParam(':civilite', $_POST['civilite']);
$req -> bindParam(':nom', $_POST['nom']);
$req -> bindParam(':prenom', $_POST['prenom']);

$req->execute();

header('Location: ./medecin.php');


?>