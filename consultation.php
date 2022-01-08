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
            
            <form action="ajoutConsultation.php" method="post">
            <p>Date (jj/mm/aaaa) : <input type="text" name="Date" /></p>
            <p>Heure : <input type="text" name="HeureC" /> h <input type="text" name="MinutesC" /></p>
            <p>Durée : <input type="text" name="HeureD" /> h <input type="text" name="MinutesD" /></p>
            <p>Médecin : <input type="text" name="NomM" /></p>
            <p>Nom Patient : <input type="text" name="NomP" /></p>
            <p>Prénom Patient : <input type="text" name="PrenomP" /></p>
            <div class="action_button">
                        <input type="reset" name='annuler' value="Annuler">
                        <input type="submit" name='valider' value="Valider">
            </div>
        </section>


        <section>
            Historique des consultations
        <?php
        echo "
            <table>
                <thead>
                    <tr>
                        <th>Date et heure</th>
                        <th>Durée</th>
                        <th>Médecin</th>	
                        <th>Nom Patient</th>
                        <th>Prénom Patient</th>
                    </tr>
                </thead>";
        $res = $linkpdo->query('SELECT * FROM consultation,patient,medecin 
                                WHERE consultation.Id_Patient = patient.Id_Patient
                                AND medecin.Id_Medecin = consultation.Id_Medecin
                                ORDER BY consultation.DateEtHeureConsultation');
        while($data = $res->fetch()){
                echo "<tr>";
                echo "<td>" . $data['DateEtHeureConsultation'] . "</td>";
                echo "<td>"; 
                    $nbh=$data['DureeConsultation']/3600;
                    settype($nbh, "int");
                    $nbmin=($data['DureeConsultation'] % 3600)/60;
                    if($nbmin<10){ 
                        $tmp = $nbmin;
                        $nbmin= "0".$tmp;
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