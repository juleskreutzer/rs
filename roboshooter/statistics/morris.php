<?php
header('Content-Type: application/x-javascript');

$db['host'] = "92.48.206.233";
$db['user'] = "eu186781_a15";
$db['pass'] = "kreutzer";
$db['name'] = "eu186781_rs";

//Verbinding maken
$con = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);

function donutChartGender() {
	global $con;
	$sqlMale = "SELECT COUNT(geslacht) AS male FROM roboshooter WHERE geslacht = 'male'";
	$sqlFemale = "SELECT COUNT(geslacht) AS female FROM roboshooter WHERE geslacht = 'female'";
	$resultMale = $con->query($sqlMale);
	$resultFemale = $con->query($sqlFemale);
	while($rowMale = $resultMale->fetch_assoc()) {
		$male = stripslashes($rowMale['male']);
	}
	while($rowFemale = $resultFemale->fetch_assoc()) {
		$female = stripslashes($rowFemale['female']);
	}

	$donut = "Morris.Donut({
        element: 'donutChartGender',
        data: [{
            label: 'male',
            value: $male
        }, {
            label: 'female',
            value: $female
        }],
        resize: true
    });

	";

	return($donut);
}

function donutChartAge() {
	global $con;
	$sql21Min = "SELECT COUNT(*) AS min FROM roboshooter WHERE age < 21";
	$sql21Plus = "SELECT COUNT(*) AS plus FROM roboshooter WHERE age >= 21";
	$resultMin = $con->query($sql21Min);
	$resultPlus = $con->query($sql21Plus);
	while($rowMin = $resultMin->fetch_assoc()) {
		$min = stripslashes($rowMin['min']);
	}
	while($rowPlus = $resultPlus->fetch_assoc()) {
		$plus = stripslashes($rowPlus['plus']);
	}

	$donut = "Morris.Donut({
        element: 'donutChartAge',
        data: [{
            label: 'Jonger dan 21 jaar',
            value: $min
        }, {
            label: '21 jaar of ouder',
            value: $plus
        }],
        resize: true
    });

	";

	return($donut);
}

function donutChartPointTopMin() {
	global $con;
	$sqlTop = "SELECT COUNT(*) AS top FROM game WHERE score = 24";
	$sqlFail = "SELECT COUNT(*) AS fail FROM game WHERE score = 0";
	$resultTop = $con->query($sqlTop);
	$resultFail = $con->query($sqlFail);
	while($rowTop = $resultTop->fetch_assoc()) {
		$top = stripslashes($rowTop['top']);
	}
	while($rowFail = $resultFail->fetch_assoc()) {
		$fail = stripslashes($rowFail['fail']);
	}

	$donut = "Morris.Donut({
        element: 'donutChartTopMin',
        data: [{
            label: 'Spelers met 24 punten:',
            value: $top
        }, {
            label: 'Spelers met 0 punten:',
            value: $fail
        }],
        resize: true
    });

	";

	return($donut);
}

function displayAllPoints() {
	global $con;
	$line = "Morris.Line({
        element: 'displayAllPoints',
        data: [";
	for($i = 0; $i <= 24; $i++) {
		$sql = "SELECT COUNT(*) AS points FROM game WHERE score = '$i'";
		$result = $con->query($sql);
		while($rowPoints = $result->fetch_assoc()) {
			$point = stripslashes($rowPoints['points']);
		}
		$line .="{
            nummer: '$i punten',
            points: $point
        }";
		if($i != 24) {
			$line .=",";
		}
		else
		{
			$line .= "],";
		}
	}
	$line .= "
				xkey: ['nummer'],
        ykeys: ['points'],
        xlabels: ['nummer'],
        smooth: false,
        resize: true
    });
	";

	return($line);
}

?>
