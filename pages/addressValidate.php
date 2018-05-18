<?php
#Turn off all error reporting
error_reporting(0);
session_start();
if(count($_POST)<4){
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
if((strlen($postdata['address1'])<1)){
$response .= "Empty House Number / Block Number"."<br />";
$check = 0;
}
if((strlen($postdata['address2'])<1)){
$response .= "Empty Address Line 1"."<br />";
$check = 0;
}
if((strlen($postdata['address3'])<1)){
$response .= "Empty Locality / Street / Area"."<br />";
$check = 0;
}
if((strlen($postdata['state'])<1) or !(ctype_alpha(str_replace(" ", "",$postdata['state'])))){
$response .= "Empty/Invalid State / Province"."<br />";
$check = 0;
}

if($check == 0){ #if any of the above validation fails
	$responseData = json_encode(array('status' => 'false','message' => $response), JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

#sanitization of data
$postdata['address1'] = filter_var($postdata['address1'],FILTER_SANITIZE_STRING);
$postdata['address2'] = filter_var($postdata['address2'],FILTER_SANITIZE_STRING);
$postdata['address3'] = filter_var($postdata['address3'],FILTER_SANITIZE_STRING);
$postdata['state'] = filter_var($postdata['state'],FILTER_SANITIZE_STRING);

$area = $postdata['address1']." ".$postdata['address2']." ".$postdata['address3'];

#form submission takes place
require_once('../connect.php');//connecting to the server

#code to fetch match sponsor ID entered
$query = "UPDATE user SET area=:area, state=:state WHERE userId=:userId";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute= $sth->execute(array(':area'=>$area,':state'=>$postdata['state'],':userId'=>substr($_SESSION['userId'],3)));

if(!$excute ){
	$responseData = json_encode(array('status' => 'false',
								'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

#submission successful
$responseData = json_encode(array('status' => 'true', 'message' => "Address updated successfully. Refresh page to view new details."),JSON_FORCE_OBJECT);
echo $responseData;
?>