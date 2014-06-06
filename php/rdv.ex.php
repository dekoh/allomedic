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
			 $msg = array();
			if(!empty($date)){
			 	if(validateDate($date)){
				 
					 $erreur['date'][0] = "La date n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['date'][1] = "La date n'est pas rempli";
			 }
			 if(!empty($heure)){
			 	if(!validateHeure($heure)){
				 
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
			if(isset($avertissement['patient'])){
				?>
			<script LANGUAGE="JavaScript">
				document.location.href="agenda/<?php echo $daterdv; ?>/donemp";
			</script>
			<?php
			}
			else{
			?>
			<script LANGUAGE="JavaScript">
				document.location.href="agenda/<?php echo $daterdv; ?>/done";
			</script>
			<?php
			}
			}
		}
		if($_POST['posttype']=="newpla"){
			$idmed= $_POST['idmed'];
			$typerdv = $_POST['type'];
			$jour =  $_POST['jour'];
			$duree =  $_POST['duree'];
			 $erreur = array();
			 if(!empty($_POST['hdebut'])){
			 	
				 if(!validateHeure($_POST['hdebut'])){
					
				 
					 $erreur['heured'][0] = "L'heure de début n'est pas valide"; 
				 }
				 else{
				 	 $datedebut = htomin($_POST['hdebut']);
				  }
			 }
			 else{
				 $erreur['heured'][1] = "L'heure de début n'est pas rempli";
			 }
			 if(!empty($_POST['hfin'])){
				 if(!validateHeure($_POST['hfin'])){
				 
					 $erreur['heuref'][0] = "L'heure de fin n'est pas valide"; 
				 }
				 else{
					 $datefin = htomin($_POST['hfin']);
					 
				 }
			 }
			 else{
				 $erreur['heuref'][1] = "L'heure de fin n'est pas rempli";
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

			if(count($erreur)>0){
				 echo '<script>$(document).ready(function(){$("#addpla").addClass("md-show");});</script>';
			 }
			 else{
				$req = $bdd->prepare('INSERT INTO plages (idmed, debut, fin, jour, type, duree) VALUES(?, ?, ?, ?, ?, ?)');
				$req->execute(array($idmed, $datedebut, $datefin, $jour, $typerdv, $duree));
			}
			
		}
		if($_POST['posttype']=="modpla"){
			$idpla= $_POST['idpla'];
			$typerdv = $_POST['type'];
			$jour =  $_POST['jour'];
			$duree =  $_POST['duree'];
			 $erreur = array();
			 if(!empty($_POST['hdebut'])){
			 	
				 if(!validateHeure($_POST['hdebut'])){
					
				 
					 $erreur['heured'][0] = "L'heure de début n'est pas valide"; 
				 }
				 else{
				 	 $datedebut = htomin($_POST['hdebut']);
				  }
			 }
			 else{
				 $erreur['heured'][1] = "L'heure de début n'est pas rempli";
			 }
			 if(!empty($_POST['hfin'])){
				 if(!validateHeure($_POST['hfin'])){
				 
					 $erreur['heuref'][0] = "L'heure de fin n'est pas valide"; 
				 }
				 else{
					 $datefin = htomin($_POST['hfin']);
					 
				 }
			 }
			 else{
				 $erreur['heuref'][1] = "L'heure de fin n'est pas rempli";
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

			if(count($erreur)>0){
				 echo '<script>$(document).ready(function(){$("#addpla").addClass("md-show");});</script>';
			 }
			 else{
				$req = $bdd->prepare("UPDATE plages SET debut=$datedebut, fin=$datefin, jour='$jour', type='$typerdv', duree=$duree WHERE id=$idpla");
				$req->execute();
			}

		}
		if($_POST['posttype']=="suppla"){
			$idpla = $_POST['idpla'];
			$req = $bdd->prepare("DELETE FROM plages WHERE id='$idpla'");
			$req->execute();
		}
		if($_POST['posttype']=="newcong"){
			$idmed= $_POST['idmed'];
			$daterdv= $_POST['datecon']." ".$_POST['heurecon'];
			$daterdv= str_replace('/', '-',$daterdv);
			$datecon = strtotime($daterdv);
			$daterdv= $_POST['dateb']." ".$_POST['heureb'];
			$daterdv= str_replace('/', '-',$daterdv);
			$dateconfin = strtotime($daterdv);
			$typerdv = "cong";
			if(!empty($_POST['heureb'])){
				 if(!validateHeure($_POST['heureb'])){
				 
					 $erreur['heureb'][0] = "L'heure de fin n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['heureb'][1] = "L'heure de fin n'est pas rempli"; 
			 }
			 if(!empty($_POST['heurecon'])){
				 if(!validateHeure($_POST['heurecon'])){
				 
					 $erreur['heurecon'][0] = "L'heure de début n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['heurecon'][1] = "L'heure de début n'est pas rempli"; 
			 }
			 if(!empty($_POST['dateb'])){
			 	if(validateDate($_POST['dateb'])){
				 
					 $erreur['dateb'][0] = "La date n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['dateb'][1] = "La date n'est pas rempli";
			 }
			 if(!empty($_POST['datecon'])){
			 	if(validateDate($_POST['datecon'])){
				 
					 $erreur['datecon'][0] = "La date n'est pas valide"; 
				 }
			 }
			 else{
				 $erreur['datecon'][1] = "La date n'est pas rempli";
			 }
			 if(count($erreur)>0){
				 echo '<script>$(document).ready(function(){$("#addcon").addClass("md-show");});</script>';
			 }
			 else{
				$req = $bdd->prepare('INSERT INTO rdv (idmed, date, datefin, type) VALUES(?, ?, ?, ?)');
				$req->execute(array($idmed, $datecon, $dateconfin, $typerdv));
			}

		}
		if($_POST['posttype']=="newrdvpat"){
			$idmed = $_POST['idmed'];
			$daterdv = $_POST['date'];
			$duree = $_POST['duree'];
			$duree = $duree * 60;
			$daterdvfin = $daterdv + $duree;
			$motifrdv = $_POST['motif'];
			$patientid =  $_POST['idpat'];
			$nomp = $bdd->query("SELECT * FROM utilisateurs WHERE id=$patientid");
			$nompat = $nomp->fetchAll();
			$nompatient = $nompat[0]['nom'].' '.$nompat[0]['prenom'];
			$typerdv = "rdv";
			
		$req = $bdd->prepare('INSERT INTO rdv (idmed, idpat, date, datefin, type, motif, nompatient) VALUES(?, ?, ?, ?, ?, ?, ?)');
			$req->execute(array($idmed, $patientid, $daterdv, $daterdvfin, $typerdv, $motifrdv, $nompatient));
			$msg[]="Le rendez-vous a bien été rajouté";
		}
	}
	?>