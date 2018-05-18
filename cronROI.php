<?php
require_once('connect.php');

$query  ="SELECT * FROM investment";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute=$sth->execute();
if(! $excute ){
	echo "Error in fetching data from investment table on ".date("Y/m/d")." \n ";
	exit;
}

$result=$sth->fetchall();
if(empty($result)){
	echo "No data in investment table on ".date("Y/m/d")." \n ";
	exit;
}else{
	#logic to loop over data
	foreach($result as $row){
		$userId = $row['userId'];
		$amount = $row['amount'];
		
		$roi = 0.01 * $amount;
		$refNo = uniqid("TRNF");
		
		
		#code to fetch balances of both party
		$query  ="SELECT userId, total FROM balance WHERE userId=?";
		$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$excute=$sth->execute(array($userId));
		if(! $excute ){
			echo "Error in connection while fetching balance details \n";
			exit;
		} 
		
		#if recorde is not present in balance table yet
		$result=$sth->fetchall();
		if(empty($result)){
		    $query = "INSERT INTO balance(userId) VALUES( ?)";
		    $sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		    $excute= $sth->execute(array($userId));
		}
		
		$row = $result['0'];
		$total = $row['total'];
        $final = $total+$roi;

		#create transaction
		$query = "INSERT INTO transactions(refno,userId,dot,amount,balance,transferType,transactionType) VALUES( ?, ?, ?, ?, ?, ?, ?)";
		$sth = $dbh->prepare($query);
		$excute=$sth->execute(array($refNo,$userId,date("Y/m/d"),$roi,$final,"credit","ROI"));
		if(! $excute ){
			echo "Error in connection while creating transaction \n";
			exit;
		} 
		
		#update total balance
		$query = "UPDATE balance SET total=? WHERE userId=?";
		$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$excute= $sth->execute(array($final,$userId));
		
		if(! $excute ){
			echo "Error in updating data for user ".$userId." on ".date("Y/m/d")." \n ";
		}else{
			echo "Updated balance for user ".$userId." on ".date("Y/m/d")." is ".$final." \n";
		}
	}						
}
?>