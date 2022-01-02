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
            Nouvelle consultation
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
                echo "<td>" . $data['DureeConsultation'] . "</td>";
                echo "<td>" . $data['Nom'] . "</td>";
                echo "<td>" . $data['NomP'] . "</td>";
                echo "<td>" . $data['PrenomP'] . "</td>";
                echo "</tr>";
            }
        $res->closeCursor();

        echo "</table>";
        ?>

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
                echo "<td>" . $data['DureeConsultation'] . "</td>";
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