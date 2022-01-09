

<?php

require 'connexionPDO.php';



//récupération nom médecin
$idP=$_GET['id'];
$resID = $linkpdo->prepare('SELECT * FROM medecin, patient WHERE medecin.Id_Medecin=patient.Id_Medecin AND patient.Id_Patient=:idP');
$resID->execute(array(':idP' => $idP));
if($data=$resID->fetch()){
    $nomM=$data['Nom'];
}else{
    $nomM="";
}

    // Formulaire pour rentrer les nouvelles info personnelles
    $res = $linkpdo->query('SELECT * FROM patient');
    while($data = $res->fetch()){
        if ($data['Id_Patient'] == $_GET['id']){
           ?>
            <form method="post" >
                <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                <label for="civilite">Civilité</label>            <input type="text" name="nvcivilite" id="civilite" value="<?php echo $data['CiviliteP'];?>"/><br />
                <label for="name">Nom</label>            <input type="text" name="nvname" id="name" value="<?php echo $data['NomP'];?>"/><br />
                <label for="firstname">Prénom</label>      <input type="text" name="nvfirstname" id="firstname" value="<?php echo $data['PrenomP'];?>"/><br />
                <label for="address">Adresse</label>           <input type="text" name="nvaddress" id="address" value="<?php echo $data['Adresse'];?>"/><br />
                <label for="postalCode">Code Postal</label>    <input type="text" name="nvpostalCode" id="postalCode" value="<?php echo $data['CodePostal'];?>"/><br />
                <label for="ville">Ville</label>                 <input type="text" name="nvville" id="ville" value="<?php echo $data['Ville'];?>"/><br />
                <label for="datenaiss">Date de naissance</label>  <input type="text" name="nvdatenaiss" id="datenaiss" value="<?php echo $data['DateNaissance'];?>"/><br />
                <label for="lieunaiss">Lieu de naissance</label>  <input type="text" name="nvlieunaiss" id="lieunaiss" value="<?php echo $data['LieuNaissance'];?>"/><br />
                <label for="secu">Sécurité Sociale</label>  <input type="text" name="nvsecu" id="secu" value="<?php echo $data['Numero'];?>"/><br />
                <label for="secu">Médecin référent</label>  <input type="text" name="nvmedecin" id="medecin" value="<?php echo $nomM;?>"/><br />

                <input type="reset" value="Annuler"/>
                <input type="submit" value="Valider"/>
            </form>
    <?php

        }
    }
    $res->closeCursor();



    //Mise a jour du patient avec médecin référent
    if(!empty($_POST['nvname']) && !empty($_POST['nvfirstname']) && !empty($_POST['nvsecu'])
        && !empty($_POST['nvaddress']) && !empty($_POST['nvpostalCode'])
        && !empty($_POST['nvdatenaiss']) && !empty($_POST['nvlieunaiss'])
        && !empty($_POST['nvville']) && !empty($_POST['nvcivilite'] && !empty($_POST['nvmedecin']))) {

            //Récupérer l'id du médecin
            $reqNom = $linkpdo -> prepare('SELECT * FROM medecin WHERE medecin.Nom=:NomM');
            $reqNom->execute(array(':NomM' => $_POST['nvmedecin']));
            if (!($data=$reqNom->fetch())){
                echo "Médecin non existant";
                exit();
            }
            $nomM=$data['Id_Medecin'];



            $req = $linkpdo->prepare('UPDATE patient 
                                            SET CiviliteP = :nvcivilite, NomP = :nvnom, PrenomP = :nvprenom,
                                            Adresse = :nvadresse, CodePostal = :nvcodepostal, Ville = :nvville,
                                            DateNaissance = :nvdatenaiss, LieuNaissance = :nvlieunaiss, Numero = :nvsecu, Id_Medecin=:nvmedecin
                                            WHERE Id_Patient = :id'
                                );

            $req->execute(array('nvcivilite' => $_POST['nvcivilite'],
                                'nvnom' => $_POST['nvname'],
                                'nvprenom' => $_POST['nvfirstname'],
                                'nvadresse' => $_POST['nvaddress'],
                                'nvcodepostal' => $_POST['nvpostalCode'],
                                'nvville' => $_POST['nvville'],
                                'nvdatenaiss' => $_POST['nvdatenaiss'],
                                'nvlieunaiss' => $_POST['nvlieunaiss'],
                                'nvsecu' => $_POST['nvsecu'],
                                'nvmedecin' => $nomM,
                                'id' => $_POST['id']
                                ));

            header('Location: ./usager.php');
            exit();
    }

    // Mise a jour du patient sans médecin
    if(!empty($_POST['nvname']) && !empty($_POST['nvfirstname']) && !empty($_POST['nvsecu'])
        && !empty($_POST['nvaddress']) && !empty($_POST['nvpostalCode'])
        && !empty($_POST['nvdatenaiss']) && !empty($_POST['nvlieunaiss'])
        && !empty($_POST['nvville']) && !empty($_POST['nvcivilite'])) {


            $req = $linkpdo->prepare('UPDATE patient 
                                            SET CiviliteP = :nvcivilite, NomP = :nvnom, PrenomP = :nvprenom,
                                            Adresse = :nvadresse, CodePostal = :nvcodepostal, Ville = :nvville,
                                            DateNaissance = :nvdatenaiss, LieuNaissance = :nvlieunaiss, Numero = :nvsecu, Id_Medecin=NULL
                                            WHERE Id_Patient = :id'
                                );

            $req->execute(array('nvcivilite' => $_POST['nvcivilite'],
                                'nvnom' => $_POST['nvname'],
                                'nvprenom' => $_POST['nvfirstname'],
                                'nvadresse' => $_POST['nvaddress'],
                                'nvcodepostal' => $_POST['nvpostalCode'],
                                'nvville' => $_POST['nvville'],
                                'nvdatenaiss' => $_POST['nvdatenaiss'],
                                'nvlieunaiss' => $_POST['nvlieunaiss'],
                                'nvsecu' => $_POST['nvsecu'],
                                'id' => $_POST['id']
                                ));

            header('Location: ./usager.php');
            exit();
    }

    
?>
