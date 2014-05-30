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
        <title>Agenda - Allomedic - Prise de rendez-vous chez le médecin</title>

  		<?php
			include('includes/metahead.inc.php');
		?>
    </head>
   
    <body>
    	<?php
    		
    			$iduser = $_SESSION['userid'];
				include('includes/header.inc.php');
			
		?>
	    <div id="container">
	    	<div id="content">
		    	<button class="md-trigger" data-modal="modal-1">test modal</button>
		    	<!-- Autocomplete -->
<!--
<h2 class="demoHeaders">Autocomplete</h2>
<div>
	<input id="autocomplete" title="type &quot;a&quot;">
</div>
-->
		<?php
			include('includes/modal.inc.php');
		?>
		    	
	    	</div>
	    </div>
	    <script>
		    $(function() {
			
			var availableTags = [
				"test",
				"ActionScript",
				"AppleScript",
				"Asp",
				"BASIC",
				"C",
				"C++",
				"Clojure",
				"COBOL",
				"ColdFusion",
				"Erlang",
				"Fortran",
				"Groovy",
				"Haskell",
				"Java",
				"JavaScript",
				"Lisp",
				"Perl",
				"PHP",
				"Python",
				"Ruby",
				"Scala",
				"Scheme"
			];
			$( "#autocomplete" ).autocomplete({
				source: availableTags
			});
			});
		</script>
    </body>
</html>