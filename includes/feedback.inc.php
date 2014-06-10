<div class="feedcontainer">
<?php
	if(isset($_GET['msg'])){
		if($_GET['msg']=="patsup"){
			echo "<div class='feedback good'>Le liens avec ce patient a bien été supprimé<span class='closefeed'>fermer</span></div>";
		}
		if($_GET['msg']=="done"){
			echo "<div class='feedback good'>Le rendez-vous a bien été ajouté<span class='closefeed'>fermer</span></div>";
		}
		if(preg_match("/^donemp/", $_GET['msg'])){
			$np = explode(" ", $_GET['msg']);
			$nom = $np[1];
			if(isset($np[2])){
				$prenom = $np[2];
			}
			echo "<div class='feedback good'>Le rendez-vous a bien été ajouté<span class='closefeed'>fermer</span></div>";
			echo "<div class='feedback orange'>Le patient ne fait pas partie de vos patients. <span class='md-trigger lien' data-modal='addpat' data-nom='$nom'";
			if(isset($np[2])){
				echo " data-prenom='$prenom'";
			}
			echo ">Voulez-vous ajouter le patient?</span><span class='closefeed'>fermer</span></div>";
		}
	}
	if(isset($msg)){
		if(count($msg)>0){
			foreach($msg as $message){
				echo "<div class='feedback good'>".$message."<span class='closefeed'>fermer</span></div>";
			}
		}
	}
	if(isset($alert)){
		if(count($alert)>0){
			foreach($alert as $alerte){
				echo "<div class='feedback alert'>".$alerte."<span class='closefeed'>fermer</span></div>";
			}
		}
	}
	if(isset($avertissement)){
		if(count($avertissement)>0){
			foreach($avertissement as $avert){
				echo "<div class='feedback orange'>".$avert."<span class='closefeed'>fermer</span></div>";
			}
		}
	}
?>
</div>