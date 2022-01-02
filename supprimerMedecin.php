<?php
require 'connexionPDO.php';

//Supprimer le medecin avec l'id  récupéré
$req = $linkpdo->prepare('DELETE FROM medecin 
                                    WHERE Id_Medecin = :id');

$req->execute(array(
    'id' => $_GET['id']
));

header('Location: ./medecin.php');


?>