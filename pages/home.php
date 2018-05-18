<?php
#Turn off all error reporting
error_reporting(0);
session_start();
if(!isset($_SESSION['userId'])){
	header('LOCATION:../login.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

<?php include 'headtag.php'; ?>

  </head>

  <body id="page-top">

<?php include'nav.php';?>


  <div class="container-fluid">
    <br>
    <div class="row">
	
		<!--pagination, for 16 products per page-->
		<!--start foreach loop-->
		<div class="col-sm-3">
			<div class="card ">
				<div class="card-header text-center">
				name of the product
				</div>
			<div class="card-body">
				<h5 class="card-title">Image</h5>
				<p class="card-text">description</p>
			</div>
			<div class="card-footer text-muted">
				Price
			</div>
			</div>
		</div>
		
		<!--end foreach loop-->
		
        </div> <!--end of row--> 
    </div><!--end of container-->
    





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
