<?php 

	//Si lutilisateur est connecte, on le deconecte
    if(isset($_SESSION['userid'])) {
    	if(isset($_GET['deco'])){
       		 unset($_SESSION['userid'], $_SESSION['type']);
       		 ?><SCRIPT LANGUAGE="JavaScript">
document.location.href="f/..";
</SCRIPT><?php
        }

    } else {
        //On verifie si le formulaire a ete envoye
        if(isset($_POST['email'], $_POST['password'])) {
        	$alert = array();
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
	            	setcookie('authentification', $req[0]['id'] . '-' . sha1($email.$pass), time() * 3600 * 24 * 7, '/', 'localhost', false, true);
            	}
                //On enregistre son pseudo dans la session username et son identifiant dans la session userid 
                $_SESSION['userid'] = $req[0]['id'];
                $_SESSION['type'] = $req[0]['type'];

            } else {
                //Sinon, on indique que la combinaison nest pas bonne
                $form = true;
                $alert[] = 'La combinaison que vous avez entr&eacute; n\'est pas bonne.';
            }
        } 
    }
?>