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
	    		$debutj= 510;
	    		$finj= 1020;
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
	    			$datesun=$tmstp;
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
	    
	    	<a href="agenda?date=<?php echo $datesemm ;?>" class="button fleche gauche"><div><</div></a>
	    	<a href="agenda?date=<?php echo $datesemp ;?>" class="button fleche droite"><div>></div></a>
	    	<?php 
	    		
	    		if(date("m", $datemon)==date("m", $datesun)){
		    		echo "<span class='datesem'>". date("d", $datemon)."-".date("d", $datesun)." ".recupmois(date("m", $datesun))." ".date("Y", $datesun)."</span>" ;
	    		}
	    		else{
		    		echo "<span class='datesem'>". date("d", $datemon)." ".recupmois(date("m", $datemon))." ".date("Y", $datemon)." - ".date("d", $datesun)." ".recupmois(date("m", $datesun))." ".date("Y", $datesun)."</span>" ;
	    		}
	    				    	
	    	?>
	    	<ul id="menuagenda">
		    	<li><a href="agenda-jour">Jour</a></li>
		    	<li><a href="agenda">Semaine</a></li>
		    	<li><button id="ajoutagenda"  class="md-trigger" data-modal="addrdv"><div>+</div></button></li>
		    	<li><a href="agenda-options" id="optionagenda" class="button"><div>Options</div></a></li>
	    	</ul>
		    	<table id="tableagenda">
					<thead>
						<tr>
							<th id="Mon" class="<?php echo $datemon;  ?>"><a href="agenda-jour/<?php echo $datemon; ?>">Lundi <small><?php echo date("d/m/Y",$datemon);  ?></small></a></th>
							<th id="Tue" class="<?php echo $datetue;  ?>"><a href="agenda-jour/<?php echo $datetue; ?>">Mardi <small><?php echo date("d/m/Y",$datetue);  ?></small></a></th>
							<th id="Wed" class="<?php echo $datewed;  ?>"><a href="agenda-jour/<?php echo $datewed; ?>">Mercredi <small><?php echo date("d/m/Y",$datewed);  ?></small></a></th>
							<th id="Thu" class="<?php echo $datethu;  ?>"><a href="agenda-jour/<?php echo $datethu; ?>">Jeudi <small><?php echo date("d/m/Y",$datethu);  ?></small></a></th>
							<th id="Fri" class="<?php echo $datefri;  ?>"><a href="agenda-jour/<?php echo $datefri; ?>">Vendredi <small><?php echo date("d/m/Y",$datefri);  ?></small></a></th>
							<th id="Sat" class="<?php echo $datesat;  ?>"><a href="agenda-jour/<?php echo $datesat; ?>">Samedi <small><?php echo date("d/m/Y",$datesat);  ?></small></a></th>
							<!-- <th id="Sun" class="<?php echo $datesun;  ?>">Dimanche <small><?php echo $datesun[0]."/".$datesun[1]."/".$datesun[2];  ?></small></th> -->
						</tr>
					</thead>
					<tbody>
					<tr>
						<td>
							<ul>
							
								<?php
									$heighttot = afficherAgenda($datemonday,"mon",$bdd,$debutj,$finj);
									
								?>
								
								
									
							</ul>
						</td>
						<td>
							<ul>
								<?php
									$heightot = afficherAgenda($datetuesday,"tue",$bdd,$debutj,$finj);	
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}
								?>
							</ul>
						</td>
						<td>
							<ul>
								<?php
									$heightot = afficherAgenda($datewednesday,"wed",$bdd,$debutj,$finj);
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}
								?>
							</ul>
						</td>
						<td>
							<ul>
								<?php
									$heightot = afficherAgenda($datethursday,"thu",$bdd,$debutj,$finj);
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}
								?>
							</ul>
						</td>
						<td>
							<ul>
								<?php
									$heightot = afficherAgenda($datefriday,"fri",$bdd,$debutj,$finj);
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}
								?>
							</ul>
						</td>
						<td>
							<ul>
								<?php
									$heightot = afficherAgenda($datesaturday,"sat",$bdd,$debutj,$finj);
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}
								?>
							</ul>
						</td>
						
					</tr>
					</tbody>
		    	</table>
		    	
	    	</div>
	    </div>
	    <?php
		    include('includes/modal.inc.php');	
		  ?>
	    <script>
		    $(document).ready(function(){
				$("header #nav li a").removeClass('active');
				$("header #nav li a#agenda").addClass('active');
				$("#tableagenda ul").css( "height", "<?php echo $heighttot; ?>" );
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