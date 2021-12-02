<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/style.css">
        <title>Connexion</title>
    </head>
    <body>
        <form action="check.php" method="post">
             <p>Votre identifiant :         <input type="text" name="login" /></p>
             <p>Votre mot de passe :        <input type="text" name="mdp" /></p>
             <p><input type="reset" name "reset"/> 
                <input type="submit" value="Valider"/></p>
        </form>

        <?php
            //On créée la session pour se souvenir de la personne
            session_start();

            //On récupère les informations
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];

            $_SESSION['login'] = $login;

            // On vérifier si les varaibles existent
            if(isset($login) AND isset($mdp)){ 
                
                if($login != NULL AND $mdp != NULL){ 
                
                    if ($login == 'root'){
                        if($mdp == '$iutinfo'){
                            header('Location: index.html');
                            exit();
                        }
                    }else{
                        echo 'Connexion établie';
                        sleep(3);
                        header("Refresh:0");            
                    }   

                } else{ // Si les champs n'ont pas étaient renseigné, on affiche un message d'erreur ...
                    echo 'Veuillez renseigner tous les champs.';
                }
            }
        ?>
    </body>
</html>
