<?php 
	include("php/lib.php");
	$erreur = array();
	if(count($_POST)>0){
		if($_POST['posttype']=="newrdv"){
			$idmed= $_POST['idmed'];
			$date = $_POST['date'];
			$heure = $_POST['heure'];
			$daterdv= $_POST['date']." ".$_POST['heure'];
			$daterdv= str_replace('/', '-',$daterdv);
			$daterdv = strtotime($daterdv);
			$duree = $_POST['duree'];
			$dureerdv = $_POST['duree'] * 60;
			$daterdvfin = $daterdv + $dureerdv;
			$typerdv = $_POST['type'];
			$motifrdv = $_POST['motif'];
			 $erreur = array();
			 $avertissement = array();
			if(!empty($date)){
			 	if(validateDate($date)){
				 
					 $erreur['date'][0] = "La date n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['date'][1] = "La date n'est pas rempli";
			 }
			 if(!empty($heure)){
			 	if(validateHeure($heure)){
				 
					 $erreur['heure'][0] = "L'heure n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['heure'][1] = "L'heure n'est pas rempli";
			 }
			 if(!empty($duree)){
			 	if(!is_numeric($duree)){
				 
					 $erreur['duree'][0] = "La durée n'est pas valide"; 
				 }
				 else{
				 	if($duree<0){
					 	$erreur['duree'][2] = "La durée ne peut pas être négative"; 
				 	}
					if($duree>600){
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
				 echo '<script>$(document).ready(function(){$("#addrdv").addClass("md-show");});</script>';
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
					if($typerdv!="autre"){
						$avertissement['patient'] = "Cette personne ne fait pas partie de votre liste de patient.";
					}
					
				}
				$nompatient = $_POST['patient'];
			}
			$req = $bdd->prepare('INSERT INTO rdv (idmed, idpat, date, datefin, type, motif, nompatient) VALUES(?, ?, ?, ?, ?, ?, ?)');
			$req->execute(array($idmed, $patientid, $daterdv, $daterdvfin, $typerdv, $motifrdv, $nompatient));
			}
		}
		if($_POST['posttype']=="newpla"){
			$idmed= $_POST['idmed'];
			$datedebut = htomin($_POST['hdebut']);
			$datefin = htomin($_POST['hfin']);
			$typerdv = $_POST['type'];
			$jour =  $_POST['jour'];
			$duree =  $_POST['duree'];
			$req = $bdd->prepare('INSERT INTO plages (idmed, debut, fin, jour, type, duree) VALUES(?, ?, ?, ?, ?, ?)');
			$req->execute(array($idmed, $datedebut, $datefin, $jour, $typerdv, $duree));
			
		}
	}
	?>