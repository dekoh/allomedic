<?php 
	require "php/lib.php";
	if(isset($_POST['posttype'])){
		if($_POST['posttype']=="modifemail"){
			$idpat = $_POST['idpat'];
			$email = $_POST['email'];
			$req = $bdd->prepare("UPDATE utilisateurs SET email='$email' WHERE id='$idpat'");
			$req->execute();
		}
		if($_POST['posttype']=="modifnom"){
			$idpat = $_POST['idpat'];
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$req = $bdd->prepare("UPDATE utilisateurs SET nom='$nom', prenom='$prenom' WHERE id='$idpat'");
			$req->execute();
		}
		if($_POST['posttype']=="modiftel"){
			$idpat = $_POST['idpat'];
			$tel = $_POST['telephone'];
			$req = $bdd->prepare("UPDATE utilisateurs SET tel='$tel' WHERE id='$idpat'");
			$req->execute();
		}
		if($_POST['posttype']=="modifadr"){
			$idpat = $_POST['idpat'];
			$adr = $_POST['adresse'];
			$req = $bdd->prepare("UPDATE utilisateurs SET adresse='$adr' WHERE id='$idpat'");
			$req->execute();
		}
		if($_POST['posttype']=="modifsexe"){
			$idpat = $_POST['idpat'];
			$sexe = $_POST['sexe'];
			$req = $bdd->prepare("UPDATE utilisateurs SET sexe='$sexe' WHERE id='$idpat'");
			$req->execute();
		}
		if($_POST['posttype']=="modifdate"){
			$idpat = $_POST['idpat'];
			$date = $_POST['date-naissance'];
			$req = $bdd->prepare("UPDATE utilisateurs SET datenaissance='$date' WHERE id='$idpat'");
			$req->execute();
		}
		if($_POST['posttype']=="suppat"){
			$idpat = $_POST['idpat'];
			$req = $bdd->prepare("DELETE FROM utilisateurs WHERE id='$idpat'");
			$req->execute();
			$reqb = $bdd->prepare("DELETE FROM liens WHERE idpat='$idpat'");
			$reqb->execute();
			if($req->rowCount()>0){
				echo "<script LANGUAGE='JavaScript'>
			document.location.href='patients';
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