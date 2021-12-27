<?php
///Connexion au serveur MySQL
try {
    $linkpdo = new PDO("mysql:host=localhost;dbname=cabinet_medical", 'root'); 
}catch (PDOException $e){
    die('Erreur : ' . $e->getMessage());
}

///Verification de la connexion 
if (mysqli_connect_errno()) { 
    print("Connect failed: \n" . mysqli_connect_error()); 
    exit(); 
}

//Insertion du nouveau patient
$req = $linkpdo->prepare('INSERT INTO patient(CiviliteP, NomP,PrenomP,Adresse,CodePostal,Ville,DateNaissance,LieuNaissance,Numero)
VALUES (:civilite, :nom, :prenom, :adresse, :cp, :ville, :datenaiss, :lieunaiss, :secu)');

$req -> bindParam(':civilite', $_POST['civilite']);
$req -> bindParam(':nom', $_POST['nom']);
$req -> bindParam(':prenom', $_POST['prenom']);
$req -> bindParam(':adresse', $_POST['adresse']);
$req -> bindParam(':cp', $_POST['cp']);
$req -> bindParam(':ville', $_POST['ville']);
$req -> bindParam(':datenaiss', $_POST['datenaiss']);
$req -> bindParam(':lieunaiss', $_POST['lieunaiss']);
$req -> bindParam(':secu', $_POST['secu']);

$req->execute();

header('Location: ./usager.php');


?>