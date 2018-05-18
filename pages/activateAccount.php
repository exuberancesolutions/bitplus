<?php
#Turn off all error reporting
error_reporting(0);

if(count($_POST)<4){
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
if((strlen($postdata['admin'])<1) && $postdata['admin'] == 1){
$response .= "Empty/Invalid Date Of active"."<br />"."Cannot Change the account Type"."<br />";
$check = 0;
}
if((strlen($postdata['active'])<1) && $postdata['active'] == 0){
$response .= "Account Activity invalid"."<br />";
$check = 0;
}
if((strlen($postdata['userId'])<1)){
$response .= "Empty/Invalid User Id"."<br />";
$check = 0;
}

#if any of the above validation fails
if($check == 0){ 
	$responseData = json_encode(array('status' => 'false','message' => $response), JSON_FORCE_OBJECT);
	echo $responseData;
	exit;
}

#sanitization of data
$postdata['via'] = filter_var($postdata['via'],FILTER_SANITIZE_STRING);
$postdata['userId'] = filter_var($postdata['userId'],FILTER_SANITIZE_STRING);
$via = substr($postdata['via'],3);
$userId = substr($postdata['userId'],3);
$doa = $postdata['doa'];


		if($via==$userId){
			$responseData = json_encode(array('status' => 'false','message' => "Loged In User Id and Input UserId are same."), JSON_FORCE_OBJECT);
			echo $responseData;
			exit;
		}

		#form submission takes place
		require_once('../connect.php');//connecting to the server
			#code to fetch balances of franchise  of via party
		$query  ="SELECT userId, franchise FROM balance WHERE userId=:via";
		$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$excute=$sth->execute(array(':via' => $via));
		if(! $excute ){
			$responseData = json_encode(array('status' => 'false',
									'message' => "Error in connection"."<br/>"."Cant Fetch Franchise Balance From Server"."<br />"),
									JSON_FORCE_OBJECT);
			echo $responseData;
			exit;
		} 
	$result=$sth->fetchall();
	$row = $result[0];
	#check wheter the franchise balance  is morethen equal to package
	$franchisebalance = $row['franchise'];
	if($franchisebalance <= $package){
		$responseData = json_encode(array('status' => 'false',
									'message' => "Insufficient Franchise Balance"."<br/>"."Please Try Again after adding the fund to Franchise"."<br />"),
									JSON_FORCE_OBJECT);
		echo $responseData;
		exit;
		}



		#deduct franchise balance from user and update
		$newfbalance = $franchisebalance - $postdata['package'];
		$query = "UPDATE balance SET franchise=:newfbalance WHERE userId=:via";
		$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$excute= $sth->execute(array(':newfbalance'=>$newfbalance,':via'=>$via));
		if(!$excute){
			$responseData = json_encode(array('status' => 'false',
										'message' => "Cannot Update franchise balance To the Loged in user Balance"."<br />"),
										JSON_FORCE_OBJECT);
			echo $responseData;
			exit;
		}
		#code to check to userid exist ID	
		$query  ="SELECT userId FROM login WHERE userId=:userId and active=0";
		$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$excute=$sth->execute(array(':userId' => $userId));
		if(! $excute ){
			$responseData = json_encode(array('status' => 'false',
									'message' => "Error In connection"."<br />"."Please Try Again"."<br/>"),
									JSON_FORCE_OBJECT);
			echo $responseData;
			exit;
		} 

		$result=$sth->fetchall();
		if(sizeof($result) <1){
			$responseData = json_encode(array('status' => 'false',
									'message' => "Account of User doesn't exist or  account is already active. Please check and try again."."<br />"),
									JSON_FORCE_OBJECT);
			echo $responseData;
			exit;
		}



	#insert details into investment table
	$query = "INSERT INTO investment(userId,amount,doa,via) VALUES( ?, ?, ?, ?)";
	$sth = $dbh->prepare($query);
	$excute=$sth->execute(array($userId,intval($postdata['package']),$doa,$via));


	if(! $excute ){
		$responseData = json_encode(array('status' => 'false',
								'message' => "User details saved. "."<br/>"."Investment details couldn't be saved, please contact administrator."."<br />"),
								JSON_FORCE_OBJECT);
		echo $responseData;
		exit;
	}


	#change the active status in login table
	$query = "UPDATE login SET active=:active , admin=:admin WHERE userId=:userId";
	$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$excute= $sth->execute(array(':active'=>$postdata['active']=="1"?1:0,':admin'=>$postdata['admin']=="1"?1:0, ":userId"=> $userId));

	if(! $excute ){
		$responseData = json_encode(array('status' => 'false',
								'message' => "Cannot Update Login"."<br/>"."Please Contact Your admin"."<br />"),
								JSON_FORCE_OBJECT);
		echo $responseData;
		exit;
	} 

	#update package details
	$query = "UPDATE user SET package=:package, doa=:doa WHERE userId=:userId";
	$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$excute= $sth->execute(array(':package'=>$postdata['package'], ":doa"=> $postdata['doa'], ":userId"=> $userId));

	if(! $excute ){
		$responseData = json_encode(array('status' => 'false',
								'message' => "User details updated. "."<br/>"."Package details couldn't be saved, please contact administrator"."<br />"),
								JSON_FORCE_OBJECT);
		echo $responseData;
		exit;
	} 

	

	#Account Active successful
	$responseData = json_encode(array('status' => 'true',
								'message' => "Account with user id  BIT".$userId." Activated successful with package $".$postdata['package']." And Updated Franchise Balance for BIT".$via." is $".$newfbalance),
								JSON_FORCE_OBJECT);
echo $responseData;
?>