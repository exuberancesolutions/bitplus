<?php
#Turn off all error reporting
error_reporting(0);

if(count($_POST)<2){
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
if(strlen($postdata['userId'])<1){
$response .= "Empty/Invalid User ID"."<br />";
$check = 0;
}
if(strlen($postdata['amount'])<1 || intval($postdata['amount'])<=0){
$response .= "Empty/Invalid amount"."<br />";
$check = 0;
}

if($check == 0){ #if any of the above validation fails
	$responseData = json_encode(array('status' => 'false','message' => $response), JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

#sanitization of data
$postdata['userId'] = filter_var($postdata['userId'],FILTER_SANITIZE_STRING);
$amount  = intval($postdata['amount']);
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
// old balance , adding the new value to old balance
$oldfranchisebalance = $row['franchise'];
$newfranchisebalance = $oldfranchisebalance + $amount;

#update franchise value
$query = "UPDATE balance SET franchise=? WHERE userId=?";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute= $sth->execute(array($newfranchisebalance,$userId));

if(!$excute ){
	$responseData = json_encode(array('status' => 'false',
								'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}
#update successful
$responseData = json_encode(array('status' => 'true',
							'message' => "Franchise amount ".$postdata['amount']." successfully added for user ".$postdata['userId']),
							JSON_FORCE_OBJECT);
echo $responseData;
?>