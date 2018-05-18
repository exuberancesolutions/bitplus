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

    <div class="row">
	priduct form
    </div>

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
	 
 $('#userTransactionSubmit').click(function(){
	var data = $('#userTransaction').serialize();
	var check=$.ajax({
	type:"post",
	url:"getTransactions.php",
	data:data,
	contentType:"application/x-www-form-urlencoded",
	dataType: "json",
	success: function(responseData, textStatus , jqXHR){
		if(responseData['status'] == "true") {
			$('#errorMessage').hide();
			$("#transactionTable").show();
			var a = responseData['data'];
			var count = 1;
			for (var key in a) {
				if (a.hasOwnProperty(key)) {
					var val = a[key];
					$("#tableBody").append('<tr><td>'+count+'</td><td>'+val['refNo']+'</td><td>'+val['dot']+'</td><td>'+val['amount']+'</td><td>'+val['balance']+'</td><td>'+val['transferType']+'</td><td>'+val['transactionType']+'</td></tr>');
					count++;
				}
			}					
		}
		else{
			$("#transactionTable").hide();
			$('#errorMessage').show();
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
