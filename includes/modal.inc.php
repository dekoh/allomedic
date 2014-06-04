				<!-- Fenetre de test -->
				<div class="md-modal md-effect-1" id="modal-1">
					<div class="md-content">
						<h3>Modal Dialog</h3>
						<div>
							<p>This is a modal window. You can do the following things with it:</p>
							<!-- Autocomplete -->
<h2 class="demoHeaders">Autocomplete</h2>
<div>
	<input id="autocomplete" title="type &quot;a&quot;">
</div>
							<ul>
								<li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>
								<li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>
								<li><strong>Close:</strong> click on the button below to close the modal.</li>
							</ul>
							<button class="md-close">Close me!</button>
						</div>
					</div>
				</div>
				<?php
					if(isset($_GET['url'])){
						$idpro = $_GET['url'];
					}
					
				?>
				<!-- Fenetre de modification d'email -->
				<div class="md-modal md-effect-1" id="modifemail">
					<div class="md-content">
						<h3>Modification de l'email</h3>
						<div>
							<form action="profil<?php if(isset($idpro)){if($idpro!=""||$idpro!=" "){echo "/".$idpro;}}?>" method="post">
								<div id="champemail" class="col pr-10">
									<input type="text" id="inputemail" name="email" placeholder="eMail" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['email'])){echo "value='".$_POST['email']."'";}} }?>/>
									<?php
										if(isset($erreur['email'])){
											echo '<script>$("#champemail").addClass("champ-erreur");</script>';
										}
										if(isset($erreur['email'][0])){
											echo '<small class="error">l\'email n\'est pas valide</small>';
										}
										if(isset($erreur['email'][1])){
											echo '<small class="error">l\'email n\'est pas rempli</small>';
										}
									?>
								</div>
								<input type="hidden" name="posttype" value="modifemail"/>
								<input type="hidden" name="idpat" value="<?php echo $idpro; ?>"/>
								<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>	
						</div>
					</div>
				</div>
				<!-- Fenetre de modification du nom et du prénom -->
				<div class="md-modal md-effect-1" id="modifnom">
					<div class="md-content">
						<h3>Modification du nom</h3>
						<div>
							<form action="profil<?php if(isset($idpro)){if($idpro!=""||$idpro!=" "){echo "/".$idpro;}} ?>" method="post">
								<div id="champprenom" class="col pr-5">
									<input type="text" id="inputprenom" name="prenom" placeholder="Prénom*"<?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['prenom'])){echo "value='".$_POST['prenom']."'";}} }?>/>
									<?php
										if(isset($erreur['prenom'])){
											echo '<script>$("#champprenom").addClass("champ-erreur");</script>';
										}
										if(isset($erreur['prenom'][0])){
											echo '<small class="error">le prénom n\'est pas valide</small>';
										}
										if(isset($erreur['prenom'][1])){
											echo '<small class="error">le prénom n\'est pas rempli</small>';
										}
									?>
								</div>
								<div id="champnom" class="col pr-5">
									<input type="text" id="inputnom" name="nom" placeholder="Nom*" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['nom'])){echo "value='".$_POST['nom']."'";}} }?>/>
									<?php
										if(isset($erreur['nom'])){
											echo '<script>$("#champnom").addClass("champ-erreur");</script>';
										}
										if(isset($erreur['nom'][0])){
											echo '<small class="error">le nom n\'est pas valide</small>';
										}
										if(isset($erreur['nom'][1])){
											echo '<small class="error">le nom n\'est pas rempli</small>';
										}
									?>
								</div>							
								<input type="hidden" name="posttype" value="modifnom"/>
								<input type="hidden" name="idpat" value="<?php echo $idpro; ?>"/>
								<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>	
						</div>
					</div>
				</div>
				<!-- Fenetre de modification du numéro de téléphone -->
				<div class="md-modal md-effect-1" id="modiftel">
					<div class="md-content">
						<h3>Modification du numéro de téléphone</h3>
						<div>
							<form action="profil<?php if(isset($idpro)){if($idpro!=""||$idpro!=" "){echo "/".$idpro;}} ?>" method="post">
								<div id="champtel" class="col pr-10">
									<input type="text" id="inputtel" name="telephone" placeholder="Téléphone" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['telephone'])){echo "value='".$_POST['telephone']."'";}} }?>/>
									<?php
										if(isset($erreur['tel'])){
											echo '<script>$("#champtel").addClass("champ-erreur");</script>';
											echo '<small class="error">le numéro de téléphone n\'est pas valide</small>';
										}
									?>
								</div>
								<input type="hidden" name="posttype" value="modiftel"/>
								<input type="hidden" name="idpat" value="<?php echo $idpro; ?>"/>
								<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>	
						</div>
					</div>
				</div>
				<!-- Fenetre de modification de l'adresse -->
				<div class="md-modal md-effect-1" id="modifadr">
					<div class="md-content">
						<h3>Modification de l'adresse</h3>
						<div>
							<form action="profil<?php if(isset($idpro)){if($idpro!=""||$idpro!=" "){echo "/".$idpro;}} ?>" method="post">
								<div id="champadresse" class="col pr-10">
									<textarea id="champ-adresse" name="adresse" placeholder="Adresse"><?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['adresse'])){echo $_POST['adresse'];}} }?></textarea>
									<?php
										if(isset($erreur['adresse'])){
											echo '<script>$("#champadresse").addClass("champ-erreur");</script>';
											echo '<small class="error">l\'adresse n\'est pas valide</small>';
										}
									?>
									
								</div>
								<input type="hidden" name="posttype" value="modifadr"/>
								<input type="hidden" name="idpat" value="<?php echo $idpro; ?>"/>
								<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>	
						</div>
					</div>
				</div>
				<!-- Fenetre de modification du sexe -->
				<div class="md-modal md-effect-1" id="modifsexe">
					<div class="md-content">
						<h3>Modification du sexe</h3>
						<div>
							<form action="profil<?php if(isset($idpro)){if($idpro!=""||$idpro!=" "){echo "/".$idpro;}} ?>" method="post">
								<div class="col bot pr-10">
								<select id="selectsexe" name="sexe">
									
									<option value="n" class="grise">Sexe</option>
									<option value="h">Homme</option>
									<option value="f">Femme</option>
									
								</select>				
								</div>				
								<input type="hidden" name="posttype" value="modifsexe"/>
								<input type="hidden" name="idpat" value="<?php echo $idpro; ?>"/>
								<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>	
						</div>
					</div>
				</div>
				<!-- Fenetre de modification de la date de naissance -->
				<div class="md-modal md-effect-1" id="modifdatenaissance">
					<div class="md-content">
						<h3>Modification de la date de naissance</h3>
						<div>
							<form action="profil<?php if(isset($idpro)){if($idpro!=""||$idpro!=" "){echo "/".$idpro;}} ?>" method="post">
								<div id="champdate" class="col pr-10">
									<input type="text" id="inputdatenaissance" name="date-naissance" placeholder="Date de naissance (jj/mm/aaaa)" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['date-naissance'])){echo "value='".$_POST['date-naissance']."'";}} }?>/>
									<?php
										if(isset($erreur['datenaissance'])){
											echo '<script>$("#champdate").addClass("champ-erreur");</script>';
											echo '<small class="error">La date de naissance n\'est pas valide. Veuillez vérifier à respecter le format: jj/mm/aaaa</small>';
										}
									?>
									
								</div>
								<input type="hidden" name="posttype" value="modifdate"/>
								<input type="hidden" name="idpat" value="<?php echo $idpro; ?>"/>
								<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>	
						</div>
					</div>
				</div>
				<!-- Fenetre de modification de la photo -->
				<div class="md-modal md-effect-1" id="modifphoto">
					<div class="md-content">
						<h3>Modification de la photo</h3>
						<div>
							<form action="profil<?php if(isset($idpro)){if($idpro!=""||$idpro!=" "){echo "/".$idpro;}} ?>" method="post" enctype="multipart/form-data">
								<div id="champphoto" class="col pr-10">
								<input type="file" name="photo" />
								</div>
								<input type="hidden" name="posttype" value="modifavatar"/>
								<input type="hidden" name="idpat" value="<?php echo $idpro; ?>"/>
								<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>	
						</div>
					</div>
				</div>
				<!-- Fenetre de suppresion de compte -->
				<div class="md-modal md-effect-1" id="suppat">
					<div class="md-content">
						<h3>Suppression de pattient</h3>
						<div>
							<form action="profil" method="post">
								<p class="col bot">Voulez-vous vraiment supprimer ce patient?</p>
								<input type="hidden" name="posttype" value="suppat"/>
								<input type="hidden" name="idpat" value="<?php echo $idpro; ?>"/>
								<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
								<button class="md-submit">Oui</button>
							</form>					
								<button class="md-close">Non</button>	
						</div>
					</div>
				</div>
				<!-- Fenetre d'annulation de rendez-vous -->
				<div class="md-modal md-effect-1" id="suprdv">
					<div class="md-content">
						<h3>Annulation du rendez-vous</h3>
						<div>
							<form action="rdv/<?php echo $idrdv; ?>" method="post">
								<p class="col bot">Voulez-vous vraiment annuler ce rendez-vous?</p>
								<input type="text" name="raison" placeholder="Raison"/>
								<input type="hidden" name="posttype" value="suprdv"/>
								<input type="hidden" name="idrdv" value="<?php echo $idrdv; ?>"/>
								<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
								<button class="md-submit">Oui</button>
							</form>					
								<button class="md-close">Non</button>	
						</div>
					</div>
				</div>
				<!-- Fenetre d'ajout de patient -->
		    	<div class="md-modal md-effect-1" id="addpat">
					<div class="md-content">
						<h3>Ajout d'un patient</h3>
						<div>
							<form action="patients" method="post">
								<div id="champprenom" class="col pr-5">
									<input type="text" name="prenom" placeholder="Prénom*"<?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['prenom'])){echo "value='".$_POST['prenom']."'";}} }?>/>
									<?php
										if(isset($erreur['prenom'])){
											echo '<script>$("#champprenom").addClass("champ-erreur");</script>';
										}
										if(isset($erreur['prenom'][0])){
											echo '<small class="error">le prénom n\'est pas valide</small>';
										}
										if(isset($erreur['prenom'][1])){
											echo '<small class="error">le prénom n\'est pas rempli</small>';
										}
									?>
								</div>
								<div id="champnom" class="col pr-5">
									<input type="text" name="nom" placeholder="Nom*" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['nom'])){echo "value='".$_POST['nom']."'";}} }?>/>
									<?php
										if(isset($erreur['nom'])){
											echo '<script>$("#champnom").addClass("champ-erreur");</script>';
										}
										if(isset($erreur['nom'][0])){
											echo '<small class="error">le nom n\'est pas valide</small>';
										}
										if(isset($erreur['nom'][1])){
											echo '<small class="error">le nom n\'est pas rempli</small>';
										}
									?>
								</div>
								<div id="champemail" class="col pr-7">
									<input type="text" name="email" placeholder="eMail*" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['email'])){echo "value='".$_POST['email']."'";}} }?>/>
									<?php
										if(isset($erreur['email'])){
											echo '<script>$("#champemail").addClass("champ-erreur");</script>';
										}
										if(isset($erreur['email'][0])){
											echo '<small class="error">l\'email n\'est pas valide</small>';
										}
										if(isset($erreur['email'][1])){
											echo '<small class="error">l\'email n\'est pas rempli</small>';
										}if(isset($erreur['email'][2])){
											echo '<small class="error">Il existe déjà un patient avec cette adresse email</small>';
										}
									?>
								</div>
								<div id="champtel" class="col pr-3">
									<input type="text" name="telephone" placeholder="Téléphone" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['telephone'])){echo "value='".$_POST['telephone']."'";}} }?>/>
									<?php
										if(isset($erreur['tel'])){
											echo '<script>$("#champtel").addClass("champ-erreur");</script>';
											echo '<small class="error">le numéro de téléphone n\'est pas valide</small>';
										}
									?>
								</div>
								<div id="champdate" class="col pr-7">
									<input type="text" name="date-naissance" placeholder="Date de naissance (jj/mm/aaaa)" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['date-naissance'])){echo "value='".$_POST['date-naissance']."'";}} }?>/>
									<?php
										if(isset($erreur['datenaissance'])){
											echo '<script>$("#champdate").addClass("champ-erreur");</script>';
											echo '<small class="error">La date de naissance n\'est pas valide. Veuillez vérifier à respecter le format: jj/mm/aaaa</small>';
										}
									?>
									
								</div>
								<?php
									if(isset($erreur)){if(count($erreur)>0){
										if(isset($_POST['sexe'])){
											$sexe = $_POST['sexe'];
											echo '<script>$(document).ready(function(){$("#selectsexe").val("'.$sexe.'").attr("selected", "selected");});</script>';
										}
									}
									}
								?>
								<select id="selectsexe" name="sexe" class="col pr-3">
									
									<option value="n" class="grise">Sexe</option>
									<option value="h">Homme</option>
									<option value="f">Femme</option>
									
								</select>
								<div id="champadresse" class="col">
									<textarea id="champ-adresse" name="adresse" placeholder="Adresse"><?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['adresse'])){echo $_POST['adresse'];}} }?></textarea>
									<?php
										if(isset($erreur['adresse'])){
											echo '<script>$("#champadresse").addClass("champ-erreur");</script>';
											echo '<small class="error">l\'adresse n\'est pas valide</small>';
										}
									?>
									
								</div>
								<input type="hidden" name="type" value="pat"/>
								<input type="hidden" name="posttype" value="newpat"/>
								<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>		
						</div>
					</div>
				</div>
				<!-- Fenetre d'ajout de rendez-vous -->
		    	<div class="md-modal md-effect-1" id="addrdv">
					<div class="md-content">
						<h3>Ajout d'un rendez-vous</h3>
						<div>
							<form action="agenda" method="post">
								<div><div class="col pr-5"> Le <div class="inblo"  id="outinputdate"><input id="inputdate" type="text"  name="date" placeholder="jj/mm/aaaa" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['date'])){echo "value='".$_POST['date']."'";}} }?> ><?php
										if(isset($erreur['date'][0])){
											echo '<script>$("#outinputdate").addClass("champ-erreur");</script>';
											echo '<small class="error">La date n\'est pas valide. Veuillez vérifier à respecter le format: jj/mm/aaaa</small>';
										}
										if(isset($erreur['date'][1])){
											echo '<script>$("#outinputdate").addClass("champ-erreur");</script>';
											echo '<small class="error">Le champ date est vide. </small>';
										}
									?></div></div><div class="col pr-5"> à <div class="inblo" id="outinputheure"><input type="text" id="inputheure" name="heure" placeholder="hh:mm"  <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['heure'])){echo "value='".$_POST['heure']."'";}} }?>/><?php
										if(isset($erreur['heure'][0])){
											echo '<script>$("#outinputheure").addClass("champ-erreur");</script>';
											echo '<small class="error">L\'heure n\'est pas valide. Veuillez vérifier à respecter le format: hh:mm</small>';
										}
										if(isset($erreur['heure'][1])){
											echo '<script>$("#outinputheure").addClass("champ-erreur");</script>';
											echo '<small class="error">Le champ heure est vide. </small>';
										}
									?></div></div></div>
								<select id="selecttype" name="type" class="col pr-5">
									
									<option value="rdv" class="grise">Normale</option>
									<option value="domicile">Domicile</option>
									<option value="autre">Autre</option>
									
								</select>
								<div id="inputduree" class="col pr-5" ><input id="outinputduree" type="text" name="duree" placeholder="Durée en minutes" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['duree'])){echo "value='".$_POST['duree']."'";}} }?>/><?php
										if(isset($erreur['duree'])){
											echo '<script>$("#inputduree").addClass("champ-erreur");</script>';
											}
										if(isset($erreur['duree'][0])){
											echo '<small class="error">La durée n\'est pas valide. Veuillez vérifier que vous entrez bien un nombre en minutes.</small>';
										}
										if(isset($erreur['duree'][1])){
											echo '<small class="error">Le champ durée est vide. </small>';
										}
										if(isset($erreur['duree'][2])){
											echo '<small class="error">La durée ne peut pas être négative. </small>';
										}
										if(isset($erreur['duree'][3])){
											echo '<small class="error">La durée est anormalement élevée... </small>';
										}
									?></div>
								<input type="text" id="idinputpatient"  name="patient" placeholder="Nom et prénom du patient"/>
								<input type="text"  name="motif" placeholder="Motif"/>
								<input type="hidden" id="inputidmed" name="idmed" value="<?php if($_SESSION['type']=="med"){echo $_SESSION['userid'];} ?>"/>
								<input type="hidden" name="posttype" value="newrdv"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>
						</div>
					</div>
				</div>
				<!-- Patient -->
				<div class="md-modal md-effect-1" id="addrdvpat">
					<div class="md-content">
						<h3>Ajout d'un rendez-vous</h3>
						<div>
							<p>Rendez-vous avec le docteur <span id="nomdocteur"></span></p>
							<p>Le <span id="jourdurdv"></span> à <span id="heuredurdv"></span></p>
							<form action="rendez-vous" method="post">
								<input type="text"  name="motif" placeholder="Motif"/>
								<input type="hidden" id="inputidmed" name="idmed" value=""/>
								<input type="hidden" id="inputdate" name="date" value=""/>
								<input type="hidden" id="inputduree" name="duree" value=""/>
								<input type="hidden" name="idpat" value="<?php echo $_SESSION['userid']; ?>"/>
								<input type="hidden" name="posttype" value="newrdvpat"/>
								<button class="md-submit">Valider</button>
							</form>					
								<button class="md-close">Annuler</button>
						</div>
					</div>
				</div>

				<!-- Fenetre de modification de rendez-vous -->
				<div class="md-modal md-effect-1" id="modrdv">
					<div class="md-content">
						<h3>Modification du rendez-vous</h3>
						<div>
							<form action="rdv/<?php echo $idrdv ;?>" method="post">
								<div><div class="col pr-5"> Le <div class="inblo"  id="outinputdate"><input id="inputdate" type="text"  name="date" placeholder="jj/mm/aaaa"  <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['date'])){echo "value='".$_POST['date']."'";}}else{echo "value='".$daterdv."'";} }else{echo "value='".$daterdv."'";}?> ><?php
										if(isset($erreur['date'][0])){
											echo '<script>$("#outinputdate").addClass("champ-erreur");</script>';
											echo '<small class="error">La date n\'est pas valide. Veuillez vérifier à respecter le format: jj/mm/aaaa</small>';
										}
										if(isset($erreur['date'][1])){
											echo '<script>$("#outinputdate").addClass("champ-erreur");</script>';
											echo '<small class="error">Le champ date est vide. </small>';
										}
									?></div></div><div class="col pr-5"> à <div class="inblo" id="outinputheure"><input type="text" id="inputheure" name="heure" placeholder="hh:mm"  <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['heure'])){echo "value='".$_POST['heure']."'";}} else{echo "value='".$heurerdv."'";}}else{echo "value='".$heurerdv."'";}?>/><?php
										if(isset($erreur['heure'][0])){
											echo '<script>$("#outinputheure").addClass("champ-erreur");</script>';
											echo '<small class="error">L\'heure n\'est pas valide. Veuillez vérifier à respecter le format: hh:mm</small>';
										}
										if(isset($erreur['heure'][1])){
											echo '<script>$("#outinputheure").addClass("champ-erreur");</script>';
											echo '<small class="error">Le champ heure est vide. </small>';
										}
									?></div></div></div>
								<select id="selecttype" name="type" class="col pr-5">
									
									<option value="rdv" class="grise">Normale</option>
									<option value="domicile">Domicile</option>
									<option value="autre">Autre</option>
									
								</select>
								
								<div id="inputduree" class="col pr-5" ><input id="outinputduree" type="text" name="duree" placeholder="Durée en minutes" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['duree'])){echo "value='".$_POST['duree']."'";}}else{echo "value='".$dureerdv."'";} }else{echo "value='".$dureerdv."'";}?>/><?php
										if(isset($erreur['duree'])){
											echo '<script>$("#inputduree").addClass("champ-erreur");</script>';
											}
										if(isset($erreur['duree'][0])){
											echo '<small class="error">La durée n\'est pas valide. Veuillez vérifier que../dekadmin.php vous entrez bien un nombre en minutes.</small>';
										}
										if(isset($erreur['duree'][1])){
											echo '<small class="error">Le champ durée est vide. </small>';
										}
										if(isset($erreur['duree'][2])){
											echo '<small class="error">La durée ne peut pas être négative. </small>';
										}
										if(isset($erreur['duree'][3])){
											echo '<small class="error">La durée est anormalement élevée... </small>';
										}
									?></div>
								<input type="text" id="idinputpatient"  name="patient" placeholder="Nom et prénom du patient" value="<?php echo $nompat; ?>"/>
								<input type="text"  name="motif" placeholder="Motif" value="<?php echo $motifrdv; ?>"/>
								<input type="hidden" id="inputidmed" name="idmed" value="<?php if($_SESSION['type']=="med"){echo $_SESSION['userid'];} ?>"/>
								<input type="hidden" id="inputidrdv" name="idrdv" value="<?php echo $idrdv; ?>"/>
								<input type="hidden" name="posttype" value="modrdv"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>
						</div>
					</div>
				</div>
				<!-- Fenetre d'ajout d'une plage -->
				<div class="md-modal md-effect-1" id="addpla">
					<div class="md-content">
						<h3>Ajout d'une plage</h3>
						<div>
							<form action="agenda-options" method="post">
								<!-- <label for="selectjour">Jour: </label> -->
								<select id="selectjour" name="jour" class="">
									
									<option value="mon">Lundi</option>
									<option value="tue">Mardi</option>
									<option value="wed">Mercredi</option>
									<option value="thu">Jeudi</option>
									<option value="fri">Vendredi</option>
									<option value="sat">Samedi</option>
									<option value="sun">Dimanche</option>
									
								</select>
								<input type="text" name="hdebut" placeholder="Début - hh:mm" class="mabot col pr-5"/>
								<input type="text" name="hfin" placeholder="Fin - hh:mm" class="mabot maleft col pr-5"/>
								<input type="hidden" id="inputidmed" name="idmed" value="<?php if($_SESSION['type']=="med"){echo $_SESSION['userid'];} ?>" />
								<input type="hidden" name="posttype" value="newpla" />
								<select id="selecttype" name="type" class="col pr-5">
									
									<option value="rdv" class="grise">Normale</option>
									<option value="domicile">Domicile</option>
									<option value="autre">Autre</option>
									
								</select>
								<input type="text" name="duree" placeholder="Durée en minutes" class="mabot maleft col pr-5"/>
								
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>
						</div>
					</div>
				</div>
				<!-- Fenetre d'ajout d'un congé -->
				<div class="md-modal md-effect-1" id="addcon">
					<div class="md-content">
						<h3>Ajout d'un congé</h3>
						<div>
							<form action="agenda" method="post">
								<div><div class="col pr-5"> Du <div class="inblo"  id="outinputdatecon"><input id="inputdatecon" type="text"  name="datecon" placeholder="jj/mm/aaaa" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['datecon'])){echo "value='".$_POST['datecon']."'";}} }?> ><?php
										if(isset($erreur['datecon'][0])){
											echo '<script>$("#outinputdatecon").addClass("champ-erreur");</script>';
											echo '<small class="error">La date n\'est pas valide. Veuillez vérifier à respecter le format: jj/mm/aaaa</small>';
										}
										if(isset($erreur['datecon'][1])){
											echo '<script>$("#outinputdatecon").addClass("champ-erreur");</script>';
											echo '<small class="error">Le champ date est vide. </small>';
										}
									?></div></div><div class="col pr-5"> à <div class="inblo" id="outinputheurecon"><input type="text" id="inputheurecon" name="heurecon" placeholder="hh:mm"  <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['heurecon'])){echo "value='".$_POST['heurecon']."'";}} }?>/><?php
										if(isset($erreur['heurecon'][0])){
											echo '<script>$("#outinputheurecon").addClass("champ-erreur");</script>';
											echo '<small class="error">L\'heure n\'est pas valide. Veuillez vérifier à respecter le format: hh:mm</small>';
										}
										if(isset($erreur['heurecon'][1])){
											echo '<script>$("#outinputheurecon").addClass("champ-erreur");</script>';
											echo '<small class="error">Le champ heure est vide. </small>';
										}
									?></div></div></div>
									<div><div class="col pr-5"> Au <div class="inblo"  id="outinputdateb"><input id="inputdateb" type="text"  name="dateb" placeholder="jj/mm/aaaa" <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['dateb'])){echo "value='".$_POST['dateb']."'";}} }?> ><?php
										if(isset($erreur['dateb'][0])){
											echo '<script>$("#outinputdateb").addClass("champ-erreur");</script>';
											echo '<small class="error">La date n\'est pas valide. Veuillez vérifier à respecter le format: jj/mm/aaaa</small>';
										}
										if(isset($erreur['dateb'][1])){
											echo '<script>$("#outinputdateb").addClass("champ-erreur");</script>';
											echo '<small class="error">Le champ date est vide. </small>';
										}
									?></div></div><div class="col pr-5"> à <div class="inblo" id="outinputheureb"><input type="text" id="inputheureb" name="heureb" placeholder="hh:mm"  <?php if(isset($erreur)){if(count($erreur)>0){if(isset($_POST['heureb'])){echo "value='".$_POST['heureb']."'";}} }?>/><?php
										if(isset($erreur['heureb'][0])){
											echo '<script>$("#outinputheureb").addClass("champ-erreur");</script>';
											echo '<small class="error">L\'heure n\'est pas valide. Veuillez vérifier à respecter le format: hh:mm</small>';
										}
										if(isset($erreur['heureb'][1])){
											echo '<script>$("#outinputheureb").addClass("champ-erreur");</script>';
											echo '<small class="error">Le champ heure est vide. </small>';
										}
									?></div></div></div>
									<input type="hidden" id="inputidmed" name="idmed" value="<?php if($_SESSION['type']=="med"){echo $_SESSION['userid'];} ?>"/>
									<input type="hidden" name="posttype" value="newcong"/>
								<button class="md-submit">Enregistrer</button>
							</form>					
								<button class="md-close">Annuler</button>		
						</div>
					</div>
				</div>
		    	
		    	<div class="md-overlay"></div>
		    	<script src="js/classie.js"></script>
		    	<script src="js/modalEffects.js"></script>
		    	<!-- Liste des patients du médecin pour l'autocomplete -->
		    	<script>
			    	$(function() {
					    var patients = [
					      "Aucun",
					      "test"
<?php 
					      	
					      	$idmedecin = $_SESSION['userid'];
					      	$idp = $bdd->query("select * from liens where idmed=$idmedecin");
							while($idpat = $idp->fetch()){
					      		$idpatient = $idpat['idpat'];
								$patient = $bdd->query("select * from utilisateurs where id=$idpatient");
								$patient = $patient -> fetchAll(PDO::FETCH_ASSOC);
						      	$nomdupatient = $patient[0]['nom'].' '.$patient[0]['prenom'];
					      		echo ', "'.$nomdupatient.'"';
					      	}
					      ?>

					    ];
					    $( "#idinputpatient" ).autocomplete({
					      source: patients
					    });
					  });
		    	</script>