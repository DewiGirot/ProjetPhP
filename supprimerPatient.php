<?php
require 'connexionPDO.php';

// Supprimer le patient avec l'id récupéré
$req = $linkpdo->prepare('DELETE FROM patient 
                                    WHERE Id_Patient = :id');

$req->execute(array(
    'id' => $_GET['id']
));

header('Location: ./usager.php');


?>