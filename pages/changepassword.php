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

<div class="container-fluid" style="padding-top: 80px; padding-bottom: 50px;">
  <div class="row">
    <div class="col-sm-8 offset-sm-2">
      <form method="post" id="passForm">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Old Password:</label>
    <div class="col-sm-6">
      <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-4 col-form-label">New Password:</label>
    <div class="col-sm-6">
      <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Confirm Password:</label>
    <div class="col-sm-6">
      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
    </div>
  </div>
  <div class="form-group row text-center">
    <div class="col-sm-12">
		<center>
			<div id="successMessage" class=" alert-success" style="display:none;"></div>
			<div id="errorMessage" class=" alert-danger" style="display:none;"></div>
		</center>
    </div>
  </div>

  <div class="form-group row text-center">
    <div class="col-sm-10">
      <button id="passFormSubmit" type="submit" class="btn btn-primary">Change Password</button>
    </div>
  </div>
</form>
    </div>
</div>
</div>


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
<script type="text/javascript">
 $(document).ready(function(){
	$('#successMessage').show();
	$('#errorMessage').hide();
	$('#successMessage').html('All feilds are mandatory');
 $('#passFormSubmit').click(function(){
	var data = $('#passForm').serialize();
	var check=$.ajax({
	type:"post",
	url:"passwordValidate.php",
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
