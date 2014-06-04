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
				$widthtab = 100 / 7;
				$debutj= 510;
				$heighttot=60;
		?>
	    <div id="container">
	    	<div id="content">
	    	<a class="button mobmarbot col pr-5" href="agenda"> &lt;- Retour à l'agenda</a>
	    	<button  class="md-trigger mobmarbot col pr-5" data-modal="addpla">+ Ajout d'une plage horaire</button>
		    	<table id="tableagenda">
					<thead>
						<tr>
							<th id="Mon" style="width:<?php echo $widthtab; ?>%;">Lundi</th>
							<th id="Tue" style="width:<?php echo $widthtab; ?>%;">Mardi</th>
							<th id="Wed" style="width:<?php echo $widthtab; ?>%;">Mercredi</th>
							<th id="Thu" style="width:<?php echo $widthtab; ?>%;">Jeudi</th>
							<th id="Fri" style="width:<?php echo $widthtab; ?>%;">Vendredi</th>
							<th id="Sat" style="width:<?php echo $widthtab; ?>%;">Samedi</th>
							<th id="Sun" style="width:<?php echo $widthtab; ?>%;">Dimanche</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td>
							<ul class="jourpla">
								
									<?php
									$heightot = afficherPlages("mon",$bdd,$debutj);
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}

									?>
							
								
									
							</ul>
						</td>
						<td>
							<ul class="jourpla">
								
									<?php
									$heightot = afficherPlages("tue",$bdd,$debutj);
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}

									?>
							</ul>
						</td>
						<td>
							<ul class="jourpla">
								
									<?php
									$heightot = afficherPlages("wed",$bdd,$debutj);
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}

									?>
							</ul>
						</td>
						<td>
							<ul class="jourpla">
								
									<?php
									$heightot = afficherPlages("thu",$bdd,$debutj);
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}

									?>
							</ul>
						</td>
						<td>
							<ul class="jourpla">
								
									<?php
									$heightot = afficherPlages("fri",$bdd,$debutj);
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}

									?>
							</ul>
						</td>
						<td>
							<ul class="jourpla">
								
									<?php
									$heightot = afficherPlages("sat",$bdd,$debutj);
									if($heightot > $heighttot){
										$heighttot = $heightot;
									}

									?>
							</ul>
						</td>
						<td>
							<ul class="jourpla">
								
									<?php
									$heightot = afficherPlages("sun",$bdd,$debutj);
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