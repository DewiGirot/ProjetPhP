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
                <link rel="stylesheet" href="style/styleLogin.css">
                <title>Connexion</title>
            </head>
            <body>
                <header>
                    <nav>
                        <a href="index.php" title="Page d'acceuil"> <img alt="Logo" src="image/logo_sansfond.png"/></a>
                    </nav>
                </header>
                <section>
                    <h1>Connexion</h1>

                    <form class="log" action="login.php" method="POST">
                        
                        <label for="login">Nom d'utilisateur</label>
                        <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

                        <label for="mdp">Mot de passe</label>
                        <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>

                        <input type="submit" id='submit' value='LOGIN' >
                    </form>
                </section>
            </body>
        </html>
<?php
    }
?>