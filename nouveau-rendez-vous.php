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
			include('includes/metahead.inc.php');
		?>
    </head>
   
    <body>
    	
    	<?php
    			if(isset($_SESSION['userid'])){
	    			
    			
    			$iduser = $_SESSION['userid'];
				include('includes/header.inc.php');
		?>
	    <div id="container">
	    	<div id="content">
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