<?php
require_once('connect.php');
$today = date("Y/m/d");
#select people who has loyalty due for credit
$query  ="SELECT userId FROM balance where loyalty>0";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute=$sth->execute();
if(! $excute ){
	echo "Error in fetching users who have due loyalty on ".$today." \n ";
	exit;
}
$result=$sth->fetchall();
if(empty($result)){
	echo "No users with due loyalty on ".$today." \n ";
	exit;
}else{
	#for each user check if they have more than 3 users
	foreach($result as $row){
		$query = "select * from graph where parent=:userId";	
		$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$excute = $sth->execute(array(':userId' => $row['userId']));
		if(! $excute ){
			echo "Error in fetching number of child for user ".$row['userId']." \n ";
			exit;
		}
		$resultNew = $sth->fetchall();
		if(count($resultNew)>=3){
			#eligible for credit, loyalty has to be made 0 and has to be added in total
			$query = "select * from balance where userId=:userId";	
			$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$excute = $sth->execute(array(':userId' => $row['userId']));
			if(! $excute ){
				echo "Error in fetching balance details for user ".$row['userId']." \n ";
				exit;
			}
			$resultBalance = $sth->fetchall();
			$rowBalance = $resultBalance['0'];
			$loyalty = $rowBalance['loyalty'];
						
			#updating loyalty and total balance for the parent
			$query = "UPDATE balance SET loyalty=0, total=total+? WHERE userId=?";
			$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$excute= $sth->execute(array($loyalty,$row['userId']));
			if(! $excute ){
				echo "Error in updating loyalty for BIT".$row['userId']." \n ";
			}
			
			$balance = $rowBalance['total']+$loyalty;
			$refNo = uniqid("TRNF");
			
			#create transaction for the credited loyalty
			$query = "INSERT INTO transactions(refno,userId,dot,amount,balance,transferType,transactionType) VALUES( ?, ?, ?, ?, ?, ?, ?)";
			$sth = $dbh->prepare($query);
			$excute=$sth->execute(array($refNo,$row['userId'],$today,$loyalty,$balance,"credit","Loyalty"));
			if(! $excute ){
				echo "Error in connection while creating transaction \n";
				exit;
			}
		
			echo "Loyalty credit for BIT".$row['userId']." done \n";
		}
	}
}
?>