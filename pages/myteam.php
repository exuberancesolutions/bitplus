<?php
#Turn off all error reporting
error_reporting(0);
session_start();
if(!isset($_SESSION['userId'])){
	header('LOCATION:../login.php');
	exit;
}
include "../connect.php" ;
include "queue.php" ;
$queue = new Queue();
$level = 1;
$srNo = 1;
$queue->enqueue(substr($_SESSION['userId'],3));
$queue->enqueue('level');
$teaminvestment = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'headtag.php'; ?>
</head>

  <body id="page-top">

<?php include'nav.php';?>

<div class="container-fluid" style="padding-top: 20px;padding-bottom: 30px;">
	<div class="row">
		<div class="col"></div>
		<div class="col"></div>
		<div class="col"></div>
		<div class="col"></div>
		<div class="col"></div>
	</div>

  <div class="row">
    <div class="col-sm-10 offset-1 payDetails">
    
    	        <table class="table">
      <thead>
		<tr>
          <th scope="col">S.No</th>
          <th scope="col">Name</th>
          <th scope="col">Sponsor</th>
          <th scope="col">User ID</th>
          <th scope="col">Total Purchase</th>
          <th scope="col">BP</th>
          <th scope="col">DOJ</th>
          <th scope="col">Level</th>
        </tr>
      </thead>
	  <tbody>
	  <?php
	  // to be updated to level 25
		while(!$queue->isEmpty() and $level!=50){
			$root = $queue->dequeue();
			if($root=='level'){
				$level++;
				$root = $queue->dequeue();
			}
			$query = "select u.userId, u.applicantName, u.package, u.doj, g.parent from graph g, user u where g.parent=:userId AND u.userId=g.child";	
			$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$excute = $sth->execute(array(':userId' => $root));
			if(!$excute){
				break;
			}
			$result=$sth->fetchall();
			if(empty($result)){	
				#echo "parent-> BIT".$root." | child-> null <br>";
			}else{
				foreach($result as $row){
					$queue->enqueue($row['userId']);
					echo '
					<tr ';
					echo $row['package']>0?'class="text-success"':'class="text-danger"';

					echo '>
						<th scope="row">'.$srNo.'</th>
						<td>'.$row['applicantName'].'</td>
						<td>BIT'.$row['parent'].'</td>
						<td>BIT'.$row['userId'].'</td>
						<td>'.$row['package']; echo $row['package']>0?'$':'not Active'; echo '</td>
						<td>BP</td>
						<td>'.$row['doj'].'</td>
						<td>'.$level.'</td>
					</tr>';
					$srNo++;


				}
				$queue->enqueue('level');

			}
		} 
	  ?>



      </tbody>
    </table>
      
  </div><!-- end of div col-sm-12 -->
  <div class="col-sm-3 offset-4">
  	<nav aria-label="Page navigation example">
		  <ul class="pagination">
		    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
		    <li class="page-item"><a class="page-link" href="#">1</a></li>
		    <li class="page-item"><a class="page-link" href="#">2</a></li>
		    <li class="page-item"><a class="page-link" href="#">3</a></li>
		    <li class="page-item"><a class="page-link" href="#">4</a></li>
		    <li class="page-item"><a class="page-link" href="#">5</a></li>
		    <li class="page-item"><a class="page-link" href="#">6</a></li>
		    <li class="page-item"><a class="page-link" href="#">Next</a></li>
		  </ul>
		</nav>
  </div><!--end of div row-->
</div><!--end of div container-->

    <!-- Footer -->
	<?php include 'footer.php'; ?>

    <!-- Bootstrap core JavaScript -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../js/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../js/agency.min.js"></script>

  </body>
</html>