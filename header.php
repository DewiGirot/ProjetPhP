<!DOCTYPE html>
	<html>
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
	    					<?php
							if (!isset($_SESSION['login'])) {
								echo "<li><a href='login.php'> Se connecter</a></li>";
							}else{
								echo "<li><a href='logout.php'> Se déconnecter</a></li>";
							}
							?>
	    				</div>
	    			</ul>
	    		</div>
	    	</nav>
		</header>
	</html>