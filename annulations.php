<?php 
	session_start();
ini_set('display_errors', 1); 
error_reporting(E_ALL); 
?> 
<?php
	include('includes/session-config.inc.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    	
        <title>Annulations - Allomedic - Prise de rendez-vous chez le médecin</title>

  		<?php
  			$setRoot = true; // à mettre sur toutes les pages dont l'url comporte des répertoires virtuels
			include('includes/metahead.inc.php');
		?>
    </head>
   
    <body>
    	
    	<?php
    			if(isset($_SESSION['userid'])){
	    			
    			
    			$iduser = $_SESSION['userid'];
				include('includes/header.inc.php');
				include('php/rdv.ex.php');
		?>
	    <div id="container">
	    	<div id="content">
	    	
	    	
	    	<div class="contenucalj">
	   	    	<div id="calendarday">
		    	
		    	<?php
			    	$id = $_SESSION['userid'];
			    	$rdv = $bdd->query("SELECT * FROM rdv WHERE idmed=$id and annulation=1 order by date desc");
			    	
			    	while($rdva = $rdv->fetch()){
			    		
			    		$idpat = $rdva['idpat'];
			    		$infopat = $bdd->query("SELECT * FROM utilisateurs WHERE id=$idpat");
			    		$pat = $infopat->fetchAll();
			    		$datepat = $pat[0]['datenaissance'];
			    		if($rdva['lu']==1){
				    		$lu = "lu";
			    		}
			    		else{
				    		$lu = "";
			    		}
				    	echo '<hr/>
				    	<div class="annulation '.$lu.'">
		    	<a href="rdv/'.$rdva['id'].'"><div class="lieuheure col">
			    	<span class="timing">Le '.date("d/m/Y", $rdva['date']).' de '.date("H:i",$rdva['date']).' à '.date("H:i",$rdva['datefin']).'</span>
			    	
		    	</div>
		    	
		    	<div class="quipq col">
			    	<span class="nomdupat"><a href="profil/'.$idpat.'">'.$rdva['nompatient'].'</a>, '.age($datepat).'ans</span>
			    	<span class="motifdupat">  > '.$rdva['motif'].'</span>
		    	</div></a></div>';
		    		$idrdv = $rdva['id'];
	   	    		$req = $bdd->query("UPDATE rdv SET lu=1 WHERE id=$idrdv");
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
				$("header #nav li a#agenda").addClass('active');
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