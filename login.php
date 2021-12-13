<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/style.css">
        <title>Connexion</title>
    </head>
    <body>
        <form action="login.php" method="post">
             <p>Votre identifiant :         <input type="text" name="login" /></p>
             <p>Votre mot de passe :        <input type="text" name="mdp" /></p>
             <p><input type="reset" name "reset"/> 
                <input type="submit" value="Valider"/></p>
        </form>

        <?php
            //On récupère les informations
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            $login_valide = "root";
            $mdp_valide = "iutinfo";


            // on teste si nos variables sont définies
            if (isset($_POST['login']) && isset($_POST['mdp'])) {

                // on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
                if ( $login_valide == $_POST['login']  && $mdp_valide == $_POST['mdp']) {

                    // on la démarre et onenregistre les paramètres de notre visiteur comme variables de session ($login et $mdp) 
                    session_start ();
                    $_SESSION['login'] = $_POST['login'];
                    $_SESSION['mdp'] = $_POST['mdp'];

                    // on redirige notre visiteur vers une page de notre section membre
                    header ('location: index.php');
                }else {
                    echo 'Membre non reconnu...';
                    echo '<meta http-equiv="refresh" content="0;URL=login.php">';
                }
            }else {
                echo 'Les variables du formulaire ne sont pas déclarées.';
            }
        ?>
    </body>
</html>
