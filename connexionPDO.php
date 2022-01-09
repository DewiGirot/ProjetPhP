<?php

///Connexion au serveur MySQL
    		try {
    			$linkpdo = new PDO("mysql:host=localhost;dbname=id18250775_cabinet_medical", 'id18250775_root', '5gAlNd/}Y+a_qGPY'); 
    		}catch (PDOException $e){
    			die('Erreur : ' . $e->getMessage());
    		}
         
    		///Verification de la connexion 
    		if (mysqli_connect_errno()) { 
    			print("Connect failed: \n" . mysqli_connect_error()); 
    			exit(); 
    		}
?>