<?php
	require_once "../config_vp2022.php";

	//loon andmebaasiga ühenduse
	//server, kasutaja, parool, andmebaas
	$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
	//määran suhtlemisel kasutatava kooditabeli
	$conn->set_charset ("utf8");
	
	//valmistame ette andmete saatmise SQL käsu
	$stmt = $conn->prepare("SELECT comment, grade, added FROM vp_daycomment");
	echo $conn->error;
	//seome saadavad andmed muutujatega
	$stmt->bind_result($comment_from_db, $grade_from_db, $added_from_db);
	//täidame käsu
	$stmt->execute();
	//kui saan ühe kirje
	//if($stmt->fetch()){
		//mis selle ühe kirjega teha
		
	//}
	
	//kui tuleb teadmata arv kirjeid
	$comment_html = null;
	while($stmt->fetch()) {
		//echo $comment_from_db;
		//<p> kommentaar, hinne päevale: 6, lisatud xxxxxxxx</p>
		$comment_html .= "<p>" .$comment_from_db .", hinne päevale: " .$grade_from_db;
		$comment_html .= ", lisatud " .$added_from_db . ".</p> \n";
		
		
		
	}






?>

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>UkuKrsr Web Development Agency</title>
</head>
<body>
<h1>UkuKrsr Web Development Agency</h1>
<p>This website not work </p>
<p>This website was developed by <a href="https://www.tlu.ee" target="_blank">UkuKrsr Web Development Agency</a></p>


<h2> Tegu on püramiidskeemiga</h2>

<p> Veebilehe looja UkuKrsr on mitme püramiidskeemiga seotud noormees </p>
<?php echo $comment_html; ?>
</body>
</html>