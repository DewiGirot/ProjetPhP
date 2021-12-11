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
	<?php

	
		///Connexion au serveur MySQL
		try { 
			$linkpdo = new PDO("mysql:host=localhost;dbname=contact", 'root'); 
		} 
     
		///Verification de la connexion 
		if (mysqli_connect_errno()) { 
			print("Connect failed: \n" . mysqli_connect_error()); 
			exit(); 
		}
	
		$Nom  = $_POST['nom'];
		$Prenom = $_POST['prenom'];
		$Adresse = $_POST['adresse'];
		$CodeP = $_POST['cp'];
		$Ville=$_POST['ville'];
		$Datenaiss=$_POST['datenaiss'];
		$lieunaiss=$_POST['lieunaiss'];
		$Secu=$_POST['secu'];
			
	
	
		$req = $linkpdo->prepare('INSERT INTO patient(Nom, Prenom, Adresse, CodePostal, Ville, DateNaissance, LieuNaissance, NumeroSecuriteSociale)
							VALUES(:Nom, :Prenom, :Adresse, :CodePostal, :Ville, :DateNaissance, :LieuNaissance, :NumeroSecuriteSociale)');
		$req->execute(array(':Nom' => $Nom, ':Prenom' => $Prenom, ':Adresse' => $Adresse,':CodePostal' => $CodeP, ':Ville' => $Ville, ':DateNaissance' => $Datenaiss, ':LieuNaissance' => $lieunaiss, ':NumeroSecuriteSociale' => $Secu));
	
	?>
	
        <!-- Menu en tête de page -->
        <header>
            <nav>
                <div class="nav_logo">
                    <a href="index.html" title="Page d'acceuil"> <img alt="Logo" src="image/logo_sansfond.png"/></a>
                </div>
                <div class="nav_link">

                <div class="nav_middle">
                    <h2>Bonjour à nos patients</h2>
                </div>
                
                <div class="nav_right">
                    <ul>
                        <li><a href="index.html"> Acceuil </a></li> 
                        <li><a href="usager.php"> Usager </a></li> 
                        <li><a href="medecin.html"> Medecin </a></li>
                        <li><a href="consultation.html"> Consultation </a></li>
                        <li><a href="statistique.html"> Statistique </a></li>
                        <div class="connexion">
                            <li><a href="login.html"> Se connecter </a></li>
                        </div>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Corps de la page -->
        <section>
            <form action="usager.html" method="post">
				<p>Nom : <input type="text" name="nom" /></p>
				<p>Prenom : <input type="text" name="prenom" /></p>
				<p>Adresse : <input type="text" name="adresse" /></p>
				<p>Code Postal : <input type="text" name="cp" /></p>
				<p>Ville de résidence : <input type="text" name="ville" /></p>
				<p>Date de naissance : <input type="text" name="datenaiss" /></p>
				<p>Lieu de naissance : <input type="text" name="lieunaiss" /></p>
				<p>N° de sécurité sociale : <input type="text" name="secu" /></p>
				<p><input type="reset" value="Annuler"><input type="submit" value="Valider"></p>
			</form>
        </section>


        <!-- Pied de la page -->
        <footer>
            <h4>8 Pl. Vincent Auriol, 31860 Labarthe-sur-Lèze</h4>
            <h4>05 61 08 02 58</h4>
        </footer>

    </body>
</html>