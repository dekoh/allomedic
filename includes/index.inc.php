<?php
	if(isset($_SESSION['userid'])){
		if($_SESSION['type']=="pat"){
		?>
		 <div class="bloc big"><a href="rendez-vous"><span class="bl1"></span><h2>Mes rendez-vous</h2></a></div>
		 <div class="bloc big"><a href="nouveau-rendez-vous"><span class="bl5 padplus"></span><h2>Nouveau rendez-vous</h2></a></div>
		 <div class="bloc big"><a href="medecins"><span class="bl4"></span><h2>Mes Médecins</h2></a></div>
		 <div class="bloc big"><a href="profil"><span class="bl4"></span><h2>Mon profil</h2></a></div>
		 <?php
			}
		elseif($_SESSION['type']=="med"){
?>
<div class="bloc big"><a href="agenda"><span class="bl1">
<?php 
	$id=$_SESSION['userid'];
	$datetmstp = date('d/m/Y');
	$datetmstp= str_replace('/', '-',$datetmstp);
	$datetmstp = strtotime($datetmstp);
	$datetmstpfin = $datetmstp + 86400;
	$idp = $bdd->query("select * from rdv where idmed=$id and date between $datetmstp and $datetmstpfin");
	$nbrdv = $idp->rowCount();
	echo $nbrdv;
	
?>
</span><h2>
<?php
	$day = date("D");
	$nday = date("d");
	$month = date("m");
	$year = date("Y");
	if($day=="Mon"){
		$jour="Lundi";
	} 
	if($day=="Tue"){
		$jour="Mardi";
	} 
	if($day=="Wed"){
		$jour="Mercredi";
	} 
	if($day=="Thu"){
		$jour="Jeudi";
	} 
	if($day=="Fri"){
		$jour="Vendredi";
	} 
	if($day=="Sat"){
		$jour="Samedi";
	} 
	if($day=="Sun"){
		$jour="Dimanche";
	} 
	if($month==1){
		$mois="Janvier";
	} 
	if($month==2){
		$mois="Février";
	} 
	if($month==3){
		$mois="Mars";
	} 
	if($month==4){
		$mois="Avril";
	} 
	if($month==5){
		$mois="Mai";
	} 
	if($month==6){
		$mois="Juin";
	} 
	if($month==7){
		$mois="Juillet";
	} 
	if($month==8){
		$mois="Aout";
	} 
	if($month==9){
		$mois="Septembre";
	} 
	if($month==10){
		$mois="Octobre";
	} 
	if($month==11){
		$mois="Novembre";
	} 
	if($month==12){
		$mois="Décembre";
	}
	echo $jour." ".$nday." ".$mois." ".$year;
?>
</h2></a></div>
<?php
	$ann = $bdd->query("SELECT * FROM rdv WHERE idmed=$id and annulation=1 and lu=0");
	$nbnann = $ann->rowCount(); 
?>
<div class="bloc"><a href="annulations"><span class="bl6">-<?php echo $nbnann;?></span><h2>Annulations</h2></a></div>
<div class="bloc"><button class="md-trigger" data-modal="addrdv"><span class="bl5"  ></span><h2>Rendez-vous</h2></button></div>
<div class="bloc"><button  class="md-trigger" data-modal="addcon"><span class="bl2"></span><h2>Congé</h2></button></div>
<div class="bloc"><button  class="md-trigger" data-modal="addpat"><span class="bl3"></span><h2>Patient</h2></button></div>
<div class="bloc big"><a href="patients"><span class="bl4">
<?php 
	$id=$_SESSION['userid'];
	$idp = $bdd->query("select * from liens where idmed=$id");
	$nbpatients = $idp->rowCount();
	echo $nbpatients;
?></span><h2>Patients</h2></a></div>


<?php
	}
	     }
		   else{
			   ?><SCRIPT LANGUAGE="JavaScript">
document.location.href="f/..";
</SCRIPT><?php
		   }
		?>
