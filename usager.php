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
        <?php
    		require 'header.php';
			require 'connexionPDO.php';
    	?>

        <!-- Corps de la page -->
        <section>
            <form class="form_signup" action="ajoutPatient.php" method="post">
            	<fieldset>
	            	<legend>Inscrire un patient</legend>
	            	
	            	<label for="civilite">Civilité :		<input type="text" name="civilite" placeholder="M/Mme/Mlle"/></label>
					<label for="nom">Nom :					<input type="text" name="nom" placeholder="NOM"/></label>
					<label for="prenom">Prénom :			<input type="text" name="prenom" placeholder="Prénom"/></label>
					<label for="adresse">Adresse :			<input type="text" name="adresse" placeholder="Adresse"/></label>
					<label for="cp">Code Postal :			<input type="text" name="cp" placeholder="Code postal"/></label>
					<label for="cp">Ville de résidence :	<input type="text" name="ville" placeholder="Nom de ville"/></label>
					<label for="cp">Date de naissance (aaaa/mm/jj) :	<input type="text" name="datenaiss" placeholder="AAAA-MM-JJ"/></label>
					<label for="cp">Lieu de naissance :					<input type="text" name="lieunaiss" placeholder="Nom de ville"/></label>
					<label for="cp">N° de sécurité sociale :			<input type="text" name="secu" placeholder="Numéro de sécurité sociale"/></label>
					<div class="action_button">
						<input type="reset" name='annuler' value="Annuler">
						<input type="submit" name='valider' value="Valider">
					</div>
				</fieldset>
			</form>
        </section>
		

		<section>


			<form class="form_search" method="post" action="usager.php">
				<fieldset>
	            	<legend for="keyword">Chercher un patient</legend>

	            	<div class="buttons">
						<input type="text" name="keyword" id="keyword" placeholder="Entrez des mots-clés"/><br/>
						<div class="button_search">
							<input type="submit" name="chercher" value="Rechercher"/>
						</div>
					</div>				
			</form>

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
				</fieldset>
		</section>
		
	    <!-- Pied de la page -->
	    <?php
    		require 'footer.php';
    	?>
	    </body>

</html>