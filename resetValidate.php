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
}
#data validation
if(strlen($postdata['userId'])<1){
	$response .= "Empty/Invalid UserId"."<br />";
	$check = 0;
}
if((strlen($postdata['applicantContactNo'])<1) or !(ctype_digit($postdata['applicantContactNo']))){
	$response .= "Empty/Invalid Contact Number"."<br />";
	$check = 0;
}

if($check == 0){ #if any of the above validation fails
	$responseData = json_encode(array('status' => 'false','message' => $response), JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}
$postdata['applicantContactNo'] = filter_var($postdata['applicantContactNo'],FILTER_SANITIZE_NUMBER_INT);
$userId = substr($postdata['userId'],3);

#form submission takes place
require_once('connect.php');//connecting to the server

$query = "select applicantName,applicantEmail,applicantContactNo FROM user where userId=? AND applicantContactNo=?";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute = $sth->execute(array($userId, $postdata['applicantContactNo']));
	
if(!$excute ){
	$responseData = json_encode(array('status' => 'false',
								'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

$result=$sth->fetchall();
if(empty($result)){	
	#user not found
	$responseData = json_encode(array('status' => 'false',
								'message' => "User with provided details does not exist. Please try again! <br/>"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}else{
	#user found, change password
	$row=$result[0];
	
	#code to generate password of length 10
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $password = '';
    for ($i = 0; $i < 5; $i++) {
        $password .= $characters[rand(0, $charactersLength - 1)];
    }
	$hashedPassword = md5($password);
	
	#update details in the login table
	$query = "Update login set password=? where userId=?";
	$sth = $dbh->prepare($query);
	$excute=$sth->execute(array($hashedPassword,$userId));
	if(!$excute ){
		$responseData = json_encode(array('status' => 'false',
									'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
									JSON_FORCE_OBJECT);
		echo $responseData;
		exit;
	}
	
	#code for email	
	$email_message = "";
	$email_message .= "Dear ".$row['applicantName'].",\n\n";
	$email_message .= "Your password has been resetted. \n";
    $email_message .= "Your new password is ".$password."\n\n";
	$email_message .= "Regards\n";
	$email_message .= "Team Bit Plus+ Market\n";
	$to = $row['applicantEmail'] ;
    $subject = "Registration confirmation for Bit Plus+ Market";
    $headers = "From: Bit Plus+ Market <account@bitplusmarket.com>\r\n";
    $headers .= "Reply-To: account@bitplusmarket.com \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1" . "\r\n";
	
	mail($to, $subject, $email_message, $headers,"-f account@bitplusmarket.com");
	
	#code for sms
	$authenticationKey = "9e75a7d6453e4119d1848522e14c63b4";
	$url = "http://sms.exuberancesolutions.com/api/send_http.php?authkey=".$authenticationKey."&mobiles=".$row['applicantContactNo']."&message=Dear+".$row['applicantName'].",+Your+password+has+been+resetted.+Your+new+password+is+".$password."+Please+check+your+mail+for+the+same.&sender=BITPLU&route=B";
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_URL, $url);
	$resp = curl_exec($curl);
	curl_close($curl);
	
	$responseData = json_encode(array('status' => 'true',
								'message' => "Password has been resetted. Your New Password is ".$password." Check sms and mail for more details.<br/>"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}	
?>