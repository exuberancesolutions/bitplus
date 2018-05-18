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

<div class="container-fluid" style="padding-top: 60px;padding-bottom: 30px;">
  <div class="row">
    <div class="col-sm-12">
      <div class="text-center">
        <p>
          For any information and support please mail us at<br> <a href="mailto:info@btcplusmarket.com">info@bitplusmarket.com</a>  
        </p>
      </div>
  </div><!-- end of div col-sm-12 -->
  <div class="col-sm-10 offset-sm-1">
     <div class="row ">
    <!-- <div class="col-sm-3 col-sm-offset-1">
      <h2>Help/Instruction</h2>
    
    
    </div> -->
    <div class="bg1 col-sm-10 offset-sm-1">
    

    <form method="post" id="regFormSupport">
       <h3>Support</h3>
              <div class="row">
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="UserId"> User ID : <span style="color: red"> *Required </span></label>
          <input type="text" class="form-control" id="orderform" placeholder="User ID" name="userId" required>
          </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-10 offset-sm-1 form-group">
            <label for="address"> Related:</label>
            <select class="form-control" name="related">
             <option value="General">General</option>
             <option value="Website">Website</option>
             <option value="Account">Account</option>
             <option value="Signup">Signup</option>
             <option value="Payment">Payment</option>
             <option value="Change">Change Of Details</option>
            </select>
          </div>
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="address">Details </label>
            <textarea class="form-control" id="details" rows="3"></textarea>
          </div>
        
        </div>
        <button id="regFormSupportSubmit" type="submit" class="btn btn-primary">Submit</button>
        <div class="form-group row">
      <div class="col-sm-6 offset-sm-3">
        <div id="successMessage" class="alert alert-success" style="display:none;"></div>
        <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
      </div>
        </div>
        <div class="row"><hr></div>
    </form>
    </div> <!--end of the the coloum for the sm-6-->
    <div class="col-sm-1"></div>
    
    </div> <!--end of the the row-->

    <hr>
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
  $('#regFormSupportSubmit').click(function(){
    var data = $('#regFormSupport').serialize();
    var check=$.ajax({
    type:"post",
    url:"supportValidate.php",
    data:data,
    contentType:"application/x-www-form-urlencoded",
    dataType: "json",
    success: function(responseData, textStatus , jqXHR){
      console.log(responseData);
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
