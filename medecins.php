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
		?>
	    <div id="container">
	    	<div id="content" class="medecins">
	    		<a href="profil/1" class="col">
		    		<div class="avatar" style="background:url(images/avatar/1.jpg) no-repeat; background-size: cover;"></div>
		    		<h1>Dr. Cabrol</h1>
		    		<p>Médecin généraliste</p>
		    		
	    		</a>
	    		<a href="profil/1" class="col">
		    		<div class="avatar" style="background:url(images/avatar/102.jpg) no-repeat; background-size: cover;"></div>
		    		<h1>Dr. Bérigné</h1>
		    		<p>Cardiologue</p>
		    		
	    		</a>
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