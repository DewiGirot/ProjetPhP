<?php
	session_start();    
?>
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

    	<!-- Menu en tête de page -->
    	<?php
    		require 'header.php';
    	?>

        

        <!-- Corps de la page -->
        <section>
        	<p>Profitez des fonctionnalités de notre cabinet en ligne pour consulter nos patients, nos médecins, prendre rendez-vous avec un médecin et être au courant de nos performances.<br><br>

			Notre équipe s'engage à :<br><br>

			- Vous obtenir un rendez-vous avec votre médecin le plus rapidement possible. Disponible par numéro de téléphone ou bien en ligne, notre cabinet vous accueille et vous conseille du lundi au samedi de 8h à 19h.<br><br>

			-Être 100% transparent en vous montrant les statistiques du cabinet.<br><br></p>
        </section>



        <!-- Pied de la page -->
        <?php
            require 'footer.php';
        ?>

    </body>
</html>