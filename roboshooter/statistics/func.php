<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// ===================================
// Waarden uit db halen voor dashboard
// ===================================

// -----------------------------------
// DB Verbinding
// -----------------------------------

//Gegevens vaststellen
$db['host'] = "***";
$db['user'] = "***";
$db['pass'] = "***";
$db['name'] = "***";

//Verbinding maken
$con = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);

// -----------------------------------
// Einde DB verbinding
// -----------------------------------

// -----------------------------------
// Functies
// -----------------------------------

//geslacht van elke gebruiker selecteren
function countGender($gender) {
	global $con;
	$sql = "SELECT COUNT(*) AS aantal FROM roboshooter where geslacht = '$gender'";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()) {
			echo stripslashes($row['aantal']);	
		}
}

function ageLess21() {
	global $con;
	$sql = "SELECT COUNT(*) AS ageLess FROM roboshooter WHERE age < 21";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()) {
		echo stripslashes($row['ageLess']);
	}
}

function agePlus21() {
	global $con;
	$sql = "SELECT COUNT(*) AS agePlus FROM roboshooter WHERE age >= 21";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()) {
		echo stripslashes($row['agePlus']);
	}
}

function totalPlayer() {
	global $con;
	$sql = "SELECT COUNT(*) AS total FROM roboshooter";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()) {
		echo stripslashes($row['total']);
	}
}



//Score van elke gebruiker
function getScore($score) {
	global $con;
	$stmt = $con->prepare("SELECT voornaam, achternaam, scoreEind FROM roboshooter");
	$stmt->execute();
	$stmt->bind_result($voornaam, $achternaam, $scoreEind);
	while($stmt->fetch()) {
		$row[] = array('voornaam' => $voornaam, 'achternaam' => $achternaam, 'scoreEind' => $scoreEind);
	}
	
	$html = "<ul>";
	foreach($row as $r) {
		if($score != "") {
			if($r['scoreEind'] == $score) {
			$html .= "<li>".$r['voornaam']." ".$r['achternaam']." scoort <strong>".$r['scoreEind']."</strong> punten</li>";
			}
		}
		else
		{
			$html .= "<li>".$r['voornaam']." ".$r['achternaam']." scoort <strong>".$r['scoreEind']."</strong> punten</li>";
		}
	}
	$html .= "</ul>";
	
	return($html);
}

?>
