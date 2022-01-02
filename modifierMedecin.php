

<?php

    require 'connexionPDO.php';

    // Formulaire pour rentrer les nouvelles info personnelles
    $res = $linkpdo->query('SELECT * FROM medecin');
    while($data = $res->fetch()){
        if ($data['Id_Medecin'] == $_GET['id']){
           ?>
            <form method="post" action='modifierMedecin.php?id=" . $data['Id_Medecin'] . "'>
                <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                <label for="civilite">Civilité</label>            <input type="text" name="nvcivilite" id="civilite" value="<?php echo $data['Civilite'];?>"/><br />
                <label for="name">Nom</label>            <input type="text" name="nvname" id="name" value="<?php echo $data['Nom'];?>"/><br />
                <label for="firstname">Prénom</label>      <input type="text" name="nvfirstname" id="firstname" value="<?php echo $data['Prenom'];?>"/><br />
                <input type="reset" value="Annuler"/>
                <input type="submit" value="Valider"/>
            </form>
    <?php

        }
    }
    $res->closeCursor();


    // Mise a jour du medecin avec requête
    if(!empty($_POST['nvname']) && !empty($_POST['nvfirstname']) && !empty($_POST['nvcivilite'])) {


            $req = $linkpdo->prepare('UPDATE medecin 
                                        SET Civilite = :nvcivilite, Nom = :nvnom, Prenom = :nvprenom
                                        WHERE Id_Medecin = :id'
                                );

            $req->execute(array('nvcivilite' => $_POST['nvcivilite'],
                                'nvnom' => $_POST['nvname'],
                                'nvprenom' => $_POST['nvfirstname'],
                                'id' => $_POST['id']
                                ));

            header('Location: ./medecin.php');
    }
?>
