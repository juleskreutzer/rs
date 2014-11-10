<?php
//Variabele ontvangen van C#
	$uid = stripslashes($_POST['uid']);
	$score = stripslashes($_POST['score']);

	//Verbinding met database opzetten
	$con = mysqli_connect("***", "***", "***", "***") or die(mysqli_error);
	$sql = "INSERT INTO game (userID, score) VALUES ('$uid', '$score')";

	$con->query($sql);

	echo 'Go away. Secret NSA information is included on this site...';
