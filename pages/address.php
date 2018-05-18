<?php 
#Turn off all error reporting
error_reporting(0);
session_start();
if(!isset($_SESSION['userId'])){
	header('LOCATION:../login.php');
	exit;
}
include "../connect.php";
$query = "select area,state,country from user where userId=:userId";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute = $sth->execute(array(':userId' => substr($_SESSION['userId'],3)));
		    
if(!$excute){
	die("Error in connection. Please try again!");
}

$result=$sth->fetchall();
$row = $result[0];
$area = $row['area'];
$state = $row['state'];
$country = $row['country'];
?>
<!DOCTYPE html>
<html lang="en">

  <head>

<?php include 'headtag.php'; ?>

  </head>

  <body id="page-top">

<?php include'nav.php';?>

<div class="container-fluid" style="padding-top: 70px;padding-bottom: 30px;">
  <div class="row">
	<div class="col-sm-12 col-md-6">
		<div class="col-sm-8 offset-sm-2">
			<h5>Current mailing Address :</h5>
			<p><?php echo $row['area'].",<br> ".$row['state'].",<br> ".$row['country'];?></p>
		</div>
    </div>
    <div class="col-sm-12 col-md-6">
      <form method="post" id="addrForm">
      <div class="row">
          <div class="col-sm-8 form-group">
            <label for="address">Update Mailling Address :</label>
            <input type="text" class="form-control" id="orderform" placeholder="House Number / Block Number" name="address1" required>
            <input type="text" class="form-control" id="orderform" placeholder="Address Line 1" name="address2" required>
            <input type="text" class="form-control" id="orderform" placeholder="Locality / Street / Area" name="address3" required>
            <input type="text" class="form-control" id="orderform" placeholder="State / Province" name="state" required><br>

			<div id="successMessage" class=" alert-success" style="display:none;"></div>
			<div id="errorMessage" class=" alert-danger" style="display:none;"></div>
			<br>
            
			<button id="addrFormSubmit" type="submit" class="btn btn-primary">UPDATE</button>
          </div>
        </div>
      </form>
    </div>

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
<script type="text/javascript">
 $(document).ready(function(){
	$('#successMessage').show();
	$('#errorMessage').hide();
	$('#successMessage').html('All feilds are mandatory');
 $('#addrFormSubmit').click(function(){
	var data = $('#addrForm').serialize();
	var check=$.ajax({
	type:"post",
	url:"addressValidate.php",
	data:data,
	contentType:"application/x-www-form-urlencoded",
	dataType: "json",
	success: function(responseData, textStatus , jqXHR){
		if(responseData['status'] == "true") {
			$('#successMessage').show();
			$('#errorMessage').hide();
			$('#successMessage').html(responseData['message']);
		}
		else{
			$('#errorMessage').show();
			$('#successMessage').hide();
			$('#errorMessage').html(responseData['message']);
		}
	},
	error:function(textStatus, errorThrown){console.log(errorThrown);}
 });
 return false;
 });
	 
 });//end of document ready
 </script>
</html>
