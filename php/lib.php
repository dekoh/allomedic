<?php
	function validateDate($date)
	{
		/*
$motif = "#^[0-9]{1,2}+/[0-9]{1,2}+/[0-9]{4,}$#";
	 	if(preg_match($motif,$date)){
			 $error = true; 
		}
		else{
*/
			list($dd,$mm,$yyyy) = explode('/',$date);
			if (!checkdate($mm,$dd,$yyyy)) {
			        $error = true;
			}
			else{
				$error = false;
			}
		/* } */
		/*

	    preg_match('/(?<jour>\w+)/ (?<mois>\d+)/ (?<annee>\d+)/', $date, $matches);
	    $matches
*/
	    
	    return $error;
	}
	function validateHeure($heure)
	{
		$motif = "#^[0-9]{1,2}+:[0-9]{2,}$#";
	 	if(preg_match($motif,$heure)){
			 $error = true; 
		}
		else{
			list($hh,$mm) = explode(':',$heure);
			if ($hh<=24 && $hh>=0) {
			    if ($mm<=59 && $mm>=0) {
				    $error = false;
				}
				else{
					$error = true;
				}
			}
			else{
				$error = true;
			} 
		}

		
		
	    return $error;
	}
	function top($hd, $dj, $ratio=1.8){
		$top=explode(':',date('H:i',$hd));
		$mh=$top[0]*60;
		$min=$mh+$top[1];
		$top=$min-$dj;
		
			$top= $top*$ratio;
		
		return $top;
	}
	function topp($hd, $dj, $ratio=1.8){
		$hd = mintoh($hd);
		$top=explode(':',$hd);
		$mh=$top[0]*60;
		$min=$mh+$top[1];
		$top=$min-$dj;
		if($top>0){
			$top= $top*$ratio;
			$top=$top+4;
		}
		return $top;
	}
	function height($hd, $hf, $ratio=1.8){
		$he= $hf - $hd;
		$he = $he / 60;
		$height = $he * $ratio;
		$height = $height - 2;
		return $height;
	}
	function afficherAgenda($datejour,$jour,$bdd,$debutj,$finj){
		$id=$_SESSION['userid'];
		$datejour= str_replace('/', '-',$datejour);
		$datejour = strtotime($datejour);
		$datelendemain= $datejour + 86400;
		$heightot = 120;
		$fer = false;
		$ferie = $bdd->query("select * from ferie");
		while($jourferie = $ferie->fetch()){
			if($jourferie['date']==$datejour){
				$fer = true;
				$nomfer= $jourferie['nom'];
			}
		}
		$conge = $bdd->query("select * from rdv where idmed=$id and type='cong' and annulation='0' ");
		/* on vérifie les congés */
		while($cong = $conge->fetch()){
			if($datejour<$cong['date'] && $datelendemain>$cong['date']){
				if($datejour<$cong['datefin'] && $datelendemain>$cong['datefin']){
					echo '
			<a href="rdv/'.$cong['id'].'"><li data-rdvid="'.$cong['id'].'" class="'.$cong['type'].' sectrdv t1" style="top: '.top($cong['date'],$debutj).'px; height: '.height($cong['date'],$cong['datefin']).'px;">
				<div class="bloccl" style="height: '.(height($cong['date'],$cong['datefin'])+20).'px;"></div>
				<span class="heure-rdv">'.date('H:i',$cong['date']).'</span>
				<span class="patient-rdv">'.$cong['nompatient'].'</span>
				
			</li></a>
				<div id="rdvinfo'.$cong['id'].'" class="rdvinfo" style="top:'.(top($cong['date'],$debutj)+height($cong['date'],$cong['datefin'])).'px">motif: '.$cong['motif'].'</div>';
				}
				else{
					
				}
			}
		}
		$rdv = $bdd->query("select * from rdv where idmed=$id and annulation='0' and date between  $datejour and $datelendemain ");
		/* echo str_replace('-', '/', date('d-m-Y',$datejour)); */
		while($rdvd = $rdv->fetch()){
			$idpatient=$rdvd['idpat'];
			$patient = $bdd->query("select * from utilisateurs where id=$idpatient");
			$pat = $patient->fetchAll();					
			
			if($rdvd['type']!="cong"){
				
			echo '
			<a href="rdv/'.$rdvd['id'].'"><li data-rdvid="'.$rdvd['id'].'" class="'.$rdvd['type'].' sectrdv t1" style="top: '.top($rdvd['date'],$debutj).'px; height: '.height($rdvd['date'],$rdvd['datefin']).'px;">
				<div class="bloccl" style="height: '.(height($rdvd['date'],$rdvd['datefin'])+20).'px;"></div>
				<span class="heure-rdv">'.date('H:i',$rdvd['date']).'</span>
				<span class="patient-rdv">'.$rdvd['nompatient'].'</span>
				
			</li></a>
				<div id="rdvinfo'.$rdvd['id'].'" class="rdvinfo" style="top:'.(top($rdvd['date'],$debutj)+height($rdvd['date'],$rdvd['datefin'])).'px">motif: '.$rdvd['motif'].'</div>';
			}
			
			$heightot = $heightot + height($rdvd['date'],$rdvd['datefin']);
		}
		if($fer!=true){						
		$plage = $bdd->query("select * from plages where idmed=$id and jour='$jour'");
		while($pla = $plage->fetch()){
			$debut = $pla['debut'];
			$debut = $debut*60;
			$debut = $debut + $datejour;
			$fin = $pla['fin'];
			$fin = $fin*60;
			$fin = $fin + $datejour;
			$premd = $debut;
			$rdvtj = $bdd->query("select * from rdv where idmed=$id and annulation=0 and datefin between $datejour and $datelendemain");
			
			$derd = $debut;
			/* On vérifie si il y a un rendez-vous qui commence avant la plage horraire et qui se termine dans la plage horraire	*/
			while($rdvt = $rdvtj->fetch()){
				if($rdvt['datefin']>$debut&&$rdvt['date']<=$debut){
					$derdd = $rdvt['datefin'];
				}
			}
			
			$rdv = $bdd->query("select * from rdv where idmed=$id and annulation=0 and date between $debut and $fin order by date ");
			$count = $rdv->rowCount();						
			/* création des plages libres */
			while($rdvj = $rdv->fetch()){
				/* On vérifie ou est le rendez-vous, on calcule ensuite les endroits ou on doit placer les plages libres. */			
				if($rdvj['date']>$premd){
					$debutad = $premd;
					$finad = $rdvj['date'];
					echo '<li class="md-trigger plagelibre test2" data-modal="addrdv" data-date="'.date("d/m/Y",$debutad).'" data-heure="'.date("H:i",$debutad).'" data-type="'.$pla['type'].'" data-min="'.$pla['duree'].'" style="top: '.top($debutad,$debutj).'px; height: '.height($debutad, $finad).'px;"><span>+ajouter</span></li>';
					$heightot = $heightot + height($debutad, $finad);
				}
				$premd = $rdvj['datefin'];
				if($rdvj['datefin']>$derd){
					$derd = $rdvj['datefin'];
				}
											
			}
			/* On complete si il y a de la place libre a la fin de la plage horraire */
			
			if($derd<$fin){
				if(isset($derdd)&&$derdd>$derd){
					
						$debutad = $derdd;
					
				}
				else{
					$debutad = $derd;
				}
				
				$finad = $fin;
				echo '<li class="md-trigger plagelibre test3" data-modal="addrdv" data-date="'.date("d/m/Y",$debutad).'" data-heure="'.date("H:i",$debutad).'" data-type="'.$pla['type'].'" data-min="'.$pla['duree'].'" style="top: '.top($debutad,$debutj).'px; height: '.height($debutad, $finad).'px;"><span>+ajouter</span></li>';
				$heightot = $heightot + height($debutad, $finad);
			}
		}
		}
		else{
			echo "<div class='nomjour'>".$nomfer."</div>";
		}
		return $heightot;
	}
	function afficherPlagelibre($datejour,$jour,$bdd,$id){
		$id=intval($id);
		$datejour= str_replace('/', '-',$datejour);
		$datejour = strtotime($datejour);
		$datelendemain= $datejour + 86400;
		$datehier= time() - 86400;
		$fer = false;
		$ferie = $bdd->query("select * from ferie");
		while($jourferie = $ferie->fetch()){
			if($jourferie['date']==$datejour){
				$fer = true;
				$nomfer= $jourferie['nom'];
			}
		}
		
		if($fer!=true){						
			$plage = $bdd->query("select * from plages where idmed=$id and jour='$jour' order by debut");
			while($pla = $plage->fetch()){
					if($pla['type']=="rdv" && $datejour>$datehier){
					$debut = $pla['debut'];
					$debut = $debut*60;
					$debut = $debut + $datejour;
					$fin = $pla['fin'];
					$fin = $fin*60;
					$fin = $fin + $datejour;
					$premd = $debut;
					$rdvtj = $bdd->query("select * from rdv where idmed=$id and annulation=0 and datefin between $datejour and $datelendemain");
					
					$derd = $debut;
					/* On vérifie si il y a un rendez-vous qui commence avant la plage horraire et qui se termine dans la plage horraire	*/
					while($rdvt = $rdvtj->fetch()){
						if($rdvt['datefin']>$debut&&$rdvt['date']<=$debut){
							$derdd = $rdvt['datefin'];
						}
					}
					
					$rdv = $bdd->query("select * from rdv where idmed=$id and annulation=0 and date between $debut and $fin order by date ");
					$count = $rdv->rowCount();		
					$med = $bdd->query("select * from utilisateurs where id=$id");		
					$medic = $med->fetchAll();
					$nommed = $medic[0]['nom'];		
					/* création des plages libres */
					while($rdvj = $rdv->fetch()){
						
						if($rdvj['date']>$premd){
							$debutad = $premd;
							$finad = $rdvj['date'];
							$longad = $finad - $debutad;
							$longad = $longad / 60;
							$nbpl = $longad / $pla['duree'];
							$debutrdv = $debutad;
							for ($i = 1; $i <= $nbpl; $i++) {
								$dbrdv = date("H:i", $debutrdv);
								$dursec = $pla['duree']*60;
								$firdv = $debutrdv + $dursec;
								$frdv = date("H:i", $firdv);
								$dateentierrdv = recupjour(date("D", $debutrdv))." ".date("d/m/Y", $debutrdv);
							    echo "<li class='md-trigger'  data-modal='addrdvpat' data-heureb='".$dbrdv."' data-dateb='".$dateentierrdv."' data-nommed='".$nommed."' data-duree='".$pla['duree']."' data-idmed='".$id."' data-date='".$debutrdv."'>".$dbrdv." - ".$frdv."</li>";
							    $debutrdv = $firdv;
							}
						}
						$premd = $rdvj['datefin'];
						if($rdvj['datefin']>$derd){
							$derd = $rdvj['datefin'];
						}
													
					}
					/* On complete si il y a de la place libre a la fin de la plage horraire */
					
					if($derd<$fin){
						if(isset($derdd)&&$derdd>$derd){
							
								$debutad = $derdd;
							
						}
						else{
							$debutad = $derd;
						}
						
						$finad = $fin;
						$longad = $finad - $debutad;
						$longad = $longad / 60;
						$nbpl = $longad / $pla['duree'];
						$debutrdv = $debutad;
						for ($i = 1; $i <= $nbpl; $i++) {
							$dbrdv = date("H:i", $debutrdv);
							$dursec = $pla['duree']*60;
							$firdv = $debutrdv + $dursec;
							$frdv = date("H:i", $firdv);
							$dateentierrdv = recupjour(date("D", $debutrdv))." ".date("d/m/Y", $debutrdv);
						    echo "<li class='md-trigger' data-modal='addrdvpat'  data-modal='addrdvpat' data-heureb='".$dbrdv."' data-dateb='".$dateentierrdv."' data-nommed='".$nommed."' data-duree='".$pla['duree']."' data-idmed='".$id."' data-date='".$debutrdv."'>".$dbrdv." - ".$frdv."</li>";
						    $debutrdv = $firdv;
						}
						
					}
				}
			}
		}
		else{
			echo "<div class='nomjour'>".$nomfer."</div>";
		}
	}

	function mintoh($min){
		$h = floor($min / 60);
		$mh = $h * 60;
		$m = $min -$mh;
		if($m==0){$m=$m."0";}
		if($h<10){$h="0".$h;}
		$heure = $h.":".$m;
		return $heure;
	}
	function htomin($he){
		$he = explode(":", $he);
		$h = $he[0];
		$m = $he[1];
		$mh = $h *60;
		$min = $mh + $m;
		return $min;
	}
	function afficherPlages($jour,$bdd,$debutj){
		$id=$_SESSION['userid'];
		$heightot = 100;
		$pla = $bdd->query("select * from plages where idmed=$id AND jour='$jour'");
		while($rdvd = $pla->fetch()){
			echo '
			<li class="plage '.$rdvd['type'].'" style="top: '.topp($rdvd['debut'],$debutj,1).'px; height: '.height(($rdvd['debut']*60),($rdvd['fin']*60),1).'px;">
				<span class="heure-rdv">'.mintoh($rdvd['debut']).' - '.mintoh($rdvd['fin']).'</span>
				<div class="modifmenu">
					<button class="modifplage md-trigger" data-modal="modpla" data-hdeb="'.mintoh($rdvd['debut']).'" data-hfin="'.mintoh($rdvd['fin']).'"  data-duree="'.$rdvd['duree'].'" data-type="'.$rdvd['type'].'" data-jour="'.$rdvd['jour'].'" data-id="'.$rdvd['id'].'"><div>modif</div></button>
					<button class="supplage md-trigger" data-modal="suppla"  data-id="'.$rdvd['id'].'"><div>sup</div></button>
				</div>
			</li>';
			$heightot = $heightot + height(($rdvd['debut']*60),($rdvd['fin']*60),1);
		}
		return $heightot;

	}
	function age($date_naissance)
	    {
		    if(!empty($date_naissance)){
			    $date_today=explode("-",date ('Y-n-j'));
			    $annee_today=$date_today[0];
			    $mois_today=$date_today[1];
			    $jour_today=$date_today[2];
			 
			    $date_naissance=explode("/", $date_naissance);
			    $annee_naissance=$date_naissance[2];
			    $mois_naissance=$date_naissance[1];
			    $jour_naissance=$date_naissance[0];
			 
			    $age =  $annee_today - $annee_naissance;
			    if ($mois_today < $mois_naissance) $age=$age-1;
			    if ( ($mois_today == $mois_naissance) && ($jour_today < $jour_naissance) )  $age=$age-1;
			    return $age;
		    }
	    }	
	 function recupmois($mois){
	   	if($mois==1){
		   	$nomois = "Janvier";
	   	}
	   	elseif($mois==2){
		   	$nomois = "Février";
	   	}
	   	elseif($mois==3){
		   	$nomois = "Mars";
	   	}
	   	elseif($mois==4){
		   	$nomois = "Avril";
	   	}
	   	elseif($mois==5){
		   	$nomois = "Mai";
	   	}
	   	elseif($mois==6){
		   	$nomois = "Juin";
	   	}
	   	elseif($mois==7){
		   	$nomois = "Juillet";
	   	}
	   	elseif($mois==8){
		   	$nomois = "Aout";
	   	}
	   	elseif($mois==9){
		   	$nomois = "Septembre";
	   	}
	   	elseif($mois==10){
		   	$nomois = "Octobre";
	   	}
	   	elseif($mois==11){
		   	$nomois = "Novembre";
	   	}
	   	elseif($mois==12){
		   	$nomois = "Décembre";
	   	}
	   	return $nomois;
	   }	
	function imagethumb( $image_src , $image_dest = NULL , $max_size = 100, $expand = FALSE, $square = FALSE ){
		if( !file_exists($image_src) ) return FALSE;
	
		// Récupère les infos de l'image
		$fileinfo = getimagesize($image_src);
		if( !$fileinfo ) return FALSE;
	
		$width     = $fileinfo[0];
		$height    = $fileinfo[1];
		$type_mime = $fileinfo['mime'];
		$type      = str_replace('image/', '', $type_mime);
	
		if( !$expand && max($width, $height)<=$max_size && (!$square || ($square && $width==$height) ) )
		{
			// L'image est plus petite que max_size
			if($image_dest)
			{
				return copy($image_src, $image_dest);
			}
			else
			{
				header('Content-Type: '. $type_mime);
				return (boolean) readfile($image_src);
			}
		}
	
		// Calcule les nouvelles dimensions
		$ratio = $width / $height;
	
		if( $square )
		{
			$new_width = $new_height = $max_size;
	
			if( $ratio > 1 )
			{
				// Paysage
				$src_y = 0;
				$src_x = round( ($width - $height) / 2 );
	
				$src_w = $src_h = $height;
			}
			else
			{
				// Portrait
				$src_x = 0;
				$src_y = round( ($height - $width) / 2 );
	
				$src_w = $src_h = $width;
			}
		}
		else
		{
			$src_x = $src_y = 0;
			$src_w = $width;
			$src_h = $height;
	
			if ( $ratio > 1 )
			{
				// Paysage
				$new_width  = $max_size;
				$new_height = round( $max_size / $ratio );
			}
			else
			{
				// Portrait
				$new_height = $max_size;
				$new_width  = round( $max_size * $ratio );
			}
		}
	
		// Ouvre l'image originale
		$func = 'imagecreatefrom' . $type;
		if( !function_exists($func) ) return FALSE;
	
		$image_src = $func($image_src);
		$new_image = imagecreatetruecolor($new_width,$new_height);
	
		// Gestion de la transparence pour les png
		if( $type=='png' )
		{
			imagealphablending($new_image,false);
			if( function_exists('imagesavealpha') )
				imagesavealpha($new_image,true);
		}
	
		// Gestion de la transparence pour les gif
		elseif( $type=='gif' && imagecolortransparent($image_src)>=0 )
		{
			$transparent_index = imagecolortransparent($image_src);
			$transparent_color = imagecolorsforindex($image_src, $transparent_index);
			$transparent_index = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
			imagefill($new_image, 0, 0, $transparent_index);
			imagecolortransparent($new_image, $transparent_index);
		}
	
		// Redimensionnement de l'image
		imagecopyresampled(
			$new_image, $image_src,
			0, 0, $src_x, $src_y,
			$new_width, $new_height, $src_w, $src_h
		);
	
		// Enregistrement de l'image
		$func = 'image'. $type;
		if($image_dest)
		{
			$func($new_image, $image_dest);
		}
		else
		{
			header('Content-Type: '. $type_mime);
			$func($new_image);
		}
	
		// Libération de la mémoire
		imagedestroy($new_image); 
	
		return TRUE;
	}
	function recupjour($jour){
		if($jour=="Mon"){
		   	$nojour = "lundi";
	   	}
	   	elseif($jour=="Tue"){
		   	$nojour = "mardi";
	   	}
	   		elseif($jour=="Wed"){
		   	$nojour = "mercredi";
	   	}
	   		elseif($jour=="Thu"){
		   	$nojour = "jeudi";
	   	}
	   		elseif($jour=="Fri"){
		   	$nojour = "vendredi";
	   	}
	   		elseif($jour=="Sat"){
		   	$nojour = "samedi";
	   	}
	   		elseif($jour=="Sun"){
		   	$nojour = "dimanche";
	   	}
	   	return $nojour;
	}
	
?>