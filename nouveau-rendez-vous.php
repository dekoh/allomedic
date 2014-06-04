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
        <title>Nouveau rendez-vous - Allomedic - Prise de rendez-vous chez le médecin</title>

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
	    	<div id="content" class="medecins">
	    		<?php
	    			if(isset($_GET['url'])){
	    				$idmedic = $_GET['url'];
		    			if(isset($_GET['date'])){
				    		$dateauj = explode("/",date("d/m/Y", intval($_GET['date'])));
				    		$tmstp = intval($_GET['date']);
			    		}
			    		else{
			    			$dateauj= explode("/",date("d/m/Y"));
			    			$tmstp = date('d/m/Y');
			    			$tmstp = str_replace('/', '-',$tmstp);
			    			$tmstp = strtotime($tmstp);
			    		}
			    		$datetmstp = date('d/m/Y');
			    		$datetmstp= str_replace('/', '-',$datetmstp);
						if(date("D",$tmstp)=="Mon"){
			    			$datemon=$tmstp;
			    			$datetue=$tmstp + 86400;
			    			$datewed=$tmstp + (2*86400);
			    			$datethu=$tmstp + (3*86400);
			    			$datefri=$tmstp + (4*86400);
			    			$datesat=$tmstp + (5*86400);
			    			$datesun=$tmstp + (6*86400);
			    		}
			    		if(date("D",$tmstp)=="Tue"){
			    			$datemon=$tmstp - 86400;
			    			$datetue=$tmstp;
			    			$datewed=$tmstp + (1*86400);
			    			$datethu=$tmstp + (2*86400);
			    			$datefri=$tmstp + (3*86400);
			    			$datesat=$tmstp + (4*86400);
			    			$datesun=$tmstp + (5*86400);
			    		}
		
			    		if(date("D",$tmstp)=="Wed"){
			    			$datemon=$tmstp - (2*86400);
			    			$datetue=$tmstp - (1*86400);
			    			$datewed=$tmstp;
			    			$datethu=$tmstp + (1*86400);
			    			$datefri=$tmstp + (2*86400);
			    			$datesat=$tmstp + (3*86400);
			    			$datesun=$tmstp + (4*86400);
			    		}
			    		if(date("D",$tmstp)=="Thu"){
			    			$datemon=$tmstp - (3*86400);
			    			$datetue=$tmstp - (2*86400);
			    			$datewed=$tmstp - (1*86400);
			    			$datethu=$tmstp;
			    			$datefri=$tmstp + (1*86400);
			    			$datesat=$tmstp + (2*86400);
			    			$datesun=$tmstp + (3*86400);
			    		}
			    		if(date("D",$tmstp)=="Fri"){
			    			$datemon=$tmstp - (4*86400);
			    			$datetue=$tmstp - (3*86400);
			    			$datewed=$tmstp - (2*86400);
			    			$datethu=$tmstp - (1*86400);
			    			$datefri=$tmstp;
			    			$datesat=$tmstp + (1*86400);
			    			$datesun=$tmstp + (2*86400);
			    		}
			    		if(date("D",$tmstp)=="Sat"){
			    			$datemon=$tmstp - (5*86400);
			    			$datetue=$tmstp - (4*86400);
			    			$datewed=$tmstp - (3*86400);
			    			$datethu=$tmstp - (2*86400);
			    			$datefri=$tmstp - (1*86400);
			    			$datesat=$tmstp;
			    			$datesun=$tmstp + (1*86400);
			    		}
			    		if(date("D",$tmstp)=="Sun"){
			    			$datemon=$tmstp + 86400;
			    			$datetue=$tmstp + (2*86400);
			    			$datewed=$tmstp + (3*86400);
			    			$datethu=$tmstp + (4*86400);
			    			$datefri=$tmstp + (5*86400);
			    			$datesat=$tmstp + (6*86400);
			    			$datesun=$tmstp + (7*86400);
			    		}
			    		$datemonday = date("d/m/Y", $datemon);
			    		$datetuesday = date("d/m/Y", $datetue);
			    		$datewednesday = date("d/m/Y", $datewed);
			    		$datethursday = date("d/m/Y", $datethu);
			    		$datefriday = date("d/m/Y", $datefri);
			    		$datesaturday = date("d/m/Y", $datesat);
			    		$datesunday = date("d/m/Y", $datesun);
			    		
			    		$datesem= str_replace('/', '-', $datemonday);
			    		$datesem = strtotime($datesem);
			    		$datesemm = $datesem - 604800;
			    		$datesemp = $datesem + 604800;
			    		?>
				    
				    	<a href="nouveau-rendez-vous/<?php echo $idmedic."/".$datesemm ;?>" class="button fleche gauche"><div><</div></a>
				    	<a href="nouveau-rendez-vous/<?php echo $idmedic."/".$datesemp ;?>" class="button fleche droite"><div>></div></a>
				    	<?php 
				    		
				    		if(date("m", $datemon)==date("m", $datesun)){
					    		echo "<span class='datesem'>". date("d", $datemon)."-".date("d", $datesun)." ".recupmois(date("m", $datesun))." ".date("Y", $datesun)."</span>" ;
				    		}
				    		else{
					    		echo "<span class='datesem'>". date("d", $datemon)." ".recupmois(date("m", $datemon))." ".date("Y", $datemon)." - ".date("d", $datesun)." ".recupmois(date("m", $datesun))." ".date("Y", $datesun)."</span>" ;
				    		}
				    		?>
				   <table id="tableagenda" class="forpatient">
					<thead>
						<tr>
							<th id="Mon" class="<?php echo $datemon;  ?>">Lundi <small><?php echo date("d/m/Y",$datemon);  ?></small></th>
							<th id="Tue" class="<?php echo $datetue;  ?>">Mardi <small><?php echo date("d/m/Y",$datetue);  ?></small></th>
							<th id="Wed" class="<?php echo $datewed;  ?>">Mercredi <small><?php echo date("d/m/Y",$datewed);  ?></small></th>
							<th id="Thu" class="<?php echo $datethu;  ?>">Jeudi <small><?php echo date("d/m/Y",$datethu);  ?></small></th>
							<th id="Fri" class="<?php echo $datefri;  ?>">Vendredi <small><?php echo date("d/m/Y",$datefri);  ?></small></th>
							<th id="Sat" class="<?php echo $datesat;  ?>">Samedi <small><?php echo date("d/m/Y",$datesat);  ?></small></th>
							
						</tr>
					</thead>
					<tbody>
					<tr>
						<td valign=top>
							<ul>
							
								<?php
									afficherPlagelibre($datemonday,"mon",$bdd,$idmedic);
									
								?>
								
								
									
							</ul>
						</td>
						<td valign=top>
							<ul>
								<?php
									afficherPlagelibre($datetuesday,"tue",$bdd,$idmedic);
								?>
							</ul>
						</td>
						<td valign=top>
							<ul>
								<?php
									afficherPlagelibre($datewednesday,"wed",$bdd,$idmedic);
								?>
							</ul>
						</td>
						<td valign=top>
							<ul>
								<?php
									afficherPlagelibre($datethursday,"thu",$bdd,$idmedic);
								?>
							</ul>
						</td>
						<td valign=top>
							<ul>
								<?php
									afficherPlagelibre($datefriday,"fri",$bdd,$idmedic);
								?>
							</ul>
						</td>
						<td valign=top>
							<ul>
								<?php
									afficherPlagelibre($datesaturday,"sat",$bdd,$idmedic);
								?>
							</ul>
						</td>
						
					</tr>
					</tbody>
		    	</table>

				    		<?PHP
				    	

	    		
	    			}
	    			else{
	    				echo "<h2>Choisissez le médecin avec qui vous voulez prendre rendez-vous</h2>";
			    		$med = $bdd->query("SELECT * FROM liens WHERE idpat=$iduser");
			    		while($idmed=$med->fetch()){
			    			$idmedic = $idmed['idmed'];
			    			$medic = $bdd->query("SELECT * FROM utilisateurs WHERE id=$idmedic");
			    			$imedic = $medic->fetchAll();
				    		echo '<a href="nouveau-rendez-vous/'.$idmedic.'" class="col">
			    		<div class="avatar" style="background:url(images/avatar/'.$idmedic.'.jpg) no-repeat; background-size: cover;"></div>
			    		<h1>Dr. '.$imedic[0]['nom'].'</h1>
			    		<p>'.$imedic[0]['typemed'].'</p>
			    		
		    		</a>';
			    		}
		    		}
	    		?>

	    		    <?php
		    include('includes/modal.inc.php');	
		  ?>
	    <script>
		    $(document).ready(function(){
				$("header #nav li a").removeClass('active');
				$("header #nav li a#agenda").addClass('active');
				$("#tableagenda thead tr th.<?php echo strtotime($datetmstp); ?>").addClass('active');
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