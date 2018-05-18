<?php
#Turn off all error reporting
error_reporting(0);
session_start();
if(!isset($_SESSION['userId'])){
  header('LOCATION:../login.php');
  exit;
}
include "../connect.php";
$query = "select franchise from balance where userId=:userId";
$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$excute = $sth->execute(array(':userId' => substr($_SESSION['userId'],3)));
        
if($excute){
	$result=$sth->fetchall();
	$row = $result[0];
	$franchise = $row['franchise'];
	
  	if($franchise==null || $franchise==0){
  		$displayfranchise = '<div class="alert alert-danger">
  		Franchise Account Not Activated<br>Or Your balance Is Zero.<br>Please Contact Admin for More Information.
  		</div>';
  	}
    else{
  		$displayfranchise = '<button class="btn btn-success">Franchise Balance: $';
  		$displayfranchise.= $franchise;
  		$displayfranchise.= '</button>';
  	}
}
else{
	$displayfranchise = '<div class="alert alert-danger">Error fetching franchise value. Please try again later.</div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'headtag.php'; ?>
</head>

  <body id="page-top">

    <?php include'nav.php'; ?>

  <div class="container-fluid">
    <div class="row" style="padding-top: 50px;padding-bottom: 20px;">
      <div class="col-sm col-md-4 offset-md-2">
        
        <div class="alert alert-success">
          <strong>User Details</strong><br> <?php echo "Name: ".$_SESSION['applicantName']. "<br>" . "UserId: ". $_SESSION['userId'];?>
      </div>

      </div>
      <div class="col-sm col-md-4">
        <?php echo $displayfranchise;?>
          <br/>
            
            <div id="successMessage" class="alert alert-success" style="display:none;"></div>
            <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
            

        </div>
    </div>

    <div class="row" style="padding-top: 10px;padding-bottom: 50px;"> 
  <div class="col-sm-12 col-md-4 offset-md-2">

      <form method="post" id="activateAccountForm">
        <div class="row">
          <input type="hidden" name="via" id="via" value="<?php echo $_SESSION['userId'];?>">
		  <input type="hidden" name="doa" id="doa" value="">
		  <input type="hidden" name="doe" id="doe" value="">
		  <input type="hidden" name="admin" value="0">
		  <input type="hidden" name="active" value="1">
          <div class="col-sm-12 form-group">
            <label for="userId">User ID :</label>
            <input type="text" class="form-control" id="transferidto" placeholder="User ID" name="userId" required>
			<label for="userId">Purchase Value :</label>
			<input type="text" class="form-control" id="package" placeholder="Purchase Value" name="package" required>
            <br>
          </div>
          <div class="col-sm-12 form-group">
            <button id="activateAccountFormSubmit" type="submit" class="btn btn-primary">Make Purchase</button>
          </div>
        </div>
      </form>


      </div> <!--end of div col-sm-12 col-md-4 -->

      
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
	var today = new Date();
	document.getElementById('doa').value = today.toISOString().substr(0, 10);
 
  $('#activateAccountFormSubmit').click(function(){
	var data = $('#activateAccountForm').serialize();
	var check=$.ajax({
	type:"post",
	url:"activateAccount.php",
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