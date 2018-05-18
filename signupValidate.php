<?php
#Turn off all error reporting
error_reporting(0);

if(count($_POST)<20){
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

#personal Details
if((strlen($postdata['applicantName'])<1) or !(ctype_alpha(str_replace(" ", "",$postdata['applicantName'])))){
$response .= "Empty/Invalid Applicant Name"."<br />";
$check = 0;
}
if((strlen($postdata['applicantFatherName'])<1) or !(ctype_alpha(str_replace(" ", "",$postdata['applicantFatherName'])))){
$response .= "Empty/Invalid Father's / Husband Name of the applicant"."<br />";
$check = 0;
}
if((strlen($postdata['applicantMotherName'])<1) or !(ctype_alpha(str_replace(" ", "",$postdata['applicantMotherName'])))){
$response .= "Empty/Invalid Mother's Name of the applicant"."<br />";
$check = 0;
}
if((strlen($postdata['gender'])<1) or !(ctype_alpha(str_replace(" ", "",$postdata['gender'])))){
$response .= "Empty/Invalid Gender"."<br />";
$check = 0;
}
if((strlen($postdata['applicantDOB'])<1)){
$response .= "Empty Date of Birth"."<br />";
$check = 0;
}
if((strlen($postdata['maritalStatus'])<1) or !(ctype_alpha(str_replace(" ", "",$postdata['maritalStatus'])))){
$response .= "Empty/Invalid Marital status"."<br />";
$check = 0;
}

#contact Details
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
if((strlen($postdata['country'])<1) or !(ctype_alpha(str_replace(" ", "",$postdata['country']))) or $postdata['country']=="nil"){
$response .= "Empty/Invalid Country"."<br />";
$check = 0;
}

#contact details
if((!filter_var($postdata['applicantEmail'],FILTER_VALIDATE_EMAIL)) or (strlen($postdata['applicantEmail']) <1) ){
$response .= "Empty/Invalid Email Address"."<br />";
$check = 0;
}
if((strlen($postdata['applicantContactNo'])<1) or !(ctype_digit($postdata['applicantContactNo']))){
$response .= "Empty/Invalid Contact Number"."<br />";
$check = 0;
}

#payment details
if(strlen($postdata['bitcoinLink'])<1){
$response .= "Empty Bitcoin Link"."<br />";
$check = 0;
}

#nominee details
if((strlen($postdata['nomineeName'])<1) or !(ctype_alpha(str_replace(" ", "",$postdata['nomineeName'])))){
$response .= "Empty/Invalid Nominee Name"."<br />";
$check = 0;
}
if((strlen($postdata['nomineeFatherName'])<1) or !(ctype_alpha(str_replace(" ", "",$postdata['nomineeFatherName'])))){
$response .= "Empty/Invalid Father's / Husband Name of the Nominee"."<br />";
$check = 0;
}
if((strlen($postdata['nomineeMotherName'])<1) or !(ctype_alpha(str_replace(" ", "",$postdata['nomineeMotherName'])))){
$response .= "Empty/Invalid Mother's Name  of the Nominee"."<br />";
$check = 0;
}
if((strlen($postdata['relation'])<1)){
$response .= "Empty/Invalid Relation with the Applicant"."<br />";
$check = 0;
}

#referral
if((strlen($postdata['sponsorId'])<1)){
$response .= "Empty Sponsor ID / Referal Code"."<br />";
$check = 0;
}

#doj
if((strlen($postdata['doj'])<1)){
	$postdata['doj'] = date("Y-m-d");
}

if($check == 0){ #if any of the above validation fails
	$responseData = json_encode(array('status' => 'false','message' => $response), JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

#sanitization of data
$postdata['sponsorId'] = filter_var($postdata['sponsorId'],FILTER_SANITIZE_STRING);
$postdata['applicantName'] = filter_var($postdata['applicantName'],FILTER_SANITIZE_STRING);
$postdata['applicantFatherName'] = filter_var($postdata['applicantFatherName'],FILTER_SANITIZE_STRING);
$postdata['applicantMotherName'] = filter_var($postdata['applicantMotherName'],FILTER_SANITIZE_STRING);
$postdata['gender'] = filter_var($postdata['gender'],FILTER_SANITIZE_STRING);
$postdata['applicantDOB'] = filter_var($postdata['applicantDOB'],FILTER_SANITIZE_STRING);
$postdata['maritalStatus'] = filter_var($postdata['maritalStatus'],FILTER_SANITIZE_STRING);
$postdata['address1'] = filter_var($postdata['address1'],FILTER_SANITIZE_STRING);
$postdata['address2'] = filter_var($postdata['address2'],FILTER_SANITIZE_STRING);
$postdata['address3'] = filter_var($postdata['address3'],FILTER_SANITIZE_STRING);
$postdata['state'] = filter_var($postdata['state'],FILTER_SANITIZE_STRING);
$postdata['country'] = filter_var($postdata['country'],FILTER_SANITIZE_STRING);
$postdata['applicantEmail'] = filter_var($postdata['applicantEmail'],FILTER_SANITIZE_EMAIL);
$postdata['applicantContactNo'] = filter_var($postdata['applicantContactNo'],FILTER_SANITIZE_NUMBER_INT);
$postdata['bitcoinLink'] = filter_var($postdata['bitcoinLink'],FILTER_SANITIZE_STRING);
$postdata['nomineeName'] = filter_var($postdata['nomineeName'],FILTER_SANITIZE_STRING);
$postdata['nomineeFatherName'] = filter_var($postdata['nomineeFatherName'],FILTER_SANITIZE_STRING);
$postdata['nomineeMotherName'] = filter_var($postdata['nomineeMotherName'],FILTER_SANITIZE_STRING);
$postdata['relation'] = filter_var($postdata['relation'],FILTER_SANITIZE_STRING);

$area = $postdata['address1']." ".$postdata['address2']." ".$postdata['address3'];
$sponsorId = substr($postdata['sponsorId'],3);

#form submission takes place
require_once('connect.php');//connecting to the server

#code to fetch match sponsor ID entered
$query  ="SELECT userId FROM user WHERE userId=:sponserId";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute=$sth->execute(array(':sponserId' => $sponsorId));
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
							'message' => "Sponsor ID/ Referral code entered doesn't exist. Please check and try again"."<br />"),
							JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}	

#insert details in the user table
$query = "INSERT INTO user(applicantName,applicantFatherName,applicantMotherName,gender,applicantDOB,maritalStatus,area,state,country,
								applicantEmail,applicantContactNo,bitcoinLink,bankAccNo,nomineeName,nomineeFatherName,nomineeMotherName,relation,sponsorId,teamEarning,doj)  
			VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$sth = $dbh->prepare($query);
$excute=$sth->execute(array($postdata['applicantName'],$postdata['applicantFatherName'],$postdata['applicantMotherName'],$postdata['gender'],
						$postdata['applicantDOB'], $postdata['maritalStatus'],$area,$postdata['state'], $postdata['country'], $postdata['applicantEmail'],
						$postdata['applicantContactNo'],$postdata['bitcoinLink'],$postdata['bankAccNo'],$postdata['nomineeName'],$postdata['nomineeFatherName'],
						$postdata['nomineeMotherName'],$postdata['relation'],$sponsorId, 0, $postdata['doj'])
					);
if(!$excute ){
	$responseData = json_encode(array('status' => 'false',
								'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

	#code to fetch auto generated userId from database
	$query  ="SELECT userId FROM user WHERE applicantEmail=:email";
	$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$excute=$sth->execute(array(':email' => $postdata['applicantEmail']));
	if(! $excute ){
		exit;
	} 
	$result=$sth->fetchall();
	$last = sizeof($result);
	$row = $result[$last-1];
	$userId = $row['userId'];
	$preUserId = "BIT";	

	#code to generate password of length 5
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $password = '';
    for ($i = 0; $i < 5; $i++) {
        $password .= $characters[rand(0, $charactersLength - 1)];
    }
	$hashedPassword = md5($password);

$retry = 1;
while($retry <= 3){
	#insert details in the login table
	$query = "INSERT INTO login( userId,password,active) VALUES( ?, ?, ?)";
	$sth = $dbh->prepare($query);
	$excute=$sth->execute(array($userId,$hashedPassword,0));
	if(!$excute ){
		$retry = $retry+1;
	}else{
		break;
	}
}
if($retry == 4){//fallback
	$query = "DELETE FROM user WHERE userId = :userId";
	$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$excute = $sth->execute(array(':userId' => $userId)); 
	$responseData = json_encode(array('status' => 'false',
								'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

$query = "INSERT INTO graph( parent,child) VALUES( ?, ?)";
$sth = $dbh->prepare($query);
$excute=$sth->execute(array($sponsorId,$userId));

$message="";
if(!$excute ){
	$message = " Account not added to tree.";
}

#submission successful
	
	#code for email	
	$email_message = "";
	$email_message .= "Dear ".$postdata['applicantName'].",\n\n";
	$email_message .= "Thank You for registering with Bit Plus+ Market.\nYour User ID is : ".$preUserId.$userId."\n";
    $email_message .= "Your password is ".$password."\n";
	$email_message .= "Please login and change your password.\n\n";
	$email_message .= "Regards\n";
	$email_message .= "Team Bit Plus+ Market\n";
	$to = $postdata['applicantEmail'] ;
    $subject = "Registration confirmation for Bit Plus+ Market";
    $headers = "From: Bit Plus+ Market <account@bitplusmarket.com>\r\n";
    $headers .= "Reply-To: account@bitplusmarket.com \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1" . "\r\n";
	
	mail($to, $subject, $email_message, $headers,"-f account@bitplusmarket.com");
		
	#code for sms
	$authenticationKey = "9e75a7d6453e4119d1848522e14c63b4";
	$url = "http://sms.exuberancesolutions.com/api/send_http.php?authkey=".$authenticationKey."&mobiles=".$postdata['applicantContactNo']."&message=Thank+You+for+registering+with+Bit+Plus+Market.+Your+UserId+is+".$preUserId.$userId.",+and+password+".$password."&sender=BITPLU&route=B";
	// message=Dear,+".$postdata['applicantName']."Warm,+welcome+to+Bit+Plus+Market.+Thank+You+for+registering.+Your+UserId+is+".$preUserId.$userId.",+and+password+is+".$password."Please+Log+In+at+www.bitplusmarket.com
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_URL, $url);
	$resp = curl_exec($curl);
	curl_close($curl);
	
	$responseData = json_encode(array('status' => 'true',
								'message' => "Registration successful. Your UserId is ".$preUserId.$userId.". and Password is".$message .$password."The Details have been send to the registered mail id for further reference"),
								JSON_FORCE_OBJECT);
	echo $responseData;
?>