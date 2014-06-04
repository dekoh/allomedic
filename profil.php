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
				include('includes/header.inc.php');
				include('php/modpro.ex.php');
		?>
	    <div id="container">
	    	<div id="content">
		    	
				 <?php
					 if(isset($_GET['url'])){
			    			$idpro = $_GET['url'];
		    			}
		    			else{
			    			$idpro = $iduser;
		    			}
		    		$prof = $bdd->query("select * from utilisateurs where id=$idpro");
		    		$profil = $prof -> fetchAll();
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
				 ?>
		    	
		    	
		    	<div class="blocpro">
		    		
		    		<div class="col size-1">
			    	<div class="avatarprofil" style="width: 230px; height: 230px; background: url(<?php echo $lienphoto;?>) center no-repeat; background-size: cover;"><button class="modifphoto md-trigger" data-modal="modifphoto">modifier</button></div>
			    	<?php 
			    		if($profil[0]['id']!=$_SESSION['userid']){
				    	
			    	?>
			    	<button  class="md-trigger alert expand" data-modal="suppat">Supprimer le patient</button>
			    	<?php
			    		}
			    	?>
		    		</div>
			    	<h2 class="col size-2"><?php echo $profil[0]['nom']. " ".$profil[0]['prenom'];?><span class="modifbout md-trigger" data-modal="modifnom" data-nom="<?php echo $profil[0]['nom'];?>" data-prenom="<?php echo $profil[0]['prenom'];?>">Modifier</span></h2>
			    	<div  class="col size-1">
				    	<h3>Coordonnées</h3>
				    	<h4>Adresse email:<span class="modifbout md-trigger" data-modal="modifemail" data-email="<?php echo $profil[0]['email'];?>">Modifier</span></h4>
				    	<p><a href="mailto:<?php echo $profil[0]['email'];?>"><?php echo $profil[0]['email'];?></a></p>
				    	<h4>Numéro de téléphone: <span class="modifbout md-trigger" data-modal="modiftel" data-tel="<?php echo $profil[0]['tel'];?>">Modifier</span> </h4>
				    	<p><a href="sip:<?php echo $profil[0]['tel'];?>"><?php echo $tel;?></a></p>
				    	<h4>Adresse postale: <span class="modifbout md-trigger" data-modal="modifadr" data-adr="<?php echo $profil[0]['adresse'];?>">Modifier</span> </h4>
				    	<p><a href="geo:<?php echo $profil[0]['adresse'];?>"><?php echo $adresse;?></a></p>
			    	</div>
			    	<div  class="col size-1">
				    	<h3>Infos</h3>
				    	<h4>Sexe:<span class="modifbout md-trigger" data-modal="modifsexe" data-sexe="<?php echo $profil[0]['sexe']; ?>">Modifier</span></h4>
				    	<p><?php echo $sexe;?></p>
				    	<h4>Date de naissance:<span class="modifbout md-trigger" data-modal="modifdatenaissance" data-dn="<?php echo $profil[0]['datenaissance'];?>">Modifier</span></h4>
				    	<p><?php echo $profil[0]['datenaissance'].' ('.age($profil[0]['datenaissance']).'ans)';?></p>
			    	</div>
		    	</div>
		    			    	
	    	</div>
	    </div>
	    <?php
	    	echo $idpro;
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