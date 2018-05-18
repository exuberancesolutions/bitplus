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

      <div class="col-sm-12 col-md-6">
      <form method="post" id="userTransaction">
        <div class="row">
           <div class="col-sm-6 col-md-6 offset-md-1 form-group">
            <label for="userId">User ID :</label>
            <input type="text" class="form-control" id="userIdTransaction" placeholder="User ID" name="userId" required>
            <br>
            <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
            <button id="userTransactionSubmit" type="submit" class="btn btn-primary">Show Transaction</button>
          </div>
        </div>
      </form>


      </div> <!--end of div col-sm-8-->
      
    </div> <!--end of div row-->

    <div class="row">
      <div class="col-sm-12 col-md-12">
        <table class="table" id="transactionTable" style="display:none;">
			<thead>
				<tr>
				<th scope="col">Sr. No</th>
				<th scope="col">ref. No</th>
				<th scope="col">Date</th>
				<th scope="col">Amount</th>
				<th scope="col">Total Balance</th>
				<th scope="col">Debit/Credit</th>
				<th scope="col">Transaction Type</th>
				</tr>
			</thead>
			<tbody id="tableBody">
				<!-- foreach loop for last 30 transaction for the defined user,fetch from table and display -->
				
				<!-- end of foreach loop -->
			</tbody>
		</table>
      </div>
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
