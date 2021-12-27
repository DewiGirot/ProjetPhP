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
$req = $linkpdo->prepare('INSERT INTO medecin(Civilite, Nom,Prenom)
VALUES (:civilite, :nom, :prenom)');

$req -> bindParam(':civilite', $_POST['civilite']);
$req -> bindParam(':nom', $_POST['nom']);
$req -> bindParam(':prenom', $_POST['prenom']);

$req->execute();

header('Location: ./medecin.php');


?>