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
    		if(isset($_SESSION['userid'])){
    			$iduser = $_SESSION['userid'];
    		}
				include('includes/header.inc.php');
						?>
	    <div id="container">
	    	<?php
		    	include('includes/feedback.inc.php');
	    	?>
	    	<div id="content">
	    	<?php
	    		if(isset($_POST['nmp'])){
		    		$mdp = $_POST['nmp'];
		    		$emailpat = $_POST['email'];
		    		$upd = $bdd->query("UPDATE utilisateurs SET motdepasse='$mdp' WHERE email='$emailpat'");
		    		$mdpok = true;
	    		}
	    		elseif(isset($_POST['lostmdp'])){
	    			$mm = addslashes($_POST['lostmdp']);
	    			$mdpp = $bdd->query("SELECT motdepasse FROM utilisateurs WHERE email='$mm'");
	    			$motdepasse = $mdpp->fetchAll();
	    			if(count($motdepasse)>0){
		    			$to = $_POST['lostmdp'];
					    $subject = 'Vos identifiants';
					    $message = '<p>Bonjour,</p>
					    <p>Voici vos identifiants pour vous connecter à allomedic:</p> 
					    <p>email: '.$to.' </p>
					    <p>Mot de passe : '.$motdepasse[0]['motdepasse'].'</p>
					    <p> <a href="dekoh.eu/tfe/juin">Se connecter à Allomedic</a> </p>';
					    $headers = 'From: \"Allomedic\"<noreply@allomedic.com>' . "\r\n" .
					     'MIME-Version: 1.0' . "\r\n" .
					     'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					     mail($to, $subject, $message, $headers);
	    			}
		    		else{
			    		echo "<p>Il n'y a aucun utilisateurs avec cette adresse email.</p><a href='nmp/lostmdp'>Réessayer</a>";
			    		$mdpn = true;
		    		}
	    		}
	    		else{
		    		if(isset($_GET['url'])){
		    			if($_GET['url']=='lostmdp'){
			    			echo "<h3> entrez votre adresse email:</h3>
		    		<form action='nmp' method='post'>
		    			<input type='text' name='lostmdp' placeholder='Votre adresse email'/>
		    			<button class='md-submit'>Valider</button>
		    		</form>";
		    			$mdpn = true;
		    			}
		    			else{
				    		$req = $bdd->query("SELECT * FROM utilisateurs");
				    		while($util=$req->fetch()){
					    		if(md5("smp".$util['email'])===$_GET['url']){
					    			if($util['motdepasse']==""||$util['motdepasse']==" "){
						    			$nom = $util['nom'];
						    			$prenom = $util['prenom'];
						    			$email = $util['email'];
					    			}
					    			else{
						    			$mdpok = true;
					    			}
					    		}
				    		}	
		    			}
			    		
		    		}
	    		}
	    		if(isset($nom)){
	    			if(isset($_SESSION['userid'])){
		    			echo "Vous devez vous déconnecter pour atteindre cette page.";
	    			}
	    			else{
		    			echo "<h2>Bonjour ".$prenom." ".$nom.",</h2><h3> entrez votre nouveau mot de passe:</h3>
		    		<form action='nmp' method='post'>
		    			<input type='text' name='nmp' placeholder='Mot de passe (Doit contenir entre 6 et 22 caractères)'/>
		    			<input type='hidden' name='email' value='".$email."'/>
		    			<button class='md-submit'>Valider</button>
		    		</form>";
	    			}
		    		
	    		}
	    		else{
		    		if(isset($mdpok)){
			    		echo "<h2>Le mot de passe a bien été initialisé</h2><p>Vous pouvez désormais vous connecter à allomedic en  <a href='f/..'>cliquant ici</a></p>";
		    		}
		    		else{
		    			if(isset($mdpen)){
			    			echo "<h2>Le mot de passe a bien été envoyé sur l'adresse email $mdpen</h2><p>Vous pouvez retourner a l'accueil de allomedic en  <a href='f/..'>cliquant ici</a></p>";
		    			}
		    			else{
		    				if(!isset($mdpn)){
			    				echo '<SCRIPT LANGUAGE="JavaScript">
document.location.href="f/..";
</SCRIPT>';
		    				}
			    			
		    			}
			    		
		    		}
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