$(document).ready(function(){
  	
	$("#profil").click(function(){
		$("#navpro").slideToggle();
	});
	
	/*
$(".sectrdv").click(function(){
		
		var idrdv = $(this).data("rdvid");
		
		
		$("#rdvinfo"+idrdv).fadeToggle();
				
	});
*/
	$(".plage").click(function(){
		if($(this).children(".modifmenu").hasClass("opened")){
			$(this).children(".modifmenu").css("bottom","-50px");
			$(this).children(".modifmenu").removeClass("opened");
		}
		else{
			$(".modifmenu").removeClass("opened");
			$(".modifmenu").css("bottom","-50px");
			$(this).children(".modifmenu").css("bottom","0");
			$(this).children(".modifmenu").addClass("opened");
		}
		
				
	});
	$(".closefeed").click(function(){
		$(this).parent(".feedback").fadeOut();
	});
	$(".feedback").delay(3000).fadeOut("slow");
	$(".md-trigger").click(function(){
		var datadate = $(this).data("date");
		var datahdeb = $(this).data("hdeb");
		var datahfin = $(this).data("hfin");
		var datajour = $(this).data("jour");
		var dataheure = $(this).data("heure");
		var datadateb = $(this).data("dateb");
		var dataheureb = $(this).data("heureb");
		var datanommed = $(this).data("nommed");
		var dataidmed = $(this).data("idmed");
		var dataid = $(this).data("id");
		var dataduree = $(this).data("duree");
		var datatype = $(this).data("type");
		var datamin = $(this).data("min");
		var dataemail = $(this).data("email");
		var datanom = $(this).data("nom");
		var dataprenom = $(this).data("prenom");
		var datatel = $(this).data("tel");
		var dataadr = $(this).data("adr");
		var datasexe = $(this).data("sexe");
		var datadn = $(this).data("dn");
		$("#addrdv #inputdate").val(datadate);
		$("#addrdv #inputheure").val(dataheure);
		$("#addrdvpat #jourdurdv").html(datadateb);
		$("#addrdvpat #heuredurdv").html(dataheureb);
		$("#addrdvpat #nomdocteur").html(datanommed);
		$("#addrdvpat #inputduree").val(dataduree);
		$("#addrdvpat #inputidmed").val(dataidmed);
		$("#addrdvpat #inputdate").val(datadate);
		$("#modifemail #inputemail").val(dataemail);
		$("#modifnom #inputnom").val(datanom);
		$("#modifnom #inputprenom").val(dataprenom);
		$("#modiftel #inputtel").val(datatel);
		$("#modifadr #champ-adresse").html(dataadr);
		$("#modifsexe #selectsexe").val(datasexe).attr("selected", "selected");
		$("#modifdatenaissance #inputdatenaissance").val(datadn);
		$("#addrdv #selecttype").val(datatype).attr("selected", "selected");
		$("#modrdv #selecttype").val(datatype).attr("selected", "selected");
		$("#addrdv #outinputduree").val(datamin);
		$("#modpla #selectjour").val(datajour).attr("selected", "selected");
		$("#modpla #inputduree input").val(dataduree);
		$("#modpla #utinputheure input").val(datahdeb);
		$("#modpla #tinputheure input").val(datahfin);
		$("#modpla #inputid").val(dataid);
		$("#modpla #selecttype").val(datatype).attr("selected", "selected");
		$("#suppla #inputid").val(dataid);
	});
});