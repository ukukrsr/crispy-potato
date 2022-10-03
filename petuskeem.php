<?php
	$author_name = "UkuKrsr";
	$full_time_now = date("d.m.Y H:i:s.u");
	$now = DateTime::createFromFormat('U.u', microtime(true));	
	$weekday_now = date("N");	
	$weekdaynames_et = ["Esmaspäev", "Teisipäev", "Kolmapäev", "Neljapäev", "Reede", "Laupäev", "Pühapäev"];
	$hours_now = date("H");
	$part_of_day = "Chillax ";
	if ($hours_now < 7) {
		$part_of_day = "tuduaeg ";
	}
	if ($hours_now >= 8 and $hours_now < 18) {
		$part_of_day = "Tööaeg";
	}
	$semester_begin = new DateTime("2022-9-5");
	$semester_end = new DateTime("2022-12-18");
	$semester_duration = $semester_begin ->diff ($semester_end) ;
	$semester_duration_days = $semester_duration ->format("%r%a");
	print "Semestri pikkus on " . $semester_duration_days . " päeva ja ";
	$from_semester_begin = $semester_begin ->diff($now);
	$from_semester_begin_days = $from_semester_begin ->format("%r%a");
	print "semester on kestnud " . $from_semester_begin_days . " päeva";
	$konnapoiss = $semester_end ->diff($now);
	$konnmees = $konnapoiss ->format("%r%a");
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

<h2> Tegu on püramiidskeemiga</h2>

<p> Veebilehe looja UkuKrsr on mitme püramiidskeemiga seotud noormees </p>
<p> Praegu on <?php print $part_of_day;?> </p>
<?php

print "Lehe avamise hetk: " . $now->format("m-d-Y  H:i:s.u ") . $weekdaynames_et[$weekday_now - 1];

print "Semestri lõpuni on jäänud" .  $konnmees . " päeva.";
?>
</html>