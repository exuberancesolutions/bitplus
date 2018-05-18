<?php
require_once('connect.php');
$today = date("Y/m/d");

#select people who has balance more than 30 USD
$query = "select * from balance where total>=30";	
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute = $sth->execute(array());
if(! $excute ){
	echo "Error in fetching balance details on ".$today." \n ";
	exit;
}
$result=$sth->fetchall();
if(empty($result)){
	echo "No users with balance more than 30USD on ".$today." \n ";
	exit;
}else{
	#for each user do withdrawal
	foreach($result as $row){
		$total = $row['total'];
		
		#updating total balance for the parent
		$query = "UPDATE balance SET total=0 WHERE userId=?";
		$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$excute= $sth->execute(array($row['userId']));
		if(! $excute ){
			echo "Error in updating total balance for BIT".$row['userId']." \n ";
		}
		
		#create transaction for the withdrawal
		$refNo = uniqid("TRNF");
			
		$query = "INSERT INTO transactions(refno,userId,dot,amount,balance,transferType,transactionType) VALUES( ?, ?, ?, ?, ?, ?, ?)";
		$sth = $dbh->prepare($query);
		$excute=$sth->execute(array($refNo,$row['userId'],$today,$total,0,"debit","Withdrawal"));
		if(! $excute ){
			echo "Error in connection while creating transaction \n";
			exit;
		}
		echo "Weekly withdrawal done for BIT".$row['userId']." done on ".$today." \n";
	}
}
?>