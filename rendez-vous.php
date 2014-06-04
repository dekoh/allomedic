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
    
        <title>Mes rendez-vous - Allomedic - Prise de rendez-vous chez le médecin</title>

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
				include('php/rdv.ex.php');
		?>
	    <div id="container">
	    	<div id="content" class="mesrdv">
		    	<div class="col pr-5">
			    	<h1>Anciens rendez-vous</h1>
			    	<ul>
			    			
			    		<?php
			    			$dateauj = time();
				    		$rdv = $bdd->query("SELECT * FROM rdv WHERE idpat=$iduser and annulation=0 and date<$dateauj order by date desc");
				    		while($irdv = $rdv->fetch()){
				    			$idmedic = $irdv['idmed'];
				    			$medic = $bdd->query("SELECT * FROM utilisateurs WHERE id=$idmedic");
				    			$imedic = $medic->fetchAll();
					    		echo '<li><a href="rdv/'.$irdv['id'].'"><span class="date">'.date("d/m/Y",$irdv['date']).'</span> <span class="nommedic">Dr. '.$imedic[0]['nom'].'</span></a></li>';
				    		}
			    		?>
				    	<!--
<li><span class="date">05/12/2013</span> <a href="profil/1" class="nommedic">Dr. Cabrol</a></li>
				    	<li><span class="date">02/11/2013</span> <a href="profil/1" class="nommedic">Dr. Cabrol</a></li>
				    	<li><span class="date">15/10/2013</span> <a href="profil/1" class="nommedic">Dr. Cabrol</a></li>
				    	<li><span class="date">22/07/2013</span> <a href="profil/1" class="nommedic">Dr. Cabrol</a></li>
				    	<li><span class="date">21/05/2013</span> <a href="profil/1" class="nommedic">Dr. Cabrol</a></li>
				    	<li><span class="date">18/01/2013</span> <a href="profil/1" class="nommedic">Dr. Cabrol</a></li>
-->
			    	</ul>
		    	</div>
		    	<div class="col pr-5">
			    	<h1>Futurs rendez-vous</h1>
			    	<ul>
			    		<?php
			    			$dateauj = time();
				    		$rdv = $bdd->query("SELECT * FROM rdv WHERE idpat=$iduser and annulation=0 and date>$dateauj order by date");
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
				    	<!-- <li><span class="date">18/05/2014 à 12h30</span> - <a href="profil/1" class="nommedic">Dr. Cabrol</a> - <span class="lieu">au cabinet</span></li> -->
			    	</ul>
			    	<a href="" class="button expand">Ajouter un rendez-vous</a>

		    	</div>
	    	</div>
	    </div>
	    <?php
		    include('includes/modal.inc.php');	
		?>
	    <script>
		    $(document).ready(function(){
				$("header #nav li a").removeClass('active');
				$("header #nav li a#agenda").addClass('active');
				 				 
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