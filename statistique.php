<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header('Location: login.php');
    }


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

?>

<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page -->
        <title>Statistiques</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/style.css">
        <link rel="icon" type="image/logo_icon.png" sizes="16x16" href="image/logo_icon.png">
    </head>
    
    <body>
        <!-- Menu en tête de page -->
        <?php
            require 'header.php';
        ?>

        <!-- Corps de la page -->
        <section class="stats_tableaux">
            <fieldset>
                <legend>Statistiques des patients</legend>

                <!-- Tableau des nombres d'hommes et femmes en fonction de leur age -->
                <table>
                        <thead>
                                <tr>
                                   <th>Tranche d'âge</th>
                                   <th>Nombre d'hommes</th>
                                   <th>Nombre de Femmes</th>	
                                </tr>
                        </thead>
                            <tr>
                                <th>Moins de 25 ans</th>
                                <th><?php
        		                    	$reqHjeune = $linkpdo->query("SELECT COUNT(*) as Hjeune 
                                                                FROM patient 
                                                                WHERE DATEDIFF(NOW(), DateNaissance) < 25*365.25 
                                                                AND CiviliteP = 'M'");
                                        $nbHjeune=$reqHjeune->fetchColumn(); 
                                        echo $nbHjeune;
                                    ?> </th>
                                <th>
                                <?php
        		                    	$reqFjeune = $linkpdo->query("SELECT COUNT(*) as Fjeune 
                                                                FROM patient 
                                                                WHERE DATEDIFF(NOW(), DateNaissance) < 25*365.25 
                                                                AND (CiviliteP = 'Mme' OR CiviliteP = 'Mlle')");
                                        $nbFjeune=$reqFjeune->fetchColumn(); 
                                        echo $nbFjeune;
                                    ?>
                                </th>
                            </tr>
                            <tr>
                            <th>Entre 25 et 50 ans</th>
                            <th> 
                                    <?php
        		                    	$reqHmoyen = $linkpdo->query("SELECT COUNT(*) as Hmoyen
                                                                FROM patient 
                                                                WHERE DATEDIFF(NOW(), DateNaissance) > 25*365.25 
                                                                AND DATEDIFF(NOW(), DateNaissance) < 50*365.25
                                                                AND CiviliteP = 'M'");
                                        $nbHmoyen=$reqHmoyen->fetchColumn(); 
                                        echo $nbHmoyen;
                                    ?>
                                </th>
                                <th>
                                <?php
        		                    	$reqFmoyenne = $linkpdo->query("SELECT COUNT(*) as Fmoyenne 
                                                                FROM patient 
                                                                WHERE DATEDIFF(NOW(), DateNaissance) > 25*365.25 
                                                                AND DATEDIFF(NOW(), DateNaissance) < 50*365.25
                                                                AND (CiviliteP = 'Mme' OR CiviliteP = 'Mlle')");
                                        $nbFmoyenne=$reqFmoyenne->fetchColumn(); 
                                        echo $nbFmoyenne;
                                    ?>
                                </th>
                            </tr>
                            <tr>
                            <th>Plus de 50 ans</th>
                            <th> 
                                    <?php
        		                    	$reqHvieux = $linkpdo->query("SELECT COUNT(*) as Hvieux
                                                                FROM patient 
                                                                WHERE DATEDIFF(NOW(), DateNaissance) > 50*365.25 
                                                                AND CiviliteP = 'M'");
                                        $nbHvieux=$reqHvieux->fetchColumn(); 
                                        echo $nbHvieux;
                                    ?>
                                </th>
                                <th>
                                <?php
        		                    	$reqFvieille = $linkpdo->query("SELECT COUNT(*) as Fvieille
                                                                FROM patient 
                                                                WHERE DATEDIFF(NOW(), DateNaissance) > 50*365.25 
                                                                AND (CiviliteP = 'Mme' OR CiviliteP = 'Mlle')");
                                        $nbFvieille=$reqFvieille->fetchColumn(); 
                                        echo $nbFvieille;
                                    ?>
                                </th>
                            </tr>
                </table>
            </fieldset>
            
            <fieldset>
                <legend>Statistiques des médecins</legend>
                <table>
                    <thead>
                    <tr>
                               <th>Nom du médecin</th>
                               <th>Nombre d'heure de consultations</th>
                    </tr>
                    </thead> <?php

                    
                        $resNomDr = $linkpdo->query('SELECT * FROM medecin ORDER BY Id_Medecin');
                        while($data = $resNomDr->fetch()){
                                echo "<tr>";

                                //Affichage des noms de tout les médecins
                                echo "<td>" . $data['Nom'] . "</td>";

                                //Requete qui récupère le temps de consultation total en seconde
                                $nbH=0;
                                $idMedecin=$data['Id_Medecin'];
                                $resNbH = $linkpdo->prepare("SELECT SUM(DureeConsultation) as NbH 
                                                            FROM consultation 
                                                            WHERE  consultation.Id_Medecin = :id ");
                                $resNbH -> bindParam(':id',$idMedecin);
                                $resNbH->execute();
                                $tmp=$resNbH->fetch();

                                //Conversion en heure puis affichage
                                $nbH= ($tmp['NbH'] / 3600);
                                echo "<td>" . $nbH . "</td>";
                    
                                echo "</tr>";
                        }
                        $resNomDr->closeCursor();

                        echo "</table>";

                    ?>
                </table>
            </fieldset>

        </section>



        <!-- Pied de la page -->
        <?php
            require 'footer.php';
        ?>

    </body>
</html>