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
        <header>
            <nav>
                <div class="nav_logo">
                    <a href="index.php" title="Page d'acceuil"> <img alt="Logo" src="image/logo_sansfond.png"/></a>
                </div>
                <div class="nav_link">
                    <ul>
                        <li><a href="index.php"> Acceuil </a></li> 
                        <li><a href="usager.php"> Usager </a></li> 
                        <li><a href="medecin.php"> Medecin </a></li>
                        <li><a href="consultation.php"> Consultation </a></li>
                        <li><a href="statistique.php"> Statistique </a></li>
                        <div class="connexion">
                            <li><a href="login.php"> Se connecter </a></li>
                        </div>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Corps de la page -->
        <section>
        Ajouter un médecin

            <form action="medecin.php" method="post">
				<p>Civilité :<input type="text" name="civilite"/></p>
				<p>Nom : <input type="text" name="nom" /></p>
				<p>Prenom :<input type="text" name="prenom" p>
				<p><input type="reset" value="Annuler"><input type="submit" value="Valider"></p>
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
            <table>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Civilité</th>
                        <th>Nom du médecin</th>
                        <th>Prénom</th>
                    </tr>
                </thead>
                <tbody>
                    <TR>
                        <TD>1</TD>
                        <TD>Monsieur</TD>
                        <TD>PIERRE</TD>
                        <TD>Jean-phil</TD>
                    </TR>
                    <TR>
                        <TD>2</TD>
                        <TD>Madame</TD>
                        <TD>VIALLET</TD>
                        <TD>Jacquelinne</TD>
                    </TR>
                    <TR>
                        <TD>3</TD>
                        <TD>Madame</TD>
                        <TD>NOTIN</TD>
                        <TD>Sandrine</TD>
                    </TR>
                    <TR>
                        <TD>4</TD>
                        <TD>Monsieur</TD>
                        <TD>CHEVALIER</TD>
                        <TD>Hervé</TD>
                    </TR>
                </tbody>
            </table>
        </section>
		<section>
        <body>
    <form method="post" action="medecin.php">

        <label for="keyword">Chercher un médecin : </label><br/>
        <input type="text" name="keyword" id="keyword" placeholder="Entrez des mots-clés"/><br/>
        <input type="reset" value="Reset"/>
        <input type="submit" value="Submit"/>
    </form>
    <br />
    <table>
    <thead></thead>
    		<tr>
               <th>Civilité</th>
    	       <th>Nom</th>
    	       <th>Prénom</th>	
    		</tr>
    </table>
</body>

        
        
			<?php
            $keyword = $_POST['keyword'];

			$res = $linkpdo->query('SELECT * FROM medecin');
            while($data = $res->fetch()){
                if (in_array($keyword, $data, true)){
                    echo "<tr>";
                    echo "<td>" . $data['Civilite'] . "<td>";
                    echo "<td>" . $data['Nom'] . "<td>";
                    echo "<td>" . $data['Prenom'] . "<td>";
        
                    echo "<td><a href='medecin.php?id=" . $data['Id_Medecin'] . "'>Modify</a></td>";
                    echo "<td><a href='medecin.php?id=" . $data['Id_Medecin'] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            }
            $res->closeCursor();
			
			
			?>
			
		</section>



        <!-- Pied de la page -->
        <footer>
            <h4>8 Pl. Vincent Auriol, 31860 Labarthe-sur-Lèze</h4>
            <h4>05 61 08 02 58</h4>
        </footer>

    </body>
</html>