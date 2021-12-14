<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header('Location: login.php');
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page -->
        <title>Medecin</title>
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
                        <li><a href="index.php"> Acceuil </a></li> 
                        <li><a href="usager.php"> Usager </a></li> 
                        <li><a href="medecin.php"> Medecin </a></li>
                        <li><a href="consultation.php"> Consultation </a></li>
                        <li><a href="statistique.php"> Statistique </a></li>
                        <div class="connexion">
                            <li><a href="login.php"> Se connecter </a></li>
                        </div>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Corps de la page -->
        <section>
            <table>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Civilité</th>
                        <th>Nom du médecin</th>
                        <th>Prénom</th>
                    </tr>
                </thead>
                <tbody>
                    <TR>
                        <TD>1</TD>
                        <TD>Monsieur</TD>
                        <TD>PIERRE</TD>
                        <TD>Jean-phil</TD>
                    </TR>
                    <TR>
                        <TD>2</TD>
                        <TD>Madame</TD>
                        <TD>VIALLET</TD>
                        <TD>Jacquelinne</TD>
                    </TR>
                    <TR>
                        <TD>3</TD>
                        <TD>Madame</TD>
                        <TD>NOTIN</TD>
                        <TD>Sandrine</TD>
                    </TR>
                    <TR>
                        <TD>4</TD>
                        <TD>Monsieur</TD>
                        <TD>CHEVALIER</TD>
                        <TD>Hervé</TD>
                    </TR>
                </tbody>
            </table>
        </section>



        <!-- Pied de la page -->
        <footer>
            <h4>8 Pl. Vincent Auriol, 31860 Labarthe-sur-Lèze</h4>
            <h4>05 61 08 02 58</h4>
        </footer>

    </body>
</html>