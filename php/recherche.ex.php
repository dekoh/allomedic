<?php 
	include("php/lib.php");
	if(count($_GET)>0){
		if(isset($_GET['r'])){
			echo $GET['r'];
		}
	}
	?>