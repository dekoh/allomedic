<?php
	include('includes/config.inc.php');
	if(isset($_COOKIE['authentification']) && !isset($_SESSION['userid'])){
		$user = $_COOKIE['authentification'];
		$user = explode('-', $user);
		$id = $user[0];
		$req = $bdd->row("SELECT * FROM user WHERE id=$id");
		$key= sha1($req->username . $req->password);
		if($key == $user[1]){
			$_SESSION['username'] = $req->username;
            $_SESSION['userid'] = $req->id;
            $_SESSION['type'] = $req->type;
            setcookie('authentification', $req[0]['id'] . '-' . sha1($user.$pass), time() * 3600 * 24 * 7, '/', 'localhost', false, true);

		}
		else{
			setcookie('authentification', '', time() - 3600, '/', 'localhost', false, true);
		}
	}
?>