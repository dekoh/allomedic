<?php 
	require "php/lib.php";
	if(isset($_POST['posttype'])){
		$motif = "#[^a-zA-Zàáâãäåòóôõöøèéêëçìíîïùúûüÿñ' ]#";
		$motifb = "#^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$#";
		$erreur= array();
		$msg = array();
		if($_POST['posttype']=="modifemail"){
			$idpat = $_POST['idpat'];
			$email = $_POST['email'];
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
				 $avertissement[] = "L'email n'est pas rempli";
			 }
			if(count($erreur)>0){
				 echo '<script>$(document).ready(function(){$("#modifemail").addClass("md-show");});</script>';
			 }
			 else{
			 	if(!isset($makelink)){
					$req = $bdd->prepare("UPDATE utilisateurs SET email='$email' WHERE id='$idpat'");
					$req->execute();
					$msg[]="L'email a bien été modifié";
				}
				else{
					if($_SESSION['type']=="med"){
						$reqb = $bdd->prepare("DELETE FROM liens WHERE idpat='$idpat'");
						$reqb->execute();
						$rr = $bdd->query("SELECT id FROM utilisateurs WHERE email='$email'");
						$emailp = $rr->fetchAll();
						$req = $bdd->prepare('INSERT INTO liens (idpat, idmed) VALUES(?, ?)');
						$req->execute(array($emailp[0]['id'], $_SESSION['userid']));
						$avertissement[]="Le patient existe déjà, un lien est créé avec ce patient. Si ce n'est pas l'action voulue n'hésitez pas à contacter l'assistance";
						
					}
					elseif($_SESSION['type']=="pat"){
						$alert[]="Il y a un soucis avec cet email, si le problème persiste n'hésitez pas a contacter l'assistance";
					}
				}
			 }
		}
		if($_POST['posttype']=="modifnom"){
			$idpat = $_POST['idpat'];
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$req = $bdd->prepare("UPDATE utilisateurs SET nom='$nom', prenom='$prenom' WHERE id='$idpat'");
			$req->execute();
			$msg[]="Le nom a bien été modifié";
		}
		if($_POST['posttype']=="modiftel"){
			$idpat = $_POST['idpat'];
			$tel = $_POST['telephone'];
			$req = $bdd->prepare("UPDATE utilisateurs SET tel='$tel' WHERE id='$idpat'");
			$req->execute();
			$msg[]="Le téléphone a bien été modifié";
		}
		if($_POST['posttype']=="modifadr"){
			$idpat = $_POST['idpat'];
			$adr = $_POST['adresse'];
			$req = $bdd->prepare("UPDATE utilisateurs SET adresse='$adr' WHERE id='$idpat'");
			$req->execute();
			$msg[]="L'adresse a bien été modifié";
		}
		if($_POST['posttype']=="modifsexe"){
			$idpat = $_POST['idpat'];
			$sexe = $_POST['sexe'];
			$req = $bdd->prepare("UPDATE utilisateurs SET sexe='$sexe' WHERE id='$idpat'");
			$req->execute();
			$msg[]="Le sexe a bien été modifié";
		}
		if($_POST['posttype']=="modifdate"){
			$idpat = $_POST['idpat'];
			$date = $_POST['date-naissance'];
			$req = $bdd->prepare("UPDATE utilisateurs SET datenaissance='$date' WHERE id='$idpat'");
			$req->execute();
			$msg[]="La date de naissance a bien été modifié";
		}
		if($_POST['posttype']=="suppat"){
			$idpat = $_POST['idpat'];
			$rr = $bdd->query("SELECT * FROM liens WHERE idpat=$idpat");
			$nblink = $rr->fetchAll();
			if(count($nblink)<2){
				$req = $bdd->prepare("DELETE FROM utilisateurs WHERE id='$idpat'");
				$req->execute();
			}
			$reqb = $bdd->prepare("DELETE FROM liens WHERE idpat='$idpat'");
			$reqb->execute();
			$msg[]="Le patient a bien été supprimé";
			if($reqb->rowCount()>0){
				echo "<script LANGUAGE='JavaScript'>
			document.location.href='patients?msg=patsup';
		</script>";
			}
		}
		if($_POST['posttype']=="modifavatar"){
			if(isset($_FILES['photo'])){
				// upload
				$dossier = 'images/avatar/';
				$dossiermini = 'images/avatar/min/';
				$fichier = basename($_FILES['photo']['name']);
				$taille_maxi = 5000000;
				$taille = filesize($_FILES['photo']['tmp_name']);
				$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.JPG', '.JPEG', '.PNG');
				$extension = strrchr($_FILES['photo']['name'], '.'); 
				//Début des vérifications de sécurité...
				if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
				{
				     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
				}
				if($taille>$taille_maxi)
				{
				     $erreur = 'Le fichier est trop gros...';
				}
				if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
				{
				     //On formate le nom du fichier ici...
				     $id = $_POST['idpat'];
				     $fichier = $id . $extension ;
				     
				     
				
				 
					if( isset($_FILES['photo']) && !$_FILES['photo']['error'] && $imagesize=getimagesize($_FILES['photo']['tmp_name']) )
					{
					    $extension = str_replace(array('image/','jpeg'), array('', 'jpg'), $imagesize['mime']);
					     
					    $image_path = $dossier .$fichier;
					    $thumb_path = $dossier.'min/'. $fichier;
					    
					    move_uploaded_file($_FILES['photo']['tmp_name'], $image_path);
					    imagethumb($image_path, $thumb_path, 320);
					    $msg[]="L'avatar a bien été modifié";
					}
				
				
				  				}
				else
				{
				     echo $erreur;
				}
			}
		}
	}
?>