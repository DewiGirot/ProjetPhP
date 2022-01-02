<?php

///Connexion au serveur MySQL
    		try {
    			$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet_medical", 'root'); 
    		}catch (PDOException $e){
    			die('Erreur : ' . $e->getMessage());
    		}
         
    		///Verification de la connexion 
    		if (mysqli_connect_errno()) { 
    			print("Connect failed: \n" . mysqli_connect_error()); 
    			exit(); 
    		}
?>