<!DOCTYPE html>
<html>
    <head>
    	<!-- En-tête de la page -->
        <title>Cabinet médical de Labarthe-sur-lèze</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/style.css">
        <link rel="icon" type="image/logo_icon.png" sizes="16x16" href="image/logo_icon.png">
    </head>
    
    <body>
    	<?php
            session_start();
            //On récupère les infos
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];

            if(!isset($login) and !isset($mdp)){
            	//html a mettre ici
            }else{
            	header('Location: login.php');
            }
            
        ?>

    	<!-- Menu en tête de page -->
    	<header>
    		<nav>
	    		<div class="nav_logo">
	    			<a href="index.html" title="Page d'acceuil"> <img alt="Logo" src="image/logo_sansfond.png"/></a>
	    		</div>
	    		<div class="nav_link">
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
        	<p>Profitez des fonctionnalités de notre cabinet en ligne pour consulter nos patients, nos médecins, prendre rendez-vous avec un médecin et être au courant de nos performances.<br><br>

			Notre équipe s'engage à :<br><br>

			- Vous obtenir un rendez-vous avec votre médecin le plus rapidement possible. Disponible par numéro de téléphone ou bien en ligne, notre cabinet vous accueille et vous conseille du lundi au samedi de 8h à 19h.<br><br>

			-Être 100% transparent en vous montrant les statistiques du cabinet.<br><br></p>
        </section>



        <!-- Pied de la page -->
        <footer>
        	<h4>8 Pl. Vincent Auriol, 31860 Labarthe-sur-Lèze</h4>
        	<h4>05 61 08 02 58</h4>
        </footer>

    </body>
</html>