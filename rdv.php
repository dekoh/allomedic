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
    
        <title>Rendez-vous - Allomedic - Prise de rendez-vous chez le médecin</title>

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
				include('php/modrdv.ex.php');
				
		?>
	    <div id="container">
	    	<div id="content">
		    	
				 <?php
					 if(isset($_GET['url'])){
			    			$idrdv = $_GET['url'];
		    			}
		    		
		    		$rdv = $bdd->query("select * from rdv where id=$idrdv");	
		    		$infordv = $rdv -> fetchAll();
		    		$idpro = $infordv[0]['idpat'];
		    		$motifrdv = $infordv[0]['motif'];
		    		$typerdv = $infordv[0]['type'];
		    		if($infordv[0]['type']=="rdv"){
			    		$typederdv = "au cabinet";
		    		}
		    		if($infordv[0]['type']=="domicile"){
			    		$typederdv = "au domicile du patient";
		    		}
		    		$dureerdv = $infordv[0]['datefin'] - $infordv[0]['date'] ;
		    		$dureerdv = $dureerdv/60;
		    		$daterdv = date("d/m/Y",$infordv[0]['date']);
		    		$jourrdv = recupjour(date("D",$infordv[0]['date']));
		    		$heurerdv = date("H:i",$infordv[0]['date']);
		    		$prof = $bdd->query("select * from utilisateurs where id=$idpro");
		    		$profil = $prof -> fetchAll();
		    		$nompat = $profil[0]['nom']. " ".$profil[0]['prenom'];
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
		    		$age = age($profil[0]['datenaissance']);
		    		
				 ?>
		    	
		    	
		    	<div class="blocpro blocrdv">
		    		
		    		<div class="col size-1">
		    		<?php
			    		if($idpro>0){
		    		?>
			    	<a href="profil/<?php echo $profil[0]['id'];?>"><div class="avatarprofil" style="width: 230px; height: 230px; background: url(<?php echo $lienphoto;?>) center no-repeat; background-size: cover;"></div></a>
			    	<?php
				    	}
				    	else{
					    	?>
					    	<div class="avatarprofil" style="width: 230px; height: 230px; background: url(<?php echo $lienphoto;?>) center no-repeat; background-size: cover;"></div>
					    	<?php
				    	}
			    	?>
		    		</div>
		    		<?php
			    		if($idpro>0){
		    		?>
			    	<h2 class="col size-2"><a href="profil/<?php echo $profil[0]['id'];?>"><?php echo $profil[0]['nom']. " ".$profil[0]['prenom']."</a>, ".$age."ans";?></h2>
			    	<?php
				    	}
				    	else{
				    		$nompat = v;
					    	?>
					    	<h2 class="col size-2"><?php echo $infordv[0]['nompatient'];?></h2>
					    	<?php
				    	}
			    	?>
			    	<div  class="col size-2">
			    		<p>Le <?php echo $jourrdv." ".$daterdv;?> à <?php echo $heurerdv;?></p>
			    		<p>Rendez-vous <?php echo $typederdv; ?>  </p>
			    		<p>Durée du rendez-vous: <?php echo $dureerdv." minutes"; ?></p>
				    	<p>Motif: <?php echo $motifrdv;?></p>
				    	
				    	<?php
					    	if($infordv[0]['annulation']==0){
						   
				    	?>
				    	<button  class="md-trigger col pr-5 mabot" data-modal="modrdv" data-type="<?php echo $typerdv; ?>">Modifier le rendez-vous</button>
				    	<button  class="md-trigger alert col pr-5 maleft" data-modal="suprdv">Annuler le rendez-vous</button>
				    	<?php
					    	}
					    	else{
						    	echo "<p>Ce rendez-vous est annulé pour les raisons suivantes: ".$infordv[0]['raison']."</p>";
						    	echo "<div class='annulé'>Annulé</div>";
					    	}
				    	?>
			    	</div>
			    	
		    	</div>
		    			    	
	    	</div>
	    </div>
	    <?php
		    include('includes/modal.inc.php');	
		?>
	    <script>
		    $(document).ready(function(){
				$("header #nav li a").removeClass('active');
				 				 
			});
	    </script>
	    <!--
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
	    <script src="js/jquery.stickyheader.js"></script>
-->
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