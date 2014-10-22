<?php
//Variabele ontvangen van C#
	$uid = stripslashes($_POST['uid']);
	$score = stripslashes($_POST['score']);

	//Verbinding met database opzetten
	$con = mysqli_connect("92.48.206.233", "eu186781_a15", "kreutzer", "eu186781_rs") or die(mysqli_error);
	$sql = "UPDATE roboshooter SET scoreEind = '$score' WHERE id = '$uid'";

	$con->query($sql);

	echo 'Go away. Secret NSA information is included on this site...';
