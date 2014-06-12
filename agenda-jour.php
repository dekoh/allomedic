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
    	
        <title>Agenda - Allomedic - Prise de rendez-vous chez le médecin</title>

  		<?php
  			$setRoot = true; 
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
	    	<?php
	    		if(isset($_GET['url'])){
		    		$dateauj = explode("/",date("d/m/Y", intval($_GET['url'])));
		    		$tmstp = intval($_GET['url']);
	    		}
	    		else{
	    			$dateauj= explode("/",date("d/m/Y"));
	    			$tmstp = time();
	    		}
	    		
	    		$premierdumois = "1/".date("m/Y");
	    		$tmstppremierdumois = str_replace('/', '-',$premierdumois);
	    		$tmstppremierdumois = strtotime($tmstppremierdumois);
	    		$jourpdm = date("D", $tmstppremierdumois);
	    	?>
	    
	    	<a href="agenda-jour/<?php echo $tmstp-86400;?>" class="button fleche gauche"><div><</div></a>
	    	<a href="agenda-jour/<?php echo $tmstp+86400;?>" class="button fleche droite"><div>></div></a>
	    	<?php 
	    		
	    		
		    		echo "<span class='datesem'>".ucfirst(recupjour(date("D", $tmstp)))." ". date("d", $tmstp)." ".recupmois(date("m", $tmstp))." ".date("Y", $tmstp)." </span>" ;
	    		
	    				    	
	    	?>
	    	<ul id="menuagenda">
		    	<li><a href="agenda-jour">Jour</a></li>
		    	<li><a href="agenda">Semaine</a></li>
		    	<li><button id="ajoutagenda"  class="md-trigger" data-modal="addrdv"><div>+</div></button></li>
		    	<li><a href="agenda-options" id="optionagenda" class="button"><div>Options</div></a></li>
	    	</ul>
	    	<div class="contenucalj">
	   	    	<div id="calendarday">
		    	
		    	<?php
			    	if(isset($_GET['url'])){
				    	$jour = $_GET['url'];
				    	
			    	}
			    	else{
				    	$jour = time();
			    	}
			    	$datejour = date("d-m-Y",$jour);
			    	$datejour = strtotime($datejour);
			    	$datelendemain = $datejour + 86400;
			    	$id = $_SESSION['userid'];
			    	$rdv = $bdd->query("SELECT * FROM rdv WHERE idmed=$id and annulation=0 and date between $datejour and $datelendemain order by date");
			    	$nrdv = $rdv->rowCount(); 
			    	$fer = $bdd->query("SELECT * FROM ferie WHERE date=$datejour");
			    	$feri = $fer->rowCount();
			    	if(date("D", $tmstp)=="Sun"){
				    	echo "<span class='clrdvj'>C'est dimanche</span>";
				    	
			    	}
			    	elseif($feri>0){
				    	$ferie = $fer->fetchAll();
				    	echo "<span class='clrdvj'>".$ferie[0]['nom']."</span>";
			    	}
			    	elseif($nrdv<1){
				    	echo "<span class='clrdvj'>Il n'y a pas de rendez-vous pour ce jour</span>";
			    	}
			    	
			    	while($infordv = $rdv->fetch()){
			    		
			    		if($infordv['type']=="rdv"){
				    		$typederdv = "au cabinet";
			    		}
			    		if($infordv['type']=="domicile"){
				    		$typederdv = "au domicile du patient";
			    		}
			    		$idpat = $infordv['idpat'];
			    		if(isset($infordv['idpat'])&&$infordv['idpat']!=0){
				    		$infopat = $bdd->query("SELECT * FROM utilisateurs WHERE id=$idpat");
				    		$pat = $infopat->fetchAll();
				    		
				    		$datepat = $pat[0]['datenaissance'];
			    		}
			    		
				    	echo '<hr/>
		    	<a href="rdv/'.$infordv['id'].'"><div class="lieuheure col">
			    	<span class="timing">De '.date("H:i",$infordv['date']).' à '.date("H:i",$infordv['datefin']).'</span>
			    	<span class="lieudurdv">'.$typederdv.'</span>
		    	</div>
		    	
		    	<div class="quipq col">
			    	<span class="nomdupat"><a href="profil/'.$idpat.'">'.$infordv['nompatient'].'</a>';
			    		if(isset($datepat)){
			    			echo ', '.age($datepat).'ans';	
			    		}
			    		echo '</span>
			    	<span class="motifdupat">  > '.$infordv['motif'].'</span>
		    	</div></a>';
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