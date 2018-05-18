<?php
#Turn off all error reporting
#error_reporting(0);

if(count($_POST)<18){
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

if($check == 0){ #if any of the above validation fails
	$responseData = json_encode(array('status' => 'false','message' => $response), JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

#sanitization of data
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

#connecting to the server
require_once('../connect.php');	

#insert details in the user table
$query = "Update user set applicantName=?, applicantFatherName=?, applicantMotherName=?, gender=?, applicantDOB=?, maritalStatus=?, 
							area=?, state=?, country=?, applicantEmail=?, applicantContactNo=?, bitcoinLink=?, bankAccNo=?, 
							nomineeName=?, nomineeFatherName=?, nomineeMotherName=?, relation=? where userId=? ";
$sth = $dbh->prepare($query);
$excute=$sth->execute(array($postdata['applicantName'],$postdata['applicantFatherName'],$postdata['applicantMotherName'],$postdata['gender'],
						$postdata['applicantDOB'], $postdata['maritalStatus'],$area,$postdata['state'], $postdata['country'], $postdata['applicantEmail'],
						$postdata['applicantContactNo'],$postdata['bitcoinLink'],$postdata['bankAccNo'],$postdata['nomineeName'],$postdata['nomineeFatherName'],
						$postdata['nomineeMotherName'],$postdata['relation'], $postdata['userId'])
					);
if(!$excute ){
	$responseData = json_encode(array('status' => 'false',
								'message' => "Error in connection"."<br/>"."Please try submitting the form again"."<br />"),
								JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

#update successful
	
	$responseData = json_encode(array('status' => 'true','message' => "User data updated successfully for BIT".$postdata['userId']),
								JSON_FORCE_OBJECT);
	echo $responseData;
?>