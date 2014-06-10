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
        <title>Contact - Allomedic - Prise de rendez-vous chez le médecin</title>

  		<?php
			include('includes/metahead.inc.php');
		?>
    </head>
   
    <body>
    	<?php
    		if(isset($_POST['email'])){
	    		$email = addslashes($_POST['email']);
	    		$sujet = addslashes($_POST['sujet']);
	    		$nom = addslashes($_POST['nom']);
	    		$msg = array();
	    		$message = addslashes($_POST['message']);
	    		$motifb = "#^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$#";
	    		if(!preg_match($motifb,$email)){
					 $erreur['email'][0] = "L'email n'est pas valide"; 
				 }
				 else{
					 $to = "denis@dekoh.eu";
					 $headers = 'From: \"'.stripslashes($nom).'\"<'.stripslashes($email).'>' . "\r\n" .
					     'MIME-Version: 1.0' . "\r\n" .
					     'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					 mail($to, stripslashes($sujet), stripslashes($message), $headers);
					 $msg[] = "Le message a bien été envoyé";
				 }
    		}
    		if(isset($_SESSION['userid'])){
    			$iduser = $_SESSION['userid'];
				include('includes/header.inc.php');
			}
			else{
				echo "<div id='logo' class='cente'><a href='f/..'>Allomedic</a></div>";
			}
		?>
	    <div id="container">
	    	<?php
		    	include('includes/feedback.inc.php');
	    	?>
	    	<div id="content">
	   
			    <?php
			    	if(isset($_GET['url'])){
					    
				    }
				    else{
					    ?>
					    	<form class="bc" action="contact" method="post" >
						    	<input type="text" name="nom" placeholder="Nom" />
						    	<input type="text" name="email" placeholder="Email" />
						    	<input type="text" name="sujet" placeholder="Sujet" />
						    	<textarea type="text" name="message" placeholder="Message" style="height: 180px;"></textarea>
						    	<button class="expand">Envoyer</button>
					    	</form>
					    <?php
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
				
			});
	    </script>

    </body>
</html>