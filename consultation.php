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
        <title>Consultation</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/style.css">
        <link rel="icon" type="image/logo_icon.png" sizes="16x16" href="image/logo_icon.png">
    </head>
    
    <body>
        <!-- Menu en tête de page -->
        <?php
            require 'header.php';
            require 'connexionPDO.php'
        ?>

        <!-- Corps de la page -->
        <section>
            <form class="form_signup" action="ajoutConsultation.php" method="post">
                <fieldset>
                    <legend>Créer une consultation</legend>

                    <label> Date :   <input type="date" name="Date" value="2022-02-01" min="2022-02-01" max="2024-01-01"/></label>
                    <label> Heures :     <input type="text" name="HeureC" placeholder="15 h"/></label>
                    <label> Minutes :   <input type="text" name="MinutesC" placeholder="30"/></label>
                    <label> Duree :      <input type="text" name="duree" placeholder="30 min"/></label>
                    <label> Médecin :   <select name="nomM">
                                                        <?php
                                                            //Affiche tout les docteurs si pas de mots clé rentré
                                                            $res = $linkpdo->query('SELECT * FROM medecin');
                                                            while($data = $res->fetch()){
                                                                    echo "<option value='" . $data['Nom'] . "'>" . $data['Nom'] . "</option>";
                                                            }
                                                            $res->closeCursor();
                                                        ?>
                                                    </select></label>                   
                    <label>Nom du patient :  <input type="text" name="NomP" placeholder="Lassalle"/></label>
                    <label>Prénom du patient :  <input type="text" name="PrenomP" placeholder="Jean"/></label>
 
                    <div class="action_button">
                        <input type="reset" name='annuler' value="Annuler">
                        <input type="submit" name='valider' value="Valider">
                    </div>
                </fieldset>
            </form>
        </section>


        <section>

            <form class="form_search" method="post" action="Consultation.php">
                <fieldset>
                    <legend>Historique des consultations</legend>
            
                    <table>
                        <thead>
                            <tr>
                                <th>Date et heure</th>
                                <th>Durée</th>
                                <th>Médecin</th>	
                                <th>Nom Patient</th>
                                <th>Prénom Patient</th>
                            </tr>
                        </thead>
        <?php
            $res = $linkpdo->query('SELECT * FROM consultation,patient,medecin 
                                    WHERE consultation.Id_Patient = patient.Id_Patient
                                    AND medecin.Id_Medecin = consultation.Id_Medecin
                                    ORDER BY consultation.DateEtHeureConsultation');
            while($data = $res->fetch()){
                    echo "<tr>";
                    echo "<td>" . $data['DateEtHeureConsultation'] . "</td>";
                    //Conversion 
                    echo "<td>";
                        $nbh = $data['DureeConsultation'] / 3600;
                        settype($nbh, "int");
                        $nbmin = ($data['DureeConsultation'] % 3600) / 60;
                        if ($nbmin<10){ 
                            $tmp = $nbmin;
                            $nbmin = "0" . $tmp;
                         }
                        echo $nbh . "h" . $nbmin;
                    echo "</td>";
                    echo "<td>" . $data['Nom'] . "</td>";
                    echo "<td>" . $data['NomP'] . "</td>";
                    echo "<td>" . $data['PrenomP'] . "</td>";
                    echo "</tr>";
                }
            $res->closeCursor();

            echo "</table>";
        ?>

        </section>

        <!-- Pied de la page -->
        <?php
            require 'footer.php';
        ?>

    </body>
</html>