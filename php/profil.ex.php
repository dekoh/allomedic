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
			 $msg = array();
			 $avertissement = array();
			 $idu = $_SESSION['userid'];
			 $sel = $bdd->query("SELECT * FROM utilisateurs WHERE id=$idu");
			 $nommedic = $sel->fetchAll();
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
						 	while($liens = $lien->fetch()){
							 	if($liens['idmed']==$_SESSION['userid']){
							 		$erreur['email'][2] = "Il existe déjà un patient avec cet email";
							 	}
							 	else{
								 	$makelink=true;
							 	}
						 	}
						 	
						 }
					 }
					 
				 }
			 }
			 else{
				 $avertissement[] = "L'email n'est pas rempli";
			 }
			 if(!empty($tel)){
				 if(!preg_match($motiftel,$tel)){
						 $erreur['tel'] = "Le numéro de téléphone n'est pas valide"; 
					 }
			 }
			 if(!empty($dateb)){
			 	if(validateDate($dateb)){
				 
					 $erreur['datenaissance'][0] = "La date de naissance n'est pas valide"; 
				 }
				 else{
					 list($dd,$mm,$yyyy) = explode('/',$dateb);
					 if($yyyy>date("Y")||$yyyy<1900){
						 $erreur['datenaissance'][1] = "La date de naissance n'est pas normale"; 
					 }
				 }
			 }
			 if(count($erreur)>0){
				 echo '<script>$(document).ready(function(){$("#addpat").addClass("md-show");});</script>';
			 }
			 else{
			 	
			 	if(!isset($makelink)){
					$req = $bdd->prepare('INSERT INTO utilisateurs (nom,prenom,email,tel,type,datenaissance,sexe,adresse) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
					$req->execute(array($nom, $prenom, $email, $tel, $_POST['type'], $dateb, $sexe, $adresse));
					
					$emailpat = $bdd->query("select id from utilisateurs where nom='$nom' and prenom='$prenom'");
					$emailpati = $emailpat->fetchAll();
					$req = $bdd->prepare('INSERT INTO liens (idpat, idmed) VALUES(?, ?)');
					$req->execute(array($emailpati[0]['id'], $_SESSION['userid']));
					$msg[]="Le patient a bien été créé";
					if(!empty($email)){
						$to = $email;
					    $subject = 'Bienvenue sur Allomedic';
					    $message = '<p>Bonjour '.$prenom.' '.$nom.',</p>
					    <p>Bienvenue sur la plateforme allomedic, vous avez été ajouté par le docteur '.$nommedic[0]['nom'].'. Avant de vous permettre de prendre rendez-vous avec votre médecin, nous vous invitons a initialiser votre mot de passe en <a href="dekoh.eu/tfe/juin/nmp/'.md5("smp".$email).'">cliquant ici</a> </p>';
					    $headers = 'From: \"Allomedic\"<noreply@allomedic.com>' . "\r\n" .
					     'MIME-Version: 1.0' . "\r\n" .
					     'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					     mail($to, $subject, $message, $headers);
					}
				}
				else{
					$emailpat = $bdd->query("select id from utilisateurs where email='$email'");
					$emailpati = $emailpat->fetchAll();
					$req = $bdd->prepare('INSERT INTO liens (idpat, idmed) VALUES(?, ?)');
					$req->execute(array($emailpati[0]['id'], $_SESSION['userid']));
					$msg[]="Le patient a bien été créé";
					
					if(!empty($email)){
						$to = $email;
						$subject = 'Docteur '.$nommedic[0]['nom'].' vous a ajouté a ses patients';
					    $message = '<p>Bonjour '.$prenom.' '.$nom.',</p>
					    <p>Le docteur '.$nommedic[0]['nom'].' vous a bien ajouté à ses patients, vous pouvez désormais prendre rendez-vous avec ce médecin.</p>';
					    
					    $headers = 'From: \"Allomedic\"<noreply@allomedic.com>' . "\r\n" .
					     'MIME-Version: 1.0' . "\r\n" .
					     'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					     mail($to, $subject, $message, $headers);
					}

				}
				
			}
		}
	}
	?>