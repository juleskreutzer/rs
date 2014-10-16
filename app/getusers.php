<?php

$link = mysql_pconnect("localhost, eu186781_jules, jk291194") ;

mysql_select_db("eu186781_app") or die("Kan de database niet vinden...");

$arr = array();

$rs = mysql_query($link,"SELECT * FROM users");
while($obj = mysqli_fetch_object($rs)) {
	$arr[] = $obj;
}

echo json_encode($arr);

?>