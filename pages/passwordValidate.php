<?php
#Turn off all error reporting
error_reporting(0);
session_start();
if(count($_POST)<3){
//this is to count how many values are sent in the post request
//if the user directly pings the page or uses other platform for pining the page with less values
	//header('LOCATION:http://homepageURL');
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
	$postdata[$key]=$value; //$postdata['email']
}//end of foreach

#data validation
if((strlen($postdata['oldPassword'])<1) or (strlen($postdata['newPassword'])<1) or (strlen($postdata['confirmPassword'])<1)){
$response .= "All fields are mandatory"."<br />";
$check = 0;
}
if($postdata['newPassword'] != $postdata['confirmPassword']){
$response .= "New password & confirm password didn't match"."<br />";
$check = 0;
}

if($check == 0){ #if any of the above validation fails
	$responseData = json_encode(array('status' => 'false','message' => $response), JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

#form submission takes place
require_once('../connect.php');//connecting to the server

#code to fetch match sponsor ID entered
$password = md5($postdata['oldPassword']);
$newPassword = md5($postdata['newPassword']);
$query = "select * from login where userId=:userId AND password=:password";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute = $sth->execute(array(':userId' => substr($_SESSION['userId'],3), ':password' => $password));
			
if(!$excute ){
	$responseData = json_encode(array('status' => 'false',
								'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

$result=$sth->fetchall();
if(empty($result)){
	#incorrect password entered
	$responseData = json_encode(array('status' => 'false',
								'message' => "Incorrect password entered. Please try again"."<br />"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

$query = "UPDATE login SET password=:newPassword WHERE userId=:userId";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute= $sth->execute(array(':newPassword'=>$newPassword,':userId'=>substr($_SESSION['userId'],3)));

if(!$excute ){
	$responseData = json_encode(array('status' => 'false',
								'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

#submission successful
$responseData = json_encode(array('status' => 'true', 'message' => "Password updated successfully."),JSON_FORCE_OBJECT);
echo $responseData;
?>