<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page -->
        <title>Usager</title>
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
            <form action="usager.php" method="post">
				<p>Civilité :<input type="text" name="usager" id='civilite' /></p>
				<p>Nom : <input type="text" name="usager" id='nom'/></p>
				<p>Prenom :<input type="text" name="usager" id='prenom'/></p>
				<p>Adresse : <input type="text" name="usager" id='adresse'/></p>
				<p>Code Postal :<input type="text" name="usager" id='cp'/></p>
				<p>Ville de résidence :<input type="text" name="usager" id='ville'/></p>
				<p>Date de naissance :<input type="text" name="usager" id='datenaiss'/></p>
				<p>Lieu de naissance :<input type="text" name="usager" id='lieunaiss'/></p>
				<p>N° de sécurité sociale :<input type="text" name="usager" id='secu'/></p>
				<p><input type="reset" value="Annuler"><input type="submit" value="Valider"></p>
			</form>
        </section>
		
		<?php
		
		$Civilite = $_POST['civilite'];
		$nom = $_POST['nom'];
		$prenom = $_POST["prenom"];
		$adresse = $_POST["adresse"];
		$codePostal = $_POST["cp"];
		$ville = $_POST["ville"];
		$dateN = $_POST["datenaiss"];
		$lieuN = $_POST["lieunaiss"];
		$numsecu = $_POST["secu"]; 
	
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
	
        $req = $linkpdo->prepare('INSERT INTO contact(Civilite, Nom,Prenom,Adresse,CodePostal,Ville,DateNaissance,LieuNaissance,Numero)
                                    VALUES (:Civilite, :Nom, :Prenom, :Adresse, :CodePostal, :Ville, :DateNaissance, :LieuNaissance, :Numero)');

        $req->execute(array('Civilite' => $Civilite,
							'Nom' => $nom,
                            'Prenom' => $prenom,
                            'Adresse' => $adresse,
                            'CodePostal' => $ville,
                            'Ville' => $adresse,
							'DateNaissance' => $dateN,
							'LieuNaissance' => $lieuN,
							'Numero' => $numsecu));
	?>
		
        <!-- Pied de la page -->
        <footer>
            <h4>8 Pl. Vincent Auriol, 31860 Labarthe-sur-Lèze</h4>
            <h4>05 61 08 02 58</h4>
        </footer>

    </body>
</html>