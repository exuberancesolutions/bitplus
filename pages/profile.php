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
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'headtag.php'; ?>
</head>

  <body id="page-top">

    <?php include'nav.php'; ?>

  <div class="container-fluid">
    <div class="row" style="padding-top: 25px;padding-bottom: 25px;">
	</div>
		<div class="row">
      <div class="col-sm-8 offset-sm-2">
        <table class="table table-striped">

         <thead>
            <tr>
              <th scope="col">Name:</th>
              <th scope="col"><?php echo $row['applicantName'];?></th>
            </tr>
         </thead>

         <tbody>
            <tr>
              <th scope="col">Username/Id:</th>
              <th scope="col"><?php echo $_SESSION['userId'];?></th>
            </tr>

            <tr>
              <th scope="col">Father's Name:</th>
              <th scope="col"><?php echo $row['applicantFatherName'];?></th>
            </tr>

            <tr>
              <th scope="col">Mother's Name:</th>
              <th scope="col"><?php echo $row['applicantMotherName'];?></th>
            </tr>

            <tr>
              <th scope="col">Gender:</th>
              <th scope="col"><?php echo $row['gender'];?></th>
            </tr>

            <tr>
              <th scope="col">Date Of Birth:</th>
              <th scope="col"><?php echo $row['applicantDOB'];?></th>
            </tr>

            <tr>
              <th scope="col">Address:</th>
              <th scope="col"><?php echo $row['area'].", ".$row['state'].", ".$row['country'];?></th>
            </tr>

            <tr>
              <th scope="col">Email:</th>
              <th scope="col"><?php echo $row['applicantEmail'];?></th>
            </tr>

            <tr>
              <th scope="col">Contact:</th>
              <th scope="col"><?php echo $row['applicantContactNo'];?></th>
             </tr>
         </tbody>
        </table>
      </div> <!--end of div col-sm-8-->
      
    </div> <!--end of div row-->

  </div><!--end of div container -->



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
