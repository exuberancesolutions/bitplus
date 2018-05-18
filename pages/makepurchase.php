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
      <div class="col-sm-12 col-md-12">
        <form method="post" id="searchUserForm">
          <div class="row">
            <div class="col-sm-12 form-group">
              <label for="userid">Please Enter User ID:</label>
              <input type="text" class="form-control" id="useridforsearch" placeholder="User ID" name="userId" required>
              <br>
              <button id="searchUserFormSubmit" type="submit" class="btn btn-primary">SEARCH</button>
            </div>
          </div>
        </form>
      </div>
		<div id="successMessage" class="alert alert-success" style="display:none;"></div>
		<div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
    </div>
			
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <!-- fetch and displaying previous data, before updation -->
        <p>User Name:  <strong id="applicantName"></strong> </p>
        <p>User ID: <strong id="userId"></strong> </p>
        <p>User Father's Name: <strong id="applicantFatherName"></strong> </p>
        <p>User Type: <strong id="admin"></strong> </p>
        <p>User Status: <strong id="active"></strong> </p>
        <p>User Total Purchase <strong id="package"></strong> </p>

      </div>
      <div class="col-sm-12 col-md-6">
        <!--update form for update -->
        <form id="updateUserForm" method="post">

                <!-- Display Data From Table for admin or Member Only
                 if member only add class="memberonlyuser";
                  if admin add class="adminuser"
                 -->
			<input type="hidden" name="userId" id="user" value="">
			<input type="hidden" name="doa" id="doa" value="">
			<label for="memberadmin">User Type: <span style="color: red"> * </span> </label><br>
			<input type="radio" name="admin" value="0"> Member<br>
            <input type="radio" name="admin" value="1">Admin<br><br>
                <!-- Display Data From Table for Account active or not 
                  if dactivated add class="deactivateduser";
                  if activated add class="activateduser"
                -->
            <label for="accountstatus">User Status : <span style="color: red"> * </span> </label><br>
			<input type="radio" name="active" value="1">Activate<br>
            <input type="radio" name="active" value="0">Deactivate<br><br>
            <label for="userId">Purchase Value :</label>
			<input type="text" class="form-control" id="package" placeholder="Purchase Value" name="package" required>
			<br>
			<div id="successMessageU" class="alert alert-success" style="display:none;"></div>
			<div id="errorMessageU" class="alert alert-danger" style="display:none;"></div>
            <button id="updateUserFormSubmit" type="submit" class="btn btn-primary">Update</button>
        </form> 

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
<script type="text/javascript">
 $(document).ready(function(){
	 
 $('#searchUserFormSubmit').click(function(){
	var data = $('#searchUserForm').serialize();
	var check=$.ajax({
	type:"post",
	url:"searchUser.php",
	data:data,
	contentType:"application/x-www-form-urlencoded",
	dataType: "json",
	success: function(responseData, textStatus , jqXHR){
		if(responseData['status'] == "true") {
			$('#successMessage').hide();
			$('#errorMessage').hide();
			$('#applicantName').html(responseData['applicantName']);
			$('#userId').html(responseData['userId']);
			$('#applicantFatherName').html(responseData['applicantFatherName']);
			$('#package').html(responseData['package']);
			$('#active').html(responseData['active']);
			$('#admin').html(responseData['admin']);
			document.getElementById('user').value = responseData['userId'];
			var today = new Date();
			document.getElementById('doa').value = today.toISOString().substr(0, 10);
		}
		else{
			$('#errorMessage').show();
			$('#successMessage').hide();
			$('#errorMessage').html(responseData['message']);
			document.getElementById('user').value = '';
		}
	},
	error:function(textStatus, errorThrown){console.log(errorThrown);}
 });
 return false;
 });
 
  $('#updateUserFormSubmit').click(function(){
	var data = $('#updateUserForm').serialize();
	var check=$.ajax({
	type:"post",
	url:"updateUser.php",
	data:data,
	contentType:"application/x-www-form-urlencoded",
	dataType: "json",
	success: function(responseData, textStatus , jqXHR){
		if(responseData['status'] == "true") {
			$('#successMessageU').show();
			$('#errorMessageU').hide();
			$('#successMessageU').html(responseData['message']);
		}
		else{
			$('#errorMessageU').show();
			$('#successMessageU').hide();
			$('#errorMessageU').html(responseData['message']);
		}
	},
	error:function(textStatus, errorThrown){console.log(errorThrown);}
 });
 return false;
 });
	 
 });//end of document ready
 </script>
</html>
