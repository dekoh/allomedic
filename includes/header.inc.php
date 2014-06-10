<header>
    <div id="header">
	    <div id="logo"><a href="f/..">Allomedic</a></div>
	    <ul id="nav">
	    	<?php
	    	if(count($_SESSION)>0){
		    	if($_SESSION['type']=='med'){
	    	?>
		    <li><a href="f/.." id="home">Accueil</a></li>
		    <li><a href="agenda" id="agenda">Agenda</a></li>
		    <li><a href="patients" id="patients">Patients</a></li>
		    <?php
			    }
			    elseif($_SESSION['type']=='pat'){
				    ?>
		    <li class="navpat"><a href="f/.." id="home">Accueil</a></li>
		    <li class="navpat"><a href="rendez-vous" id="agenda">Rendez-vous</a></li>
		    <li class="navpat"><a href="medecins" id="patients">Médecins</a></li>
				    <?php
			    }
		    ?>
	    </ul>
	    <div id="profil">
	    	<?php
		    	$req = $bdd->query("SELECT * FROM utilisateurs WHERE id='$iduser'");
		    	$req = $req->fetchAll(PDO::FETCH_ASSOC);
	    	
	    	if (file_exists("images/avatar/".$iduser.".jpg")) {
	    		echo '<div id="avatar" style="background: url(images/avatar/'.$iduser.'.jpg); background-size: cover;">avatar</div>';
	    	}
	    	else{
		    	if($req[0]['sexe']=="f"){
			    	echo '<div id="avatar" style="background: url(images/profilwomen.jpg); background-size: cover;">avatar</div>';
		    	}
		    	else{
			    	echo '<div id="avatar" style="background: url(images/profilmen.jpg); background-size: cover;">avatar</div>';
		    	}
	    	}
	    	
		    	if($req[0]['type']=='med'){
			    	echo "Dr. ".$req[0]['nom'];
		    	}
		    	else{
			    	echo $req[0]['prenom']. " " .$req[0]['nom'];
		    	}
	    	?>
	    </div>
	    <ul id="navpro">
	    	<li><a href="profil" id="profl">Profil</a></li>
	    	<li><a href="contact" id="assist">Assistance</a></li>
	    	<li><a href="f/..?deco=d" id="deco">Déconnexion</a></li>
	    </ul>
	    <?php
		    }
	    ?>
    </div>
</header>