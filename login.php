<?php 
#Turn off all error reporting
error_reporting(0);
$sitename= "Bit Plus<sup>+</sup> Market";
include "connect.php" ;
$param = "";
session_start();
if(isset($_SESSION['userId'])){
	header('LOCATION:pages/home.php');//user already logged in
	exit;
}
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
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><?php echo $sitename;?>>>Log In<sup></sup></a>
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
	
	<?php
		if(isset($_POST['userId']) && $_POST['userId'] == 'BIT10001'){
			#if user has entered data for login
			$password = md5($_POST['password']);
			$query = "select u.applicantName,l.admin from login l, user u where l.userId=:userId AND l.password=:password AND u.userId=l.userId";
			$sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$excute = $sth->execute(array(':userId' => substr($_POST['userId'],3), ':password' => $password));
		    
			if(!$excute){
				$param = 'Error in connection. Please try again!';
				addForm($param);
				exit;
			}
    
			$result=$sth->fetchall();
			if(empty($result)){	
				#user has not registered or data is wrong
				$param = 'User Id or password wrong. Please try again!';
				addForm($param);
			}
			else{
				#if login is successful
				$row = $result[0];
				$_SESSION['userId'] = $_POST['userId'];
				$_SESSION['applicantName'] = $row['applicantName'];
				$_SESSION['admin'] = $row['admin'];
			?>
				<meta http-equiv="refresh" content="0;pages/home.php">
			<?php
				} #end of else in which login was successful
    
		}#end of if when the data is entered
		else{
			#if user has visited the login page for the first time		
			$param = 'Sign in to continue. <br><span class="text-danger"><h5> For regular Maintenance the login for member has been stoped for 27-04-2018</h5></span>';
			addForm($param);
		}
	?>

<?php

function addForm($message){
	echo '
    <div class="container" style="padding-top: 180px;">
      <div class="row">
        <div class="col-sm-6 offset-sm-3">
			<form method="post">
				<div class="form-group row">
					<label for="inputusername" class="col-sm-2 col-form-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="username" placeholder="Username" name="userId" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="Password" placeholder="Password" name="password" required>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10 offset-sm-2">
						<center>
							<div class="alert alert-info" id="message">'.$message.'</div>
						</center>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-10 text-right" ">
						<button type="Reset" class="btn btn-primary"> Reset </button>
						<button type="submit" class="btn btn-primary"> Sign in </button>
					</div>
				</div>
			</form>
		</div>
      </div><!--end of div row-->

      <div class="row">
        <div class="col-sm-2 offset-sm-5"><a href="resetpassword.php">Forget password ?</a></div>
      </div><!--end of div row-->

    </div><!--end of div Container--> ';	
}
?>
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
</html>  
