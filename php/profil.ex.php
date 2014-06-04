<?php 
	require "php/lib.php";
	$erreur = array();
	if(count($_POST)>0){
		if($_POST['posttype']=="newpat"){
			$url=$_POST['url'];
			 $email = addslashes($_POST['email']);
			 $prenom = addslashes($_POST['prenom']);
			 $nom = addslashes($_POST['nom']);
			 $tel = addslashes($_POST['telephone']);
			 $dateb = addslashes($_POST['date-naissance']);
			 $sexe = addslashes($_POST['sexe']);
			 $adresse = addslashes($_POST['adresse']);
			 $motif = "#[^a-zA-Zàáâãäåòóôõöøèéêëçìíîïùúûüÿñ' ]#";
			 $motifb = "#^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$#";
			 $motiftel = "#^[0-9.+]{9,13}$#";
			 $erreur = array();
			 $avertissement = array();
			 if(!empty($prenom)){
				 if(preg_match($motif,$prenom)){
					 $erreur['prenom'][0] = "Le prénom n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['prenom'][1] = "Le prénom n'est pas rempli";
			 }
			 if(!empty($nom)){
				 if(preg_match($motif,$nom)){
					 $erreur['nom'][0] = "Le nom n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['nom'][1] = "Le nom n'est pas rempli";
			 }
			 if(!empty($email)){
				 if(!preg_match($motifb,$email)){
					 $erreur['email'][0] = "L'email n'est pas valide"; 
				 }
				 else{
					 $mail = $bdd->query("SELECT email,id FROM utilisateurs");
					 while($emai=$mail->fetch()){
						 if($emai['email']==$email){
						 	$id = $emai['id'];
						 	$lien = $bdd->query("SELECT * FROM liens WHERE idpat=$id");
						 	$liens = $lien->fetchAll();
						 	if($liens[0]['idmed']==$_SESSION['userid']){
							 	$erreur['email'][2] = "Il existe déjà un patient avec cet email";
						 	}
						 	else{
							 	$makelink=true;
						 	}
						 }
					 }
				 }
			 }
			 else{
				 $avertissement['email'][1] = "L'email n'est pas rempli";
			 }
			 if(!empty($tel)){
				 if(!preg_match($motiftel,$tel)){
						 $erreur['tel'] = "Le numéro de téléphone n'est pas valide"; 
					 }
			 }
			 if(!empty($dateb)){
			 	if(validateDate($dateb)){
				 
					 $erreur['datenaissance'] = "La date de naissance n'est pas valide"; 
				 }
			 }
			 if(count($erreur)>0){
				 echo '<script>$(document).ready(function(){$("#addpat").addClass("md-show");});</script>';
			 }
			 else{
			 	if(!isset($makelink)){
					$req = $bdd->prepare('INSERT INTO utilisateurs (nom,prenom,email,tel,type,datenaissance,sexe,adresse) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
					$req->execute(array($nom, $prenom, $email, $tel, $_POST['type'], $dateb, $sexe, $adresse));
				}
				$emailpat = $bdd->query("select id from utilisateurs where email='$email' and nom='$nom' and prenom='$prenom'");
				$emailpat = $emailpat->fetchAll();
				$req = $bdd->prepare('INSERT INTO liens (idpat, idmed) VALUES(?, ?)');
				$req->execute(array($emailpat[0]['id'], $_SESSION['userid']));
				
			}
		}
	}
	?>