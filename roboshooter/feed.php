<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$con = mysqli_connect("92.48.206.233", "eu186781_a15", "kreutzer", "eu186781_rs") or die(mysqli_error);

$sql = "SELECT
          game.userID,
          game.score,
          roboshooter.id,
          roboshooter.voornaam,
          roboshooter.achternaam
        FROM
          game, roboshooter
        WHERE
          game.userID = roboshooter.id
        ORDER BY game.score DESC LIMIT 5

      ";

$result = mysqli_query($con,$sql);

$return = array();

while($row = mysqli_fetch_array($result))
{
    $return[] = array(
      'voornaam' => $row['voornaam'],
      'achternaam' => $row['achternaam'],
      'score' => $row['score']
    );
}

echo json_encode($return);
?>
