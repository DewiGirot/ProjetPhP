<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header('Location: login.php');
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page -->
        <title>Medecin</title>
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
        <section>
            <form class="form_signup" action="ajoutMedecin.php" method="post">
                <fieldset>
                    <legend for="keyword">Ajouter un médecin</legend>

                    <label for="civilite">Civilité :    <input type="text" name="civilite" placeholder="M/Mme/Mlle"/></label>
    				<label for="nom">Nom :              <input type="text" name="nom" placeholder="NOM"/></label>
                    <label for="prenom">Prénom :        <input type="text" name="prenom" placeholder="Prénom"/></label>
    				<div class="action_button">
                        <input type="reset" name='annuler' value="Annuler">
                        <input type="submit" name='valider' value="Valider">
                    </div>
                </fieldset>
			</form>
        </section>

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
    	
            $req = $linkpdo->prepare('INSERT INTO medecin(Civilite, Nom,Prenom)
                                        VALUES (:civilite, :nom, :prenom)');
    		
    		$req -> bindParam(':civilite', $_POST['civilite']);
    		$req -> bindParam(':nom', $_POST['nom']);
    		$req -> bindParam(':prenom', $_POST['prenom']);
    		
            $req->execute();
		
	   ?>


        <section>
            <form class="form_search" method="post" action="medecin.php">
                <fieldset>
                    <legend for="keyword"> Chercher un médecin</legend>

                    <div class="buttons">
                        <input type="text" name="keyword" id="keyword" placeholder="Entrez des mots-clés"/><br/>
                        <div class="button_search">
                            <input type="submit" name="chercher" value="Rechercher"/>
                        </div>
                    </div>  
            </form>
            <br />

            

            <?php
                
                if (!isset($_POST['chercher'])){
                    echo "<table>
                        <thead>
                            <tr>
                               <th>Civilité</th>
                               <th>Nom</th>
                               <th>Prénom</th>	
                               <th> Actions </th>
                            </tr>
                        </thead>";

                    

                    //Affiche tout les docteurs si pas de mots clé rentré
                    $res = $linkpdo->query('SELECT * FROM medecin');
                    while($data = $res->fetch()){
                            echo "<tr>";
                            echo "<td>" . $data['Civilite'] . "</td>";
                            echo "<td>" . $data['Nom'] . "</td>";
                            echo "<td>" . $data['Prenom'] . "</td>";
                
                            echo "<td><a href='modifierMedecin.php?id=" . $data['Id_Medecin'] . "'>Modifier</a> ";
                            echo "<a href='supprimerMedecin.php?id=" . $data['Id_Medecin'] . "'>Supprimer</a></td>";
                            echo "</tr>";
                    }
                    $res->closeCursor();

                }else{
                    
                    echo "
                    <table>
                    <thead>
                            <tr>
                               <th>Civilité</th>
                               <th>Nom</th>
                               <th>Prénom</th>	
                               <th> Actions </th>
                            </tr>
                            </thead>";

                    $keyword = $_POST['keyword'];


                    $res = $linkpdo->query('SELECT * FROM medecin');
                    while($data = $res->fetch()){
                        if (in_array($keyword, $data, true)){
                            echo "<tr>";
                            echo "<td>" . $data['Civilite'] . "</td>";
                            echo "<td>" . $data['Nom'] . "</td>";
                            echo "<td>" . $data['Prenom'] . "</td>";
                
                            echo "<td><a href='modifierMedecin.php?id=" . $data['Id_Medecin'] . "'>Modifier</a> ";
                            echo "<a href='supprimerMedecin.php?id=" . $data['Id_Medecin'] . "'>Supprimer</a></td>";
                            echo "</tr>";
                        }
                    }
                    $res->closeCursor();

                }

                echo "</table>";
			
			?>
                </fieldset>
		
		</section>


        <!-- Pied de la page -->
        <?php
            require 'footer.php';
        ?>

    </body>

</html>