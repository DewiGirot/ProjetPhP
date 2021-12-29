<?php
	session_start();
    if (!isset($_SESSION['login'])) {
    	header('Location: login.php');
    }
	$keyword="";
    
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
	    				<li><a href="index.php"> Accueil </a></li> 
	    				<li><a href="usager.php"> Patients </a></li> 
	    				<li><a href="medecin.php"> Medecins </a></li>
	    				<li><a href="consultation.php"> Consultations </a></li>
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
            <form action="ajoutPatient.php" method="post">
				<p>Civilité :<input type="text" name="civilite"/></p>
				<p>Nom : <input type="text" name="nom" /></p>
				<p>Prenom :<input type="text" name="prenom" p>
				<p>Adresse : <input type="text" name="adresse" /></p>
				<p>Code Postal :<input type="text" name="cp" /></p>
				<p>Ville de résidence :<input type="text" name="ville" /></p>
				<p>Date de naissance (aaaa/mm/jj):<input type="text" name="datenaiss" /></p>
				<p>Lieu de naissance :<input type="text" name="lieunaiss" /></p>
				<p>N° de sécurité sociale :<input type="text" name="secu" /></p>
				<p>Médecin réferrent (optionnel) :<input type="text" name="NomMedecin" /></p>
				<p><input type="reset" value="Annuler"><input type="submit" name='valider' value="Valider"></p>
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
			
		?>

		<section>


			<form method="post" action="usager.php">
				<label for="keyword">Chercher un patient : </label><br/>
				
				<input type="text" name="keyword" id="keyword" placeholder="Entrez des mots-clés"/><br/>
				<input type="reset" value="Annuler"/>
				<input type="submit" name="chercher" value="Rechercher"/>
			</form>
			<br />


			<?php

			$resPatients = $linkpdo->query('SELECT * FROM patient ORDER BY Id_Patient');

			if ((!isset($_POST['chercher'])) && (!isset($_POST['keyword']))){
				
				//Tableau qui affiche out les patients
				echo "<table>
				<thead>
					<tr>
					   <th>Civilité</th>
					   <th>Nom</th>
					   <th>Prénom</th>
					   <th>Adresse</th>	
					   <th>Code Postal</th>	
					   <th>Ville</th>	
					   <th>Date de naissance</th>		
					   <th>Lieu de naissance</th>	
					   <th>Sécurité Sociale</th>
					   <th>Médecin référrent</th>		
					   <th> Actions </th>
					</tr>
					</thead>";

				while($data = $resPatients->fetch()){
						echo "<tr>";

						echo "<td>" . $data['CiviliteP'] . "</td>";
						echo "<td>" . $data['NomP'] . "</td>";
						echo "<td>" . $data['PrenomP'] . "</td>";
						echo "<td>" . $data['Adresse'] . "</td>";
						echo "<td>" . $data['CodePostal'] . "</td>";
						echo "<td>" . $data['Ville'] . "</td>";
						echo "<td>" . $data['DateNaissance'] . "</td>";
						echo "<td>" . $data['LieuNaissance'] . "</td>";
						echo "<td>" . $data['Numero'] . "</td>";

						$idPatient=$data['Id_Patient'];

						$resNdr = $linkpdo->prepare("SELECT medecin.Nom
                                                        FROM patient,medecin 
														WHERE medecin.Id_Medecin = patient.Id_Medecin
                                                        AND  patient.Id_Patient = :id ");
						$resNdr -> bindParam(':id', $idPatient);
						$resNdr->execute();

						if ($tmp=$resNdr->fetch()){
							echo "<td>" . $tmp['Nom'] . "</td>";
						}else{
							echo "<td>" . "Aucun" . "</td>";
						}
						
						echo "<td><a href='modifierUsager.php?id=" . $data['Id_Patient'] . "'>Modifier</a> ";
						echo "<a href='supprimerPatient.php?id=" . $data['Id_Patient'] . "'>Supprimer</a></td>";

						echo "</tr>";
				}
				$resPatients->closeCursor();

				echo "</table>";

			}else{
				

				//Tableau qui affiche le résultat de la recherche
				echo "<table>
				<thead>
					<tr>
					   <th>Civilité</th>
					   <th>Nom</th>
					   <th>Prénom</th>
					   <th>Adresse</th>	
					   <th>Code Postal</th>	
					   <th>Ville</th>	
					   <th>Date de naissance</th>		
					   <th>Lieu de naissance</th>	
					   <th>Sécurité Sociale</th>
					   <th>Médecin référrent</th>		
					   <th> Actions </th>
					</tr>
					</thead>";

				$keyword = $_POST['keyword'];
			

				//Affichage des patients en fonction du mot clé
				while($data = $resPatients->fetch()){
					if (in_array($keyword, $data, true)){
						echo "<tr>";
						echo "<td>" . $data['CiviliteP'] . "</td>";
						echo "<td>" . $data['NomP'] . "</td>";
						echo "<td>" . $data['PrenomP'] . "</td>";
						echo "<td>" . $data['Adresse'] . "</td>";
						echo "<td>" . $data['CodePostal'] . "</td>";
						echo "<td>" . $data['Ville'] . "</td>";
						echo "<td>" . $data['DateNaissance'] . "</td>";
						echo "<td>" . $data['LieuNaissance'] . "</td>";
						echo "<td>" . $data['Numero'] . "</td>";

						$idPatient=$data['Id_Patient'];

						$resNdr = $linkpdo->prepare("SELECT medecin.Nom
                                                        FROM patient,medecin 
														WHERE medecin.Id_Medecin = patient.Id_Medecin
                                                        AND  patient.Id_Patient = :id ");
						$resNdr -> bindParam(':id', $idPatient);
						$resNdr->execute();

						if ($tmp=$resNdr->fetch()){
							echo "<td>" . $tmp['Nom'] . "</td>";
						}else{
							echo "<td>" . "Aucun" . "</td>";
						}
						

						echo "<td><a href='modifierUsager.php?id=" . $data['Id_Patient'] . "'>Modifier</a> ";
						echo "<a href='supprimerPatient.php?id=" . $data['Id_Patient'] . "'>Supprimer</a></td>";
						echo "</tr>";

					}
				}
				$resPatients->closeCursor();

				echo "</table>";

			}
			?>

		</section>
		
	    <!-- Pied de la page -->
	    <footer>
	        <h4>8 Pl. Vincent Auriol, 31860 Labarthe-sur-Lèze</h4>
	        <h4>05 61 08 02 58</h4>
	    </footer>

	    </body>

</html>