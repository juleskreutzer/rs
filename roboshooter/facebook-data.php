<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$con = mysqli_connect("92.48.206.233", "eu186781_a15", "kreutzer", "eu186781_rs") or die(mysqli_error);
 
  if(isset($_POST['data'])) {
    // decode data
    $return = $_POST['data'];
    $data = json_decode($return, true);
    // save data in session
    session_start();
    $_SESSION['first_name'] = $data[0];
    $_SESSION['last_name'] = $data[1];
    $_SESSION['email'] = $data[2];
    $_SESSION['age_range'] = $data[3]["min"];
    $_SESSION['gender'] = $data[4];
	
	//toevoegen nieuwe gebruiker in database
	$firstName = $data[0];
	$lastName = $data[1];
	$email = $data[2];
	$age = $data[3]["min"];
	$geslacht = $data[4];
	
	
	$check = mysqli_query($con,"SELECT COUNT(*) AS email WHERE email = '$email'");
	
	$check_result = mysqli_num_rows($check);
	
	if($check_result > 0) {
		echo 'Gebruiker bestaat al, geen gegevens toevoegen aan database.';
	}
	else
	{
		$sql = "INSERT INTO roboshooter (voornaam, achternaam, email, age, geslacht) VALUES
			($firstName, $lastName, $email, $age, $geslacht)";
		$result = mysqli_query($con,$sql);
		echo 'Nieuwe gebruiker toegevoegd!';
	}
  }

 ?>