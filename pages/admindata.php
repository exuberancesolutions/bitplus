<?php
#Turn off all error reporting
error_reporting(0);
$sitename= "Bit Plus<sup>+</sup> Market";
session_start();
if(!isset($_SESSION['userId']) || $_SESSION['admin']==0){
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

    <?php include'nav.php'; ?>

  <div class="container-fluid">
    <div class="row" style="padding-top: 50px;padding-bottom: 50px;"> 
      <div class="col-sm-10 offset-sm-1">
      </div> <!--end of div col-sm-8-->      
    </div> <!--end of div row-->
    <div class="row">Percent till level 25, edit and update</div>
    <div class="row">ROI,Number of member for income,edit and update</div>
  </div><!--end of div container -->
  <style type="text/css">
    .myclass{
      color:red;
    }
    .mynewclass{
      color: green;
    }
  </style>
  <script>
function changeclass() {

var NAME = document.getElementById("showhide")

NAME.className="invisible"
document.getElementById('showhide').innerHTML = "Wait..";

} 
</script>
  <button id="showhide" class="btn btn-primary" onclick="changeclass();">check</button>

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
