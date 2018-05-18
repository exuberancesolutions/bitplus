<?php
include "../connect.php" ;
include "queue.php" ;
$queue = new Queue();
$level = 1;
$userId = $_POST['userId'];
$queue->enqueue($userId);
$queue->enqueue('level');
$sol = new \stdClass();
$teaminvestment = 0;
while(!$queue->isEmpty()){
	$root = $queue->dequeue();
	if($root=='level'){
		$level++;
		$root = $queue->dequeue();
	}
	// SELECT u.userId, u.applicantName, u.package, i.doa, i.doe, i.totalInvestment from user u, investment i where u.userId=:userId and u.userId = i.userId
	$query = "select userId, applicantName, package, doj, doa, totalInvestment from user where userId=:userId";
	$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$excute = $sth->execute(array(':userId' => $root));
	if(!$excute){
		break;
	}
	$result=$sth->fetchall();
	if(empty($result)){
		break;
	}
	$data['info'] = $result;
	$row = $result[0];
	$teaminvestment = $teaminvestment + $row['package'];
	
	$query = "select u.userId from graph g, user u where g.parent=:userId AND u.userId=g.child";
	$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$excute = $sth->execute(array(':userId' => $root));
	if(!$excute){
		break;
	}
	$result=$sth->fetchall();
	
	
	if(empty($result)){	
		#no child
	}else{
		$chCount = 1;
		foreach($result as $row){
			$queue->enqueue($row['userId']);
			$data[$chCount] = $row['userId'];
			$chCount++;
		}
		$queue->enqueue('level');
	}
	if($level<4)
		$sol->$root = $data;
	unset($data);
}
$sol->teamEarning = $teaminvestment;
echo json_encode($sol);
?>