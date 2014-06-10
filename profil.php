<?php 
	session_start();
ini_set('display_errors', 1); 
error_reporting(E_ALL); 
?> 
<?php
	$setRoot = true; // à mettre sur toutes les pages dont l'url comporte des répertoires virtuels
	include('includes/session-config.inc.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    
        <title>Profil - Allomedic - Prise de rendez-vous chez le médecin</title>

  		<?php
  			
			include('includes/metahead.inc.php');
		?>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script> 
    </head>
   
    <body>
    	<?php
    			if(isset($_SESSION['userid'])){
    			$iduser = $_SESSION['userid'];
    			if(isset($_GET['url'])){
			    			$idpro = $_GET['url'];
		    			}
		    			else{
			    			$idpro = $iduser;
		    			}
		    	$prof = $bdd->query("select * from utilisateurs where id=$idpro");
		    	$profil = $prof -> fetchAll();
				include('includes/header.inc.php');
				if($_SESSION['type']=="med" && $_SESSION['userid']!=$profil[0]['id']){
						$idpat = $profil[0]['id'];
						$idmed = $_SESSION['userid'];
						$link = $bdd->query("SELECT * FROM liens WHERE idpat=$idpat and idmed=$idmed");
						$nbl = $link->rowCount();
						if($nbl>0){
							$linkiok = true;
							$modiok = true;
						}
					}
					elseif($_SESSION['type']=="pat" && $_SESSION['userid']!=$profil[0]['id']){
						$idpat = $_SESSION['userid'];
						$idmed = $profil[0]['id'];
						$link = $bdd->query("SELECT * FROM liens WHERE idpat=$idpat and idmed=$idmed");
						$nbl = $link->rowCount();
						if($nbl>0){
							$linkiok = true;
						}
					}
					elseif($_SESSION['userid']==$profil[0]['id']){
						$modiok = true;
					}
				include('php/modpro.ex.php');
		?>
	    <div id="container">
	    	<?php
		    	include('includes/feedback.inc.php');
	    	?>
	    	<div id="content">
		    	
				 <?php
					
		    		
		    		if (file_exists("images/avatar/".$profil[0]['id'].".jpg")) {
			    		$lienphoto = "images/avatar/".$profil[0]['id'].".jpg";
		    		}
		    		else{
			    		if($profil[0]['sexe']=="h"){
				    		$lienphoto = "images/profilmen.jpg";
			    		}
			    		elseif($profil[0]['sexe']=="f"){
				    		$lienphoto = "images/profilwomen.jpg";
			    		}
			    		else{
				    		$lienphoto = "images/profilmen.jpg";
			    		}
		    		}
		    		if($profil[0]['sexe']=="h"){
				    		$sexe = "Homme";
			    		}
			    		elseif($profil[0]['sexe']=="f"){
				    		$sexe = "Femme";
			    		}
			    		else{
				    		$sexe = "N.D.";
			    		}
		    		$tel = str_replace("\r\n", " ", chunk_split($profil[0]['tel'], 2));
		    		$adre = stripslashes($profil[0]['adresse']);
								
								if(preg_match("'(.*)([0-9]{5})(.*)'s" ,$adre,$out)){
									$adresse = $out[1] . '</br>' . $out[2]. ' '. $out[3];
								}
								else{
									$adresse = $adre;
								}
					
					if($_SESSION['userid']==$profil[0]['id'] || isset($linkiok)){
				 ?>
		    	
		    	
		    	<div class="blocpro">
		    		
		    		<div class="col size-1">
			    	<div class="avatarprofil" style="width: 230px; height: 230px; background: url(<?php echo $lienphoto;?>) center no-repeat; background-size: cover;"><?php if($_SESSION['userid']==$profil[0]['id']||isset($modiok)){echo '<button class="modifphoto md-trigger" data-modal="modifphoto">modifier</button>';}?></div>
			    	<?php 
			    		if($profil[0]['id']!=$_SESSION['userid']||$_SESSION['type']=="med"){
				    	
			    	?>
			    	<?php if($profil[0]['type']=="pat"){if($_SESSION['userid']==$profil[0]['id']||isset($modiok)){echo '<button  class="md-trigger alert expand" data-modal="suppat">Supprimer le patient</button>';}}?>
			    	<?php
			    		}
			    	?>
		    		</div>
			    	<h2 class="col size-2"><?php echo $profil[0]['nom']. " ".$profil[0]['prenom'];?><?php if($_SESSION['userid']==$profil[0]['id']||isset($modiok)){echo '<span class="modifbout md-trigger" data-modal="modifnom" data-nom="'.$profil[0]['nom'].'" data-prenom="'.$profil[0]['prenom'].'">Modifier</span>';}?></h2>
			    	<div  class="col size-1">
				    	<h3>Coordonnées</h3>
				    	<h4>Adresse email:<?php if($_SESSION['userid']==$profil[0]['id']||isset($modiok)){echo '<span class="modifbout md-trigger" data-modal="modifemail" data-email="'.$profil[0]['email'].'">Modifier</span>';}?></h4>
				    	<p><a href="mailto:<?php echo $profil[0]['email'];?>"><?php echo $profil[0]['email'];?></a></p>
				    	<h4>Numéro de téléphone: <?php if($_SESSION['userid']==$profil[0]['id']||isset($modiok)){echo '<span class="modifbout md-trigger" data-modal="modiftel" data-tel="'.$profil[0]['tel'].'">Modifier</span>';}?> </h4>
				    	<p><a href="sip:<?php echo $profil[0]['tel'];?>"><?php echo $tel;?></a></p>
				    	<h4>Adresse postale: <?php if($_SESSION['userid']==$profil[0]['id']||isset($modiok)){echo '<span class="modifbout md-trigger" data-modal="modifadr" data-adr="'.$profil[0]['adresse'].'">Modifier</span>';}?> </h4>
				    	<p><a href="geo:<?php echo $profil[0]['adresse'];?>"><?php echo $adresse;?></a></p>
			    	</div>
			    	<div  class="col size-1">
				    	<h3>Infos</h3>
				    	<h4>Sexe:<?php if($_SESSION['userid']==$profil[0]['id']||isset($modiok)){echo '<span class="modifbout md-trigger" data-modal="modifsexe" data-sexe="'.$profil[0]['sexe'].'">Modifier</span>';}?></h4>
				    	<p><?php echo $sexe;?></p>
				    	<h4>Date de naissance:<?php if($_SESSION['userid']==$profil[0]['id']||isset($modiok)){echo '<span class="modifbout md-trigger" data-modal="modifdatenaissance" data-dn="'.$profil[0]['datenaissance'].'">Modifier</span>';}?></h4>
				    	<p><?php echo $profil[0]['datenaissance'].' ('.age($profil[0]['datenaissance']).'ans)';?></p>
			    	</div>
			    	
		    	</div>
		    			 <?php
			    			 }
			    			 else{
				    			 echo "Vous n'etes pas autorisé à voir ce profil.";
			    			 }
		    			 ?>   	
	    	</div>
	    	<?php
	    		if($_SESSION['type']=="med" && $profil[0]['type']=="pat"){
	    	?>
	    	<div id="content" class="mesrdv">
		    	<div class="col pr-5">
			    	<h1>Anciens rendez-vous</h1>
			    	<ul>
			    			
			    		<?php
			    			$dateauj = time();
			    			$idpatient = $profil[0]['id'];
				    		$rdv = $bdd->query("SELECT * FROM rdv WHERE idpat=$idpatient and annulation=0 and date<$dateauj and idmed=$iduser order by date desc");
				    		while($irdv = $rdv->fetch()){
				    			$idmedic = $irdv['idmed'];
				    			$medic = $bdd->query("SELECT * FROM utilisateurs WHERE id=$idmedic");
				    			$imedic = $medic->fetchAll();
					    		echo '<li><a href="rdv/'.$irdv['id'].'"><span class="date">'.date("d/m/Y",$irdv['date']).'</span> <span class="nommedic">Dr. '.$imedic[0]['nom'].'</span></a></li>';
				    		}
			    		?>
			    	</ul>
		    	</div>
		    	<div class="col pr-5">
			    	<h1>Futurs rendez-vous</h1>
			    	<ul>
			    		<?php
			    			$dateauj = time();
				    		$rdv = $bdd->query("SELECT * FROM rdv WHERE idpat=$idpatient and annulation=0 and date>$dateauj and idmed=$iduser order by date");
				    		while($irdv = $rdv->fetch()){
				    			if($irdv['type']=="rdv"){
						    		$typederdv = "au cabinet";
					    		}
					    		if($irdv['type']=="domicile"){
						    		$typederdv = "au domicile";
					    		}
				    			$idmedic = $irdv['idmed'];
				    			$medic = $bdd->query("SELECT * FROM utilisateurs WHERE id=$idmedic");
				    			$imedic = $medic->fetchAll();
					    		echo '<li><a href="rdv/'.$irdv['id'].'"><span class="date">'.date("d/m/Y",$irdv['date']).' à '.date("H:i",$irdv['date']).'</span> <span class="nommedic">Dr. '.$imedic[0]['nom'].'</span> - <span class="lieu">'.$typederdv.'</span></a></li>';
				    		}
			    		?>
				    	

		    	</div>
	    	</div>
	    	<?php
		    	}
	    	?>

	    </div>
	    <?php
		    include('includes/modal.inc.php');	
		?>
	    <script>
		    $(document).ready(function(){
				$("header #nav li a").removeClass('active');
				 				 
			});
	    </script>
    </body>
</html>
<?php
	     }
		   else{
			   ?><SCRIPT LANGUAGE="JavaScript">
document.location.href="f/..";
</SCRIPT><?php
		   }
		?>