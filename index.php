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
        <title>Allomedic - Prise de rendez-vous chez le médecin</title>

  		<?php
			include('includes/metahead.inc.php');
		    include('php/connexion.ex.php');
		?>
    </head>
   
    <body>
    	<?php
    		if(isset($_SESSION['userid'])){
    			$iduser = $_SESSION['userid'];
				include('includes/header.inc.php');
			}
			else{
				echo '<div class="blocblue"></div>';
			}
		?>
	    <div id="container">
	    	<?php
		    	include('includes/feedback.inc.php');
	    	?>
	    	<div id="content">
	   
			    <?php
			    	if(isset($_SESSION['userid'])){
					    include('includes/index.inc.php');
				    }
				    else{
					    include('includes/connexion.inc.php');
					    include('includes/infos.inc.php');
				    }
			    ?>
	    	</div>
	    </div>
	    <?php
		    include('includes/modal.inc.php');	
		?>
		<script>
		    $(document).ready(function(){
				$("header #nav li a").removeClass('active');
				$("header #nav li a#home").addClass('active');
				
			});
	    </script>

    </body>
</html>