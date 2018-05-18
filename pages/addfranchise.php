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
    <div class="col-sm-12 col-md-4 offset-md-2 alert alert-warning">
      <form method="post" id="addFranchiseForm">
        <div class="row">
          <div class="col-sm-6 col-md-8 offset-md-1 form-group">
            <label for="userid">User ID:</label>
            <input type="text" class="form-control" id="franchiseUserId" placeholder="User ID" name="userId" required>
            <br>
          </div>
           <div class="col-sm-6 col-md-8 offset-md-1 form-group">
            <label for="Franchise Value">Franchise Value:</label>
            <input type="text" class="form-control" id="franchiseValueId" placeholder="Amount" name="amount" required>
            <br>
          </div>
           <div class="col-sm-6 col-md-8 offset-md-1 form-group">
            <div id="successMessage" class="alert alert-success" style="display:none;"></div>
            <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
            </div>
          <div class="col-sm-6 col-md-8 offset-md-1 form-group">
            <button id="addFranchiseFormSubmit" type="submit" class="btn btn-primary">ADD FRANCHISE</button>
          </div>
        </div>
      </form>


      </div> <!--end of div col-sm-8-->
      <div class="col-sm-12 col-md-4 alert alert-success">
        <h6>User ID: <span id="franchiseId"></span></h6><br>
        <h6>Franchise Value: <span id="franchiseValue"></span></h6><br>
        <br>

      <form method="post" id="getFranchiseForm">
        <div class="row">
          <div class="col-sm-6 col-md-8 offset-md-1 form-group">
            <label for="userid">Franchise ID:</label>
            <input type="text" class="form-control" id="franchiseDetailsUserId" placeholder="Franchise ID" name="userId" required>
          </div>
		  <div class="col-sm-6 col-md-8 offset-md-1 form-group">
            <div id="successMessage1" class="alert alert-success" style="display:none;"></div>
            <div id="errorMessage1" class="alert alert-danger" style="display:none;"></div>
           </div>
          <div class="col-sm-6 col-md-8 offset-md-1 form-group">
            <button id="getFranchiseFormSubmit" type="submit" class="btn btn-primary">Show</button>
          </div>
        </div>
      </form>

      </div>
      
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
	 
 $('#addFranchiseFormSubmit').click(function(){
	var data = $('#addFranchiseForm').serialize();
	var check=$.ajax({
	type:"post",
	url:"addFranchise.php",
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
 
  $('#getFranchiseFormSubmit').click(function(){
	var data = $('#getFranchiseForm').serialize();
	var check=$.ajax({
	type:"post",
	url:"getFranchise.php",
	data:data,
	contentType:"application/x-www-form-urlencoded",
	dataType: "json",
	success: function(responseData, textStatus , jqXHR){
		if(responseData['status'] == "true") {
			$('#successMessage').hide();
			$('#errorMessage').hide();
			$('#successMessage1').hide();
			$('#errorMessage1').hide();
			$('#franchiseValue').html(responseData['franchiseValue']);
			$('#franchiseId').html(responseData['userId']);
		}
		else{
			$('#errorMessage').hide();
			$('#successMessage').hide();
			$('#successMessage1').hide();
			$('#errorMessage1').show();
			$('#errorMessage1').html(responseData['message']);
		}
	},
	error:function(textStatus, errorThrown){console.log(errorThrown);}
 });
 return false;
 });
	 
 });//end of document ready
 </script>
</html>
