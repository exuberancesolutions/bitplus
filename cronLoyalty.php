<?php
require_once('connect.php');
$today = date("Y/m/d");
$perct[1]=0.1;
$perct[2]=0.06;
$perct[3]=0.05;
$perct[4]=0.04;
$perct[5]=0.03;
$perct[6]=0.02;
$perct[7]=0.01;
$perct[8]=0.005;
$perct[9]=0.0025;
$perct[10]=0.00125;
// $perct[11]=0.000625;
// $perct[12]=0.0003125;
// $perct[13]=0.00015625;
// $perct[14]=0.00007812;
// $perct[15]=0.00003906;
// $perct[16]=0.00001953;
// $perct[17]=0.00000952;
// $perct[18]=0.00000425;
// $perct[19]=0.00000215;
// $perct[20]=0.00000172;
// percent to br updated to 20th level and no condition for direct child, other then condition of 3.
#select people whose teamEarning flag is false and account is activated
$query  ="SELECT u.userId, package FROM user u INNER JOIN login l on u.userId=l.userId where l.active=1 and u.teamEarning=0";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute=$sth->execute();
if(! $excute ){
	echo "Error in fetching data for users eligible for loyalty calculation on ".$today." \n ";
	exit;
}
$result=$sth->fetchall();
if(empty($result)){
	echo "No users eligible for loyalty calculation on ".$today." \n ";
	exit;
}else{
	#for each user whose loyalty has not been given to parents
	foreach($result as $row){
		$level = 1;
		$currChild = $row['userId'];
		while($level<=10){
			$currLoyalty = $perct[$level]*intval($row['package']);
			$query = "select parent from graph where child=:userId";	
			$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$excute = $sth->execute(array(':userId' => $currChild));
			$resultNew = $sth->fetchall();
			if(empty($resultNew))
				break;
			$rowNew = $resultNew['0'];
			$currParent = $rowNew['parent'];
			
			#update loyalty for parent
			$query = "UPDATE balance SET loyalty=IFNULL(loyalty,0)+? WHERE userId=?";
			$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$excute= $sth->execute(array($currLoyalty,$currParent));
			if(! $excute ){
				echo "Error in updating loyalty for parent BIT".$currParent." for child ".$currChild." on ".$today." \n ";
			}

			$currChild = $currParent;
			$level++;
		}
		#update teamEarning flag to 1
		$query = "UPDATE user SET teamEarning=1 WHERE userId=?";
		$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$excute= $sth->execute(array($row['userId']));
		if(! $excute ){
			echo "Error in updating teamEarning flag for BIT".$row['userId']." \n ";
		}
		echo "Loyalty awarded to parents for BIT".$row['userId']." on ".$today." \n ";
	}
}
?>