<?php
#Turn off all error reporting
error_reporting(0);

if(count($_POST)<1){
	$responseData = json_encode(array('status' => 'false',
							'message' => "Don't fuck around with the form..."),
							JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

$response = "";
$check = 1; #if any of the data is not provided this turns 0
foreach($_POST as $key=>$value){
	$value = trim($value);
	$value = strip_tags($value);
	$value = stripslashes($value);
	$postdata[$key]=$value;
}//end of foreach

#data validation
if((strlen($postdata['userId'])<1) ){
$response .= "Empty/Invalid User ID"."<br />";
$check = 0;
}

if($check == 0){ #if any of the above validation fails
	$responseData = json_encode(array('status' => 'false','message' => $response), JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

#sanitization of data
$postdata['userId'] = filter_var($postdata['userId'],FILTER_SANITIZE_STRING);
$userId = substr($postdata['userId'],3);

#form submission takes place
require_once('../connect.php');//connecting to the server

#check if user exists
$query  ="SELECT * FROM balance WHERE userId=:userId";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute=$sth->execute(array(':userId' => $userId));
if(! $excute ){
	$responseData = json_encode(array('status' => 'false',
							'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
							JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
} 

$result=$sth->fetchall();
if(sizeof($result) <1){
	$responseData = json_encode(array('status' => 'false',
							'message' => "No user with this ID exists or user not activated. Please try again"."<br />"),
							JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}	
$row = $result[0];

#fetch active and admin flag from login
$query  ="SELECT * FROM balance WHERE userId=:userId";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute=$sth->execute(array(':userId' => $userId));
if(! $excute ){
	$responseData = json_encode(array('status' => 'false',
							'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
							JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
} 
$resultNew=$sth->fetchall();
$rowNew = $resultNew[0];
$franchiseValue='nil';
if($rowNew['franchise']==null || $rowNew['franchise']==0){
	
}else{
	$franchiseValue = "$".$rowNew['franchise'];
}

$responseData = json_encode(array(
							'status' => 'true',
							'userId' => $postdata['userId'],
							'franchiseValue' => $franchiseValue,
							),
							JSON_FORCE_OBJECT);
							
echo $responseData;
?>