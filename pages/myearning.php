<?php
#Turn off all error reporting
error_reporting(0);
session_start();
if(!isset($_SESSION['userId'])){
	header('LOCATION:../login.php');
	exit;
}
include "../connect.php" ;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'headtag.php'; ?>
</head>

  <body id="page-top">

<?php include'nav.php';?>
<?php 
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      }
      else{
        $page = 1;
      }
      if ($page == " " || $page == 1 || $page == 0) {
        $page1 = 0;
      }
      else{
        $page1 = ($page*25)-25;
      }
      $query = "select * from transactions where userId=:userId "; 
      $sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $excute = $sth->execute(array(':userId' => substr($_SESSION['userId'],3)));
      $count = $sth->rowCount();
      $pagescount = ceil($count/10);
    ?>

<div class="container-fluid" style="padding-top: 90px;padding-bottom: 30px;">
  <div class="row">
    <div class="col-sm-12 payDetails text-center">
    
		<?php
			$query = "select * from transactions where userId=:userId order by dot desc, refNo desc";	
			$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$excute = $sth->execute(array(':userId' => substr($_SESSION['userId'],3)));
			
			if(!$excute){
				echo "<p>Error in connection. Please try again!</p>";
				exit;
			}
			
			$result=$sth->fetchall();
			if(empty($result)){	
				echo "<h4 style='height:200px;'>You don't have any transactions!</h4>";
			}else{
				echo '
				<table class="table">
      <thead>
        <tr>
          <th scope="col">Sr. No</th>
          <th scope="col">Ref. No</th>
          <th scope="col">Date</th>
          <th scope="col">Amount</th>
          <th scope="col">Total balance</th>
          <th scope="col">Debit/Credit</th>
          <th scope="col">Transaction Type</th>
          <th scope="col">Account Statement</th>
        </tr>
      </thead>
      <tbody>';
	  
				#logic to loop over data
				$rowNum = 1;
				foreach($result as $row){
					echo '
						<tr>
							<th scope="row">'.$rowNum.'</th>
							<td>'.$row['refNo'].'</td>
							<td>'.$row['dot'].'</td>
							<td>&#36;'.$row['amount'].'</td>
							<td>&#36;'.$row['balance'].'</td>
							<td>'.$row['transferType'].'</td>
							<td>'.$row['transactionType'];
					
					if($row['transactionType'] == 'transfer')
						echo ' - BIT'.$row['partner'];
					
					echo '	</td>
							<td><a href="#">Click Here</a></td>
						</tr>';
					$rowNum++;
				}
	  
				echo '</tbody></table>';
			}
		?>
      
  </div><!-- end of div col-sm-12 -->
  </div><!--end of div row-->
</div><!--end of div container-fluid-->


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