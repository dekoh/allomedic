<div class="feedcontainer">
<?php
	if(isset($_GET['msg'])){
		echo "<div class='feedback alert'>".$_GET['msg']."<span class='closefeed'>fermer</span></div>";
		echo "<div class='feedback orange'>".$_GET['msg']."<span class='closefeed'>fermer</span></div>";
		echo "<div class='feedback good'>".$_GET['msg']."<span class='closefeed'>fermer</span></div>";
	}
	
?>
</div>