<?php 
#Turn off all error reporting
error_reporting(0);
session_start();
if(!isset($_SESSION['userId'])){
	header('LOCATION:../login.php');
	exit;
}
include "../connect.php";
$query = "select * from user where userId=:userId";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute = $sth->execute(array(':userId' => substr($_SESSION['userId'],3)));
		    
if(!$excute){
	die("Error in connection. Please try again!");
}

$result=$sth->fetchall();
$row = $result[0];
$bitcoinLink = $row['bitcoinLink'];
$bankname = $row['nomineeFatherName'];
$bankAccNo = $row['bankAccNo'];
$bankifsc = $row['nomineeMotherName'];
if(strlen($bankAccNo)<1){
  $bankAccNo = '<i>nil</i>';
  $bankname = '<i>nil</i>';
	$bankifsc = '<i>nil</i>';

}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

<?php include 'headtag.php'; ?>

  </head>

  <body id="page-top">

<?php include'nav.php';?>

<div class="container-fluid" style="margin-top: 60px;height: 400px;">
  <div class="row">
    <div class="col-sm-8 offset-sm-2 text-center">
      <h4>Name Of the Bank:</h4>
      <h6 style="background-color: #FEC810;color: white; padding: 5px;"><?php echo $bitcoinLink;?></h6>
      <h4>Name Of the Branch:</h4>
     <h6 style="background-color: #FEC810;color: white; padding: 5px;"><?php echo $bankname;?></h6>
      <h4>Bank Account Number:</h4>
     <h6 style="background-color: #FEC810;color: white; padding: 5px;"><?php echo $bankAccNo;?></h6>
     <h4>Bank IFSC:</h4>
     <h6 style="background-color: #FEC810;color: white; padding: 5px;"><?php echo $bankifsc;?></h6>
    </div> <!--end of div col-sm-8-->
  </div> <!--end of div row-->
</div> <!--end of div container-->


    <!-- Footer -->
<?php include'footer.php';?>




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
