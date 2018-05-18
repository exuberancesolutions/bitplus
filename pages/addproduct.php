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

    <div class="row" style="padding-top:20px;">
		<div class="col-sm-8 offset-sm-2">

			<form method="POST" >
			  <div class="form-group row">
			    <label for="producttitle" class="col-sm-4 col-form-label">Product Title</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" id="productTitle" name="productTitle" placeholder="Product Title">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="ProductHeading" class="col-sm-4 col-form-label">Product Heading</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" id="productHeading" name="productHeading" placeholder="Product Heading">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="ProductDetails" class="col-sm-4 col-form-label">Product Details</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" id="prodctHeading" name="productDetails" placeholder="Product Details">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="ProductCategory" class="col-sm-4 col-form-label">Product Category</label>
			    <div class="col-sm-8">
			      <select class="form-control" name="productCategory">
              <option value="nil">Category</option>
              <option value="PC">Personal Care</option>
              <option value="MC">Men's Care</option>
              <option value="HH">Home Hygiene</option>
              <option value="AG">Agriculture</option>
              <option value="BT">Business Tools</option>
            </select>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="Productprice" class="col-sm-4 col-form-label">Product Price</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Price of the product">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="businesspoint" class="col-sm-4 col-form-label">Business Point</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" id="businessPoint" name="businessPoint" placeholder="Business Point">
			    </div>
			  </div>
			  <div class="form-group row">
				<label for="pruductimage" class="col-sm-4 col-form-label">Upload Image Of the Product</label>
				<div class="col-sm-8">
				<input type="file" class="form-control-file" id="ImageProduct">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="productstatus" class="col-sm-4 col-form-label">Product Status</label>
				<div class="col-sm-4">
					<input type="radio" name="active" value="1">Activate
				</div>
				<div class="col-sm-4">
					<input type="radio" name="active" value="0">Deactivate
			  </div>
			  </div>
			  <div class="row">
			  <div class="col-sm-12 text-center">
			  <button id="AddProductFormSubmit" type="submit" class="btn btn-primary" onclick="changeclass();">Add Product</button>
			  </div>
			  </div>
			</form>



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
