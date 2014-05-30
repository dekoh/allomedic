<?php 
	session_start();
	include('../includes/config.inc.php');
ini_set('display_errors', 1); 
error_reporting(E_ALL); 

	//Si lutilisateur est connecte, on le deconecte
    if(isset($_SESSION['userid'])) {
        unset($_SESSION['userid'], $_SESSION['type']);
?>
        <div style="padding:50%;"> Déconnexion...</div>

		<script LANGUAGE="JavaScript">
			document.location.href="f/../..";
		</script>
        
<?php
    } else {
        //On verifie si le formulaire a ete envoye
        if(isset($_POST['email'], $_POST['password'])) {
            //On echappe les variables pour pouvoir les mettre dans des requetes SQL
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
        
            //On recupere le mot de passe de lutilisateur
            $req = $bdd->query("SELECT motdepasse,id ,type FROM utilisateurs WHERE email='$email'");
            $req = $req->fetchAll(PDO::FETCH_ASSOC);
            
            //On le compare a celui quil a entre et on verifie si le membre existe
            if(count($req)>0 && $req[0]['motdepasse']==$password && $req[0]['motdepasse']!="" && $req[0]['motdepasse']!=" ") {
            	$pass= $req[0]['motdepasse'];
            	$email= $_POST['email'];
            	//on verifie si la case se souvenir de moi est coché
            	if(isset($_POST['remember'])){
	            	setcookie('authentification', $req[0]['id'] . '-' . sha1($pass), time() * 3600 * 24 * 7, '/', 'localhost', false, true);
            	}
                //On enregistre son pseudo dans la session username et son identifiant dans la session userid 
                $_SESSION['userid'] = $req[0]['id'];
                $_SESSION['type'] = $req[0]['type'];
?>
                <div style="padding:50%;"> Connexion...</div>
				<script LANGUAGE="JavaScript">
					document.location.href="f/../..";
				</script>
<?php
            } else {
                //Sinon, on indique que la combinaison nest pas bonne
                $form = true;
                $message = 'La combinaison que vous avez entr&eacute; n\'est pas bonne.';
            }
        } else {
            
            $message = 'Erreur : Aucune donnée reçue';
        }
    }
    
   if(isset($message)){
   		?>
   			<script LANGUAGE="JavaScript">
					document.location.href="f/../..?msg=<?php echo $message;?>";
				</script>
   		<?php
   }
?>
