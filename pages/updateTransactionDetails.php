<?php
#Turn off all error reporting
error_reporting(0);
session_start();

$response = "";
$check = 1; #if any of the data is not provided this turns 0
foreach($_POST as $key=>$value){
	$value = trim($value);
	$value = strip_tags($value);
	$value = stripslashes($value);
	$postdata[$key]=$value;
}//end of foreach

#data validation
if((strlen($postdata['transactionNo'])<1) ){
$response .= "No transaction Number"."<br />";
$check = 0;
}

if($check == 0){ #if any of the above validation fails
	$responseData = json_encode(array('status' => 'false','message' => $response), JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

require_once('../connect.php');


#update Transaction Details details
$query = "UPDATE transactions SET transactionStatus = '1' WHERE refNo=:refNo";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute= $sth->execute(array(":refNo"=> $postdata['transactionNo']));

if(! $excute ){
	$responseData = json_encode(array('status' => 'false',
							'message' => "False".$postdata['transactionNo']. "Coudnt be Updated"),
							JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
} 


$responseData = json_encode(array('status' => 'true','message' => "Payment for User Id BIT". $postdata['userId']." With payment of amount $".$postdata['amount']." With transaction reference ".$postdata['transactionNo']." has been successfully done "),JSON_FORCE_OBJECT);
echo $responseData;
?>