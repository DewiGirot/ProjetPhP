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
				<p>Civilité :<input type="text" name="civilite"/></p>
				<p>Nom : <input type="text" name="nom" /></p>
				<p>Prenom :<input type="text" name="prenom" p>
				<p>Adresse : <input type="text" name="adresse" /></p>
				<p>Code Postal :<input type="text" name="cp" /></p>
				<p>Ville de résidence :<input type="text" name="ville" /></p>
				<p>Date de naissance :<input type="text" name="datenaiss" /></p>
				<p>Lieu de naissance :<input type="text" name="lieunaiss" /></p>
				<p>N° de sécurité sociale :<input type="text" name="secu" /></p>
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
	
        $req = $linkpdo->prepare('INSERT INTO patient(Civilite, Nom,Prenom,Adresse,CodePostal,Ville,DateNaissance,LieuNaissance,Numero)
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
		
	?>
		
        <!-- Pied de la page -->
        <footer>
            <h4>8 Pl. Vincent Auriol, 31860 Labarthe-sur-Lèze</h4>
            <h4>05 61 08 02 58</h4>
        </footer>

    </body>
</html>