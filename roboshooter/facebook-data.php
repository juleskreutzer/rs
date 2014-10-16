<?php


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
	
	if(isset($_POST['data'])) {
		$con = mysqli_connect("92.48.206.233", "eu186781_a15", "kreutzer", "eu186781_rs");
		
		if(mysqli_connect_errno) {
			echo "Kon geen verbinding maken: " . mysqli_connect_error;
		}
		
		mysqli_query($con, "INSERT INTO roboshooter (voornaam, achternaam, email, age, geslacht) VALUES ('$firstName', '$lastName', '$email', '$age', '$geslacht')");
		
		mysqli_close($con);
		
		echo 'Gegevens zijn opgeslagen in de database!';
	}
	else
	{
		echo "Er was een probleem met het invoeren van de gegevens in de database!";
	}	
  }
  else
  {
	echo "Error!";
  }
  
  if(isset($_POST['data'])) {
    // decode data
    $return = $_POST['data'];
    $data = json_decode($return, true);

    // Create variables
    $first_name = $data[0];
    $last_name = $data[1];
    $email = $data[2];
    $age_range = $data[3]["min"];
    $gender = $data[4];

    // Select data in  database
    $db = mysql_connect('92.48.206.233', 'eu186781_a15', 'kreutzer') or die(mysql_error());
    mysql_select_db('eu186781_rs');

    if(isset($_POST['data'])) {
      // Store unique data in database
      $checkEmail = mysql_query("SELECT email FROM roboshooter WHERE email = '$email'");
      $checkNum = mysql_num_rows($checkEmail);
      if($checkNum == 0) {
              mysql_query("INSERT INTO users (`voornaam`, `achternaam`, `email`, `geslacht`, `age`) VALUES ('$first_name', '$last_name', '$email', '$gender', '$age_range')") or die(mysql_error());
              // save data in session
              session_start();
              $_SESSION['first_name'] = $data[0];
              $_SESSION['last_name'] = $data[1];
              $_SESSION['email'] = $data[2];
              $_SESSION['age_range'] = $data[3]["min"];
              $_SESSION['gender'] = $data[4];
      } else {
        $content = mysql_query("SELECT id, voornaam, achternaam, email, age, geslacht FROM users WHERE email = '$email'");
        while($debug = mysql_fetch_assoc($content)) {
            // save data in session
            session_start();
			$_SESSION['id'] = $debug['id'];
            $_SESSION['first_name'] = $debug['voornaam'];
            $_SESSION['last_name'] = $debug['achternaam'];
            $_SESSION['email'] = $debug['email'];
            $_SESSION['age_range'] = $debug['age'];
            $_SESSION['gender'] = $debug['geslacht'];
        }
      }
    } else {
      echo 'Data not set';
    }
  } else {
    echo "It does not work";
  }



?>