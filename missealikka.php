<?php
	require_once "../config_vp2022.php";
	//echo $server_host;

    $author_name = "UkuKrsr";
    $full_time_now = date("d.m.Y H:i:s.u");
    $now = DateTime::createFromFormat('U.u', microtime(true));  
    $weekday_now = date("N");  
    $weekdaynames_et = ["Esmaspäev", "Teisipäev", "Kolmapäev", "Neljapäev", "Reede", "Laupäev", "Pühapäev"];
    $hours_now = date("H");
    $part_of_day = "Chillax ";
    if ($hours_now < 7 and $weekday_now = ["Esmaspäev", "Teisipäev", "Kolmapäev", "Neljapäev", "Reede"]) {
        $part_of_day = "tuduaeg ";
    }
    if ($hours_now >= 8 and $hours_now < 18 and $weekday_now = ["Esmaspäev", "Teisipäev", "Kolmapäev", "Neljapäev", "Reede"]) {
        $part_of_day = "Tööaeg";
    }
    $semester_begin = new DateTime("2022-9-5");
    $semester_end = new DateTime("2022-12-18");
    $semester_duration = $semester_begin ->diff ($semester_end) ;
    $semester_duration_days = $semester_duration ->format("%r%a");
    
    $from_semester_begin = $semester_begin ->diff($now);
    $from_semester_begin_days = $from_semester_begin ->format("%r%a");
    
    $konnapoiss = $semester_end ->diff($now);
    $konnmees = $konnapoiss ->format("%r%a");
    $oldwords = [" Mida Juku ei koodi, seda Juhan ei näe.", " Haukuv HTML ei hammusta.", " Kuidas progeja HTMLile, nii HTML progejale", " Javascripti asju ei jäeta järgmise päeva varna", " Kellele HTML, kellele PHP"];
	
	
	
	//juhuslik foto
	$photo_dir = "photos";
	//loen kataloogi sisu
	//$all_files = scandir($photo_dir);
	$all_files = array_slice(scandir($photo_dir), 2);
	//kontrollin kas ikka foto
	$allowed_photo_types = ["image/jpeg" , "image/png"];
	//tsükkel
	//muutuja väärtuse suurendamine $muutuja = $muutuja + 5
	//$muutuja += 5..... kui on vaja liita 1 siis $muutuja++ ja vice versa
	/*for($i = 0;$i < count($all_files); $i++) {
		print $all_files[$i];
	} */
	$photo_files = [];
	foreach ($all_files as $filename) {
		//echo $filename;
		$file_info = getimagesize($photo_dir . "/" .$filename);
		//var_dump ($file_info);
		//kas on lubatud tüüpide nimerkirjas 
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($photo_files, $filename);
			}
		

		}
	}
	//var_dump($photo_files);
	// <img src="kataloog/fail" alt="tekst">
	$photo_html = '<img src="'. $photo_dir ."/" .$photo_files[mt_rand(0, count($photo_files) - 1)] .'"';
	$photo_html .= ' alt="Tallinna pilt">';
	
	
	
	
	//vaatame mida vormis sisestati
	//var_dump($_POST) ;
	//echo $_POST["todays_adjective_input"] ;
	
	$todays_adjective = "pole midagi sisestatud";
	if(isset($_POST["todays_adjective_input"]) and !empty ($_POST["todays_adjective_input"])) {
		$todays_adjective = $_POST["todays_adjective_input"];
		
	}
		//loome rippmenüü valikud
		//<option value="undefined"></option>
		//<option value="0">Loodusfoto</option>
		//<option value="1">Tänavafoto</option>
		//<option value="2">Droonifoto</option>
		$select_html = '<option value ="" selected disabled> Vali pilt</option';
		for($i = 0;$i < count($photo_files); $i++) {
			$select_html .='<option value ="0' .$i . '">';
		$select_html .= $photo_files[$i];
		$select_html .= "</option>";
		}
		
		if (isset($_POST["photo_select"]) and !empty($_POST["photo_select"])) {
		echo $_POST["photo_select"];}
		
		$comment_error = null;
		$grade = 7;
			
			
		
		//kas klikiti salvesta nupule (päevakommentaar)
		if(isset($_POST["comment_submit"])){
			if(isset($_POST["comment_input"]) and !empty($_POST["comment_input"])){
				$comment = $_POST["comment_input"];
			} else {
				$comment_error = "Kommentaar jäi kirjutamata!";
			}
			$grade = $_POST["grade_input"];
			
			if(empty($comment_error)){
			
				//loon andmebaasiga ühenduse
				//server, kasutaja, parool, andmebaas
				$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
				//määran suhtlemisel kasutatava kooditabeli
				$conn->set_charset ("utf8");
				//valmistame ette andmete saatmise SQL käsu
				$stmt = $conn->prepare("INSERT INTO vp_daycomment (comment, grade) values(?,?)");
				echo $conn->error;
				//seome SQL käsu õigete andmetega
				//andmetüübid i - integer 	d - decimal 	s - string
				$stmt->bind_param("si", $comment, $grade);
				if($stmt->execute()){
					$grade = 7;
					$comment = null;
				}	
				//sulgeme käsu
				$stmt->close();
				//andmebaasi ühenduse sulgemine
				$conn->close();
		}
	}

	
?>
 
 
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <title><?php echo $author_name;?> Web Development Agency</title>
</head>
<body>
<h1>UkuKrsr Web Development Agency</h1>
<p>This website not work </p>
<p>This website was developed by <a href="https://www.tlu.ee" target="_blank">UkuKrsr Web Development Agency</a></p>
<a href="https:\\www.tlu.ee" target ="_blank"><img src="pix\chilling.jpg" alt="Tallinna Ülikool annab hariduse!!!!!!!!!"></a>
 
<h2> Tegu on püramiidskeemiga </h2>
 
<p> Veebilehe looja UkuKrsr on mitme püramiidskeemiga seotud noormees </p>
<p> Praegu on <?php print $part_of_day;?> </p>
<?php
 
print "Lehe avamise hetk: " . $now->format("m-d-Y  H:i:s.u. ");
print "Semester on kestnud " . $from_semester_begin_days . " päeva.";
print " Semestri pikkus on " . $semester_duration_days . " päeva ja ";
print "semestri lõpuni on jäänud" .  $konnmees . " päeva.";


 
 

?>
<hr>
<?php
print " Tänane vanasõna:" . $oldwords[mt_rand(0, (count($oldwords) - 1 ))]; 
print $photo_html;
?>

<hr>
<form method="POST">
	<label for="comment_input">Kommentaar tänase päeva kohta (140 tähemärki)</label>
	<br>
	<textarea id="comment_input" name="comment_input" cols="35" rows="4" 
	placeholder="kommentaar"></textarea>
	<br>
	<label for="grade_input">Hinne tänasele päevale (0-10)</label>
	<input type="number" id="grade_input" name="grade_input" min="0" max="10" step="1"
	value="<?php echo $grade?>">
	 
<br>
	<input type="submit" id="comment_submit" name="comment_submit" value="Salvesta">
	<span> <?php echo $comment_error ?></span>


</form>
<hr>

<form method="POST">
	<input type="text" id="todays_adjective_input" name="todays_adjective_input"
	placeholder="Kirjuta siia omadussõna tänase päeva kohta">
	<input type="submit" id="todays_adjective_submit" name="todays_adjective_submit" value ="Saada omadussõna">
	
<hr>

</form>
<p> Omadussõna tänase kohta: <?php echo $todays_adjective ?> <p>
<hr>
<form method="POST">
	<select id="photo_select" name="photo_select">
	<?php echo $select_html 
	?>
	</select>
	<input type="submit" id="photo_submit" name="photo_submit" value="Vali foto">
	
	
<hr>


</form>
</html>
 

