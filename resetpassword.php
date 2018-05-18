<?php 
#Turn off all error reporting
error_reporting(0);
$sitename= "Bit Plus<sup>+</sup> Market";
include "connect.php" ;
$param = "";
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bit plus Market</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom fonts for this template -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">
    <link href="css/modified.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 


  </head>

  <body id="page-top">

    <!-- Navigation -->
        <!-- Navigation -->
       <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background-color:#212529;">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><?php echo $sitename;?>>> Reset Your Password<sup></sup></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="signup.php">Registration</a>
            </li>
            </li>
             <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="login.php">Log In</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container" style="margin-top:100px">
      <div class="row">
        <div class="col-sm-8 offset-sm-2">

       <form method="post" id="resetForm">
        <div class="form-group row">
          
          <div class="col-sm-6 offset-sm-3">
            <label for="inputusername" class="col-form-label">UserId:</label><br>
            <input type="text" class="form-control" id="username" placeholder="UserID" name="userId" required>
          </div>
        </div>
        <div class="form-group row">
          
          <div class="col-sm-6 offset-sm-3">
            <label for="inputmobileno" class="col-form-label">Mobile Number Linked with the ID:</label><br>
            <input type="text" class="form-control" id="mobileNo" placeholder="Mobile Number" name="applicantContactNo" required>
          </div>
        </div>
		
		<div class="form-group row">
			<div class="col-sm-6 offset-sm-3">
				<div id="successMessage" class="alert alert-success" style="display:none;"></div>
				<div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
			</div>
        </div>
		
        <div class="form-group row">
          <div class="col-sm-10 text-right">
            <button id="resetFormSubmit" type="submit" class="btn btn-primary">Reset Password</button>
          </div>
        </div>
      </form>

        </div>
      </div>
    </div>
  
    <!--footer-->
    <?php include'pages/footer.php';?>
     <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>
  </body>
  <script type="text/javascript">
 $(document).ready(function(){
	$('#resetFormSubmit').click(function(){
		var data = $('#resetForm').serialize();
		var check=$.ajax({
		type:"post",
		url:"resetValidate.php",
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
