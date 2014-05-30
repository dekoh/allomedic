<?php
	// hostname MySQL 
	$hostname = "localhost";
	
	// Username MySQL
	$dbUser = "root";
	 
	// Mot de passe MySQL
	$password = "root";

	$databaseName="allomed";
		
	try {
		$bdd = new PDO("mysql:host=$hostname;dbname=$databaseName", $dbUser, $password); 
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	} catch(PDOException $e) {
		echo "error : ".$e->getMessage();
	}
	
	$base_url = "http://localhost/tfe/"; 
?>