<?php
require 'connexionPDO.php';

// Supprimer le patient avec l'id récupéré
$req = $linkpdo->prepare('DELETE FROM consultation 
                                    WHERE DateEtHeureConsultation = :id');

$req->execute(array(
    'id' => $_GET['id']
));

header('Location: ./consultation.php');


?>