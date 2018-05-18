<?php
#Turn off all error reporting
// error_reporting(0);

// if(count($_POST)<2){
// 	$responseData = json_encode(array('status' => 'false',
// 							'message' => "IP has been Blocked and forwarded TO IT Dept. For legal Activity"),
// 							JSON_FORCE_OBJECT);
// 	echo $responseData;
// 	exit;
// }

$response = "no response";
$check = 1; #if any of the data is not provided this turns 0
foreach($_POST as $key=>$value){
	$value = trim($value);
	$value = strip_tags($value);
	$value = stripslashes($value);
	$postdata[$key]=$value;
}
#data validation
if(strlen($postdata['userId'])<1){
	$response .= "Empty/Invalid UserId"."<br />";
	$check = 0;
}
if(strlen($postdata['related'])<1){
	$response .= "Please Select related"."<br />";
	$check = 0;
}
// if(strlen($postdata['details'])<1){
// 	$postdata['details'] = "No details Submitted to form";
// }
if($check == 0){ #if any of the above validation fails
	$responseData = json_encode(array('status' => 'false','message' => $response), JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}
	

	
	#code for email	
	$email_message = "";
	$email_message .= "Dear ,\n\n";
	$email_message .= "Query for user Id".$postdata['userId']." \n";
    $email_message .= "Realted to ".$postdata['related']."has been submited \n\n";
    // $email_message .= "details are ".$postdata['details']." \n\n";
	$email_message .= "Regards\n";
	$email_message .= "Team Bit Plus+ Market\n";
	$to = "info@bitplusmarket.com" ;
    $subject = "Registration confirmation for Bit Plus+ Market";
    $headers = "From: Bit Plus+ Market <account@bitplusmarket.com>\r\n";
    $headers .= "Reply-To: account@bitplusmarket.com \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1" . "\r\n";
	

	if (! @mail($to, $subject, $email_message, $headers)) {
		$responseData = json_encode(array('status' => 'false', 'message' =>
			'Sorry Your request cannot be submitted due to internel error, please try again after sometime'),
						JSON_FORCE_OBJECT);
	echo $responseData;
	}
	else{
		$responseData = json_encode(array('status' => 'true', 'message' =>
			'Your query for user id '.$postdata["userId"].' has been Submitted to '.$postdata["related"].' Support Department. We will get in touch with you in next 24 Hours.'),
						JSON_FORCE_OBJECT);
		echo $responseData;
	}
	



?>