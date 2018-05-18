<?php
#Turn off all error reporting
error_reporting(0);
session_start();
if(!isset($_SESSION['userId'])){
	header('LOCATION:../login.php');
	exit;
}
include "../connect.php";
$query = "select * from investment where userId=:userId";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute = $sth->execute(array(':userId' => substr($_SESSION['userId'],3)));
		    
if(!$excute){
	die("Error in connection. Please try again!");
}

$result=$sth->fetchall();
$row = $result[0];
$amount = $row['amount'];
$doa = $row['doa'];
$via = $row['via'];
?>
<!DOCTYPE html>
<html lang="en">

  <head>

<?php include 'headtag.php'; ?>

  </head>

  <body id="page-top">

<?php include'nav.php';?>

<div class="container-fluid" style="padding-top: 90px;padding-bottom: 30px;">
  <div class="row">
    <div class="col-sm-12">
      <div class="text-center">
                <table class="table table-striped">

         <thead>
            <tr>
              <th scope="col">Sr. No</th>
              <th scope="col">Date Of Purchase</th>
              <th scope="col">Made by</th>
              <th scope="col">Value of Purcahse</th>
              <th scope="col">BP</th>
            </tr>
         </thead>

         <tbody>

            <tr>
              <td scope="col">1</td>
              <td scope="col"><?php echo $doa; ?> </td>
              <td scope="col">BIT<?php echo $via; ?></td>
              <td scope="col">&#8377 <?php echo $amount; ?></td>
              <td scope="col"><?php echo $amount/25; ?></td>
            </tr>

         </tbody>
        </table>
      </div>
  </div><!-- end of div col-sm-12 -->
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
