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
	    	<!--
<div class="sidebar">
		    	<table id="petitagenda">
		    		
			    	<thead>
			    		<caption class="headcal">
						    <a href="" class="prev">&lsaquo;</a>
						    <h1><?php echo recupmois(date("m", $tmstp))." ".date("Y", $tmstp) ; ?></h1>
						    <a href="" class="next">&rsaquo;</a>
						  </caption>
			    		<tr>
			    			<th>
				    			Lun
			    			</th>
			    			<th>
				    			Mar	
			    			</th>
			    			<th>
				    			Mer
			    			</th>
			    			<th>
				    			Jeu
			    			</th>
			    			<th>
				    			Ven
			    			</th>
			    			<th>
				    			Sam
			    			</th>
			    			<th>
				    			Dim
			    			</th>
			    		</tr>
			    	</thead>
			    	<tbody>
				    	<tr>
			    			<td class="oderm">
				    			24
			    			</td>
			    			<td class="oderm">
				    			25
			    			</td>
			    			<td class="oderm">
				    			26
			    			</td>
			    			<td class="oderm">
				    			27
			    			</td>
			    			<td class="oderm">
				    			28
			    			</td>
			    			<td>
				    			1
			    			</td>
			    			<td>
				    			2
			    			</td>
			    		</tr>
			    		<tr>
			    			<td>
				    			3
			    			</td>
			    			<td class="active">
				    			4
			    			</td>
			    			<td>
				    			5
			    			</td>
			    			<td>
				    			6
			    			</td>
			    			<td>
				    			7
			    			</td>
			    			<td>
				    			8
			    			</td>
			    			<td>
				    			9
			    			</td>
			    		</tr>
			    		<tr>
			    			<td>
				    			10
			    			</td>
			    			<td>
				    			11
			    			</td>
			    			<td>
				    			12
			    			</td>
			    			<td>
				    			13
			    			</td>
			    			<td>
				    			14
			    			</td>
			    			<td>
				    			15
			    			</td>
			    			<td>
				    			16
			    			</td>
			    		</tr>
			    		<tr>
			    			<td>
				    			17
			    			</td>
			    			<td>
				    			18
			    			</td>
			    			<td>
				    			19
			    			</td>
			    			<td>
				    			20
			    			</td>
			    			<td>
				    			21
			    			</td>
			    			<td>
				    			22
			    			</td>
			    			<td>
				    			23
			    			</td>
			    		</tr>
			    		<tr>
			    			<td>
				    			24
			    			</td>
			    			<td>
				    			25
			    			</td>
			    			<td>
				    			26
			    			</td>
			    			<td>
				    			27
			    			</td>
			    			<td>
				    			28
			    			</td>
			    			<td>
				    			29
			    			</td>
			    			<td>
				    			30
			    			</td>
			    		</tr>
			    		<tr>
			    			<td>
				    			31
			    			</td>
			    			<td class="oderm">
				    			1
			    			</td>
			    			<td class="oderm">
				    			2
			    			</td>
			    			<td class="oderm">
				    			3
			    			</td>
			    			<td class="oderm">
				    			4
			    			</td>
			    			<td class="oderm">
				    			5
			    			</td>
			    			<td class="oderm">
				    			6
			    			</td>
			    		</tr>
			    	</tbody>
		    	</table>
	    	</div>
-->
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
			    	if(count($rdv)<0){
				    	echo "Il n'y a pas de rendez-vous pour ce jour";
			    	}
			    	while($infordv = $rdv->fetch()){
			    		
			    		if($infordv['type']=="rdv"){
				    		$typederdv = "au cabinet";
			    		}
			    		if($infordv['type']=="domicile"){
				    		$typederdv = "au domicile du patient";
			    		}
			    		$idpat = $infordv['idpat'];
			    		$infopat = $bdd->query("SELECT * FROM utilisateurs WHERE id=$idpat");
			    		$pat = $infopat->fetchAll();
			    		$datepat = $pat[0]['datenaissance'];
				    	echo '<hr/>
		    	<a href="rdv/'.$infordv['id'].'"><div class="lieuheure col">
			    	<span class="timing">De '.date("H:i",$infordv['date']).' à '.date("H:i",$infordv['datefin']).'</span>
			    	<span class="lieudurdv">'.$typederdv.'</span>
		    	</div>
		    	
		    	<div class="quipq col">
			    	<span class="nomdupat"><a href="profil/'.$idpat.'">'.$infordv['nompatient'].'</a>, '.age($datepat).'ans</span>
			    	<span class="motifdupat">  > '.$infordv['motif'].'</span>
		    	</div></a>';
			    	}
		    	?>
		    	
		    	
		    	<!--
<div class="col modrdv">
			    	<span class="md-trigger" data-modal="modrdv" data-type="rdv">modifier</span> <span>annuler</span>
		    	</div>
-->
		    	
		    	<!--
<hr/>
		    	<div class="lieuheure col">
			    	<div class="timing">08h45-09h00</div>
			    	<div class="lieudurdv">au cabinet</div>
		    	</div>
		    	<a href="profil/6" class="avatar col" style="background: url(images/profilmen.jpg) no-repeat; background-size: cover;">av</a>
		    	<div class="quipq col">
			    	<div class="nomdupat"><a href="profil/6">Anderson Walter</a></div>
			    	<div class="motifdupat">Motif: douleur au poignet</div>
		    	</div>
		    	
		    	<hr/>
		    	<div class="lieuheure col">
			    	<div class="timing">09h15-09h30</div>
			    	<div class="lieudurdv">au cabinet</div>
		    	</div>
		    	<a href="profil/10" class="avatar col" style="background: url(images/profilwomen.jpg) no-repeat; background-size: cover;">av</a>
		    	<div class="quipq col">
			    	<div class="nomdupat"><a href="profil/10">Neil April</a></div>
			    	<div class="motifdupat">Motif: douleur au poignet</div>
		    	</div>
		    	
		    	<hr/>
		    	<div class="lieuheure col">
			    	<div class="timing">09h30-09h45</div>
			    	<div class="lieudurdv">au cabinet</div>
		    	</div>
		    	<a href="profil/17" class="avatar col" style="background: url(images/profilmen.jpg) no-repeat; background-size: cover;">av</a>
		    	<div class="quipq col">
			    	<div class="nomdupat"><a href="profil/17">Gardner Edward</a></div>
			    	<div class="motifdupat">Motif: douleur au poignet</div>
		    	</div>
-->
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