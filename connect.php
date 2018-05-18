<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bitplusm_database';

try {
    #Create connection
    $dbh = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);
}catch(PDOException $e){
    $responseData = json_encode(array('status' => 'false',
								'message' => "Internal server error.<br/>Please contact support service<br/>"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

// Check connection
if(!$dbh){
	$responseData = json_encode(array('status' => 'false',
								'message' => "Error in connection"."<br/>"."Please contact support service"."<br />"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}
?>