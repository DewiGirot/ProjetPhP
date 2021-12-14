<?php
    session_start ();
    //Les info que l'on souhaite vérifier
    $login_valide = "root";
    $mdp_valide = "iutinfo";

    if (isset($_POST['login']) && isset($_POST['mdp'])) {
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];

        if ($login==$login_valide  && $mdp==$mdp_valide) {
            $_SESSION['login'] = $login;
            header('location: index.php');
        }else {
            echo 'Membre non reconnu...';
        }

    }else {
?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <link rel="stylesheet" href="style/style.css">
                <title>Connexion</title>
            </head>
            <body>
                <form action="login.php" method="POST">
                    <h1>Connexion</h1>
                    
                    <label><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

                    <label><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>

                    <input type="submit" id='submit' value='LOGIN' >
                </form>
            </body>
        </html>
<?php
    }
?>
        
