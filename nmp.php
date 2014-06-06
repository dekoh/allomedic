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
        <title>Nouveau mot de passe - Allomedic - Prise de rendez-vous chez le médecin</title>

  		<?php
  			$setRoot = true; 
			include('includes/metahead.inc.php');
		?>
    </head>
   
    <body>
    	
    	<?php
    			
				include('includes/header.inc.php');
						?>
	    <div id="container">
	    	<?php
		    	include('includes/feedback.inc.php');
	    	?>
	    	<div id="content">
	    	<?php
	    		echo "nouveau mot de passe ";
	    		echo md5("kitty.wright88@example.com");
	    		
	    		if(isset($_GET['url'])){
		    		$req = $bdd->query("SELECT * FROM utilisateurs");
		    		while($util=$req->fetch()){
			    		if(md5($util['email'])===$_GET['url']){
			    			if($util['motdepasse']==""||$util['motdepasse']==" "){
				    			$nom = $util['nom'];
				    			$prenom = $util['prenom'];
			    			}
			    		}
		    		}
	    		}
	    		if(isset($nom)){
		    		echo "<h2>Bonjour ".$prenom." ".$nom.",</h2> <p>entrez votre nouveau mot de passe:</p>";
	    		}
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