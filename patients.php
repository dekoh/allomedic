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
        <title>Patients - Allomedic - Prise de rendez-vous chez le médecin</title>

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
				
					include('php/profil.ex.php');
					
			
		?>
	    <div id="container">
	    	<?php
		    	include('includes/feedback.inc.php');
	    	?>
	    	<div id="content">
		    	
				 
		    	<button id="butadpat" class="md-trigger col pr-5" data-modal="addpat">Ajout d'un patient</button>
		    	<form id="search" method="get" class="col pr-5" action="patients">
					<fieldset>
						<input type="text" name="r" id="searchbar" placeholder="Rechercher" required />
						<input type="submit" id="searchsubmit" value="Search" />
					</fieldset>
				</form>
		    	<table id="tablepatient" class="tablesorter">
					<thead>
						<tr>
							<th class="havatar"> </th>
							<th class="hnom">Nom</th>
							<th class="hage" data-sorter="shortDate" data-date-format="ddmmyyyy">Age</th>
							<th class="hemail">Email</th>
							<th class="htel">Téléphone</th>
							<th class="hadr">Adresse</th>
						</tr>
					</thead>
					<tbody>
					
					
						<?php
							if(isset($_GET['r'])){
								
								$id=$_SESSION['userid'];
								$idp = $bdd->query("select * from liens where idmed=$id order by id desc");
								while($idpat = $idp->fetch()){
									$idpa = $idpat['idpat'];
									$recherche = $_GET['r'];
									$pati = $bdd->query("select * from utilisateurs where id=$idpa");
									$pat = $pati->fetchAll();
									$nom_patient = $pat[0]['nom'];
									$prenom_patient = $pat[0]['prenom'];
									$email_patient = $pat[0]['email'];
									$tel_patient = $pat[0]['tel'];
									$rech = explode(" ", $recherche);
									foreach($rech as $recherche){
										
									
									if(preg_match("/$recherche/i", "$nom_patient") || preg_match("/$recherche/i", "$prenom_patient") || preg_match("/$recherche/i", "$email_patient") || preg_match("/$recherche/i", "$tel_patient") )
									{
										$adre = stripslashes($pat[0]['adresse']);
										if(preg_match("'(.*)([0-9]{5})(.*)'s" ,$adre,$out)){
											$adresse = $out[1] . '</br>' . $out[2]. ' '. $out[3];
										}
										else{
											$adresse = $adre;
										}
										echo '<tr><td class="user-avatar"><a href="profil/'.$pat[0]['id'].'" class="'.$pat[0]['sexe'].'"';
									
										if (file_exists("images/avatar/".$pat[0]['id'].".jpg")) {
										echo ' style="background: url(images/avatar/'.$pat[0]['id'].'.jpg) no-repeat; background-size: cover;"';
										}
										echo '>av</a></td><td class="user-name"><a href="profil/'.$pat[0]['id'].'">'.$pat[0]['nom'].' '.$pat[0]['prenom'].'</a></td><td class="user-age" >';
										if(!empty($patient[0]['datenaissance'])){
											echo $patient[0]['datenaissance'].' ('.age($pat[0]['datenaissance']).'ans)';
										}
										echo '</td><td class="user-email">'.$pat[0]['email'].'</td><td class="user-phone">'.$pat[0]['tel'].'</td><td class="user-adress">'.$adresse.'</td></tr>';

									}
									}
								}
							}
							else{
								$id=$_SESSION['userid'];
								$idp = $bdd->query("select * from liens where idmed=$id order by id desc");
								while($idpat = $idp->fetch()){
									
									
									$idpatient = $idpat['idpat'];
									
									$patienti = $bdd->query("select * from utilisateurs where id=$idpatient");
									
									$patient = $patienti->fetchAll();
									
									$adre = stripslashes($patient[0]['adresse']);
									
									if(preg_match("'(.*)([0-9]{5})(.*)'s" ,$adre,$out)){
										$adresse = $out[1] . '</br>' . $out[2]. ' '. $out[3];
									}
									else{
										$adresse = $adre;
									}
							
									echo '<tr><td class="user-avatar"><a href="profil/'.$patient[0]['id'].'" class="'.$patient[0]['sexe'].'"';
									
									if (file_exists("images/avatar/".$patient[0]['id'].".jpg")) {
									echo ' style="background: url(images/avatar/'.$patient[0]['id'].'.jpg) no-repeat; background-size: cover;"';
									}
									echo '>av</a></td><td class="user-name"><a href="profil/'.$patient[0]['id'].'">'.$patient[0]['nom'].' '.$patient[0]['prenom'].'</a></td><td class="user-age" >';
									if(!empty($patient[0]['datenaissance'])){
										echo $patient[0]['datenaissance'].' ('.age($patient[0]['datenaissance']).'ans)';
									}
									echo '</td><td class="user-email">'.$patient[0]['email'].'</td><td class="user-phone">'.$patient[0]['tel'].'</td><td class="user-adress">'.$adresse.'</td></tr>';
								}
							}
															
						?>
					
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
				$("header #nav li a#patients").addClass('active');
				
				 $("#tablepatient")
				 
				 	.tablesorter({
                    sortList: [[0,1]], 
                    widgets: ['zebra'], 
                    dateFormat: 'uk', 
                    headers: { 2: {sorter: "shortDate"}, 3:{sorter: false}, 4:{sorter: false}, 5:{sorter: false}, 0:{sorter: false}}
                             });
				 
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