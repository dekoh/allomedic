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
        <title>Admin - Allomedic - Prise de rendez-vous chez le médecin</title>

  		<?php
			include('includes/metahead.inc.php');
		?>
    </head>
   
    <body>
    	
    	<?php
    		if(isset($_POST['nomjour'])){
	    		$nomjour = $_POST['nomjour'];
	    		$datejour = $_POST['date'];
	    		$datejour= str_replace('/', '-', $datejour);
	    		$datejour = strtotime($datejour);
	    		$iso = "fr";
	    		$req = $bdd->prepare('INSERT INTO ferie (nom,date,isopays) VALUES(?, ?, ?)');
	    		$req->execute(array($nomjour,$datejour,$iso));

    		}
    		if(isset($_POST['nomedic'])){
	    		
    		}
    		if(isset($_POST['login'])){
    			if($_POST['mdp']=="dedesh14" && $_POST['login']=="dekoh"){
	    			$_SESSION['admin']=true;
    			}
    		}
    		if(isset($_POST['decoadmin'])){
	    		if($_POST['decoadmin']=="true"){
		    		unset($_SESSION['admin']);
	    		}
    		}
    	if(isset($_SESSION['admin'])){
			if($_SESSION['admin']==true){
		?>
	    <div id="container">
	    	<div id="content">
	    		<form action="dekadmin" method="post">
	    		<input type="hidden" name="decoadmin" value="true" />
	    		<button>Déconexion</button>
	    		</form>
		    	<div class="col pr-5">
		    	<form action="dekadmin" method="post">
					<h1>Jour férié</h1>
					<input type="text" name="nomjour" placeholder="Nom du jour" />
					<input type="text" name="date" placeholder="Date" />
					<button>enregistrer</button>
				</form>
		    	</div>
		    	<div class="col pr-5">
		    	<form action="dekadmin" method="post">
					<h1>Médecin</h1>
					<input type="text" name="nomedic" placeholder="Nom du Médecin" />
					<input type="text" name="prenom" placeholder="Prénom du Médecin" />
					<input type="text" name="email" placeholder="email du Médecin" />
					<button>enregistrer</button>
				</form>
		    	</div>
		    	
	    	</div>
	    </div>
	   
	    
    </body>
</html>
<?php
			}
			
		}
		else{
			?>
			<div id="formcon">
			<form action="dekadmin" class="con" method="post">
				<h1>Connexion</h1>
		<p>
	      <!-- <label for="login">Pseudo:</label> -->
	      <input type="text" name="login" id="email" placeholder="pseudo">
	    </p>
	
	    <p>
	      <!-- <label for="password">Mot de passe:</label> -->
	      <input type="password" name="mdp" id="password" placeholder="Mot de passe">
	    </p>
	
	    <p class="login-submit">
	      <button type="submit" class="login-button expand">Connexion</button>
	    </p>

			</form>
			</div>
			<?php
		}
		
	    
		?>