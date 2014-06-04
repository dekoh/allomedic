<?php 
	require "php/lib.php";
	if(isset($_POST['posttype'])){
		if($_POST['posttype']=="modrdv"){
			
			$idmed = $_POST['idmed'];
			$idrdv = $_POST['idrdv'];
			$datedu = $_POST['date'];
			$heuredu = $_POST['heure'];
			$datedurdv= $_POST['date']." ".$_POST['heure'];
			$datedurdv= str_replace('/', '-',$datedurdv);
			$datedurdv = strtotime($datedurdv);
			$dureedurdv = $_POST['duree'];
			$dureedrdv = $_POST['duree'] * 60;
			$datedurdvfin = $datedurdv + $dureedrdv;
			$typedurdv = $_POST['type'];
			$motifdurdv = addslashes($_POST['motif']);
			 $erreur = array();
			 $avertissement = array();
			 if(!empty($datedu)){
			 	if(validateDate($datedu)){
				 
					 $erreur['date'][0] = "La date n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['date'][1] = "La date n'est pas rempli";
			 }
			 if(!empty($heuredu)){
			 	if(validateHeure($heuredu)){
				 
					 $erreur['heure'][0] = "L'heure n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['heure'][1] = "L'heure n'est pas rempli";
			 }
			 if(!empty($dureedurdv)){
			 	if(!is_numeric($dureedurdv)){
				 
					 $erreur['duree'][0] = "La durée n'est pas valide"; 
				 }
				 else{
				 	if($dureedurdv<0){
					 	$erreur['duree'][2] = "La durée ne peut pas être négative"; 
				 	}
					if($dureedurdv>600){
					 	$erreur['duree'][3] = "La durée est anormalement élevée..."; 
				 	}

				 }
			 }
			 else{
				 $erreur['duree'][1] = "La durée n'est pas rempli";
			 }
			 if(!empty($_POST['patient'])){
			 	$motif = "#[^a-zA-Zàáâãäåòóôõöøèéêëçìíîïùúûüÿñ' ]#";
			 	if(preg_match($motif,$_POST['patient'])){
					 $erreur['patient'][0] = "Le nom du patient n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['patient'][1] = "Le nom du patient n'est pas rempli";
			 }
			 if(count($erreur)>0){
				 echo '<script>$(document).ready(function(){$("#modrdv").addClass("md-show");});</script>';
			 }
			 else{

			 $idp = $bdd->query("select * from liens where idmed=$idmed");
			 while($idpat = $idp->fetch()){
				$idpatient = $idpat['idpat'];
				$patient = $bdd->query("select * from utilisateurs where id=$idpatient");
				$patient = $patient -> fetchAll(PDO::FETCH_ASSOC);
				$nompatient = $patient[0]['nom']." ".$patient[0]['prenom'];
				if($_POST['patient']==$nompatient){
					$patientid = $patient[0]['id'];
				}
				if(!isset($patientid)){
					$patientid = 0;
					if($typedurdv!="autre"){
						$avertissement['patient'] = "Cette personne ne fait pas partie de votre liste de patient.";
					}
					
				}
				$nompatient = addslashes($_POST['patient']);
			}
			$requuu = $bdd->prepare("UPDATE rdv SET date='$datedurdv', type='$typedurdv', nompatient='$nompatient', datefin='$datedurdvfin', motif='$motifdurdv', nompatient='$nompatient'  WHERE id='$idrdv'");
			$requuu->execute();
			$requuu->closeCursor();
			}
			
		
		}
		if($_POST['posttype']=="suprdv"){
			$idrdv = $_POST['idrdv'];
			$raison = $_POST['raison'];
			$req = $bdd->prepare("UPDATE rdv SET annulation='1', raison='$raison' WHERE id='$idrdv'");
			$req->execute();
			$req->closeCursor();
		}
	}
?>