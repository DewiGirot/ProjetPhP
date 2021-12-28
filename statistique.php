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
        <header>
            <nav>
                <div class="nav_logo">
                    <a href="index.php" title="Page d'acceuil"> <img alt="Logo" src="image/logo_sansfond.png"/></a>
                </div>
                <div class="nav_link">
                    <ul>
                        <li><a href="index.php"> Accueil </a></li> 
                        <li><a href="usager.php"> Usager </a></li> 
                        <li><a href="medecin.php"> Medecin </a></li>
                        <li><a href="consultation.php"> Consultation </a></li>
                        <li><a href="statistique.php"> Statistiques </a></li>
                        <div class="connexion">
                            <li><a href="login.php"> Se connecter </a></li>
                        </div>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Corps de la page -->
        <section>

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
                        <th> 
                            <?php
		                    	$reqHjeune = $linkpdo->query("SELECT COUNT(*) as Hjeune 
                                                        FROM patient 
                                                        WHERE DATEDIFF(NOW(), DateNaissance) < 25*365.25 
                                                        AND CiviliteP = 'M'");
                                $nbHjeune=$reqHjeune->fetchColumn(); 
                                echo $nbHjeune;
                            ?>
                        </th>
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
        </section>

        <section>
            <table>
                <thead>
                <tr>
                           <th>Nom du médecin</th>
                           <th>Nombre d'heure de consulltations</th>
                </tr>
                </thead>
                <?php
                  $resNomDr = $linkpdo->query('SELECT * FROM medecin ORDER BY Id_Medecin');
                  $cpt=1;
                    while($data = $resNomDr->fetch()){
                            echo "<tr>";
                            echo "<td>" . $data['Nom'] . "</td>";

                            $nbH=0;
                            $resNbH = $linkpdo->prepare("SELECT SUM(DureeConsultation) as NbH 
                                                        FROM consultation 
                                                        WHERE  consultation.Id_Medecin = :id ");

                            $resNbH -> bindParam(':id', $cpt);
                            $resNbH->execute();
                            $tmp=$resNbH->fetch();

                            $nbH= ($tmp['NbH'] / 3600);
                            echo "<td>" . $nbH . "</td>";

                
                            echo "</tr>";
                            $cpt=$cpt+1;
                    }
                    $resNomDr->closeCursor();

                    echo "</table>";

                ?>





        </section>



        <!-- Pied de la page -->
        <footer>
            <h4>8 Pl. Vincent Auriol, 31860 Labarthe-sur-Lèze</h4>
            <h4>05 61 08 02 58</h4>
        </footer>

    </body>
</html>