<?php 
#Turn off all error reporting
error_reporting(0);
$sitename= "Bit Plus<sup>+</sup> Market";
session_start();
?>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"><?php echo $sitename;?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link btn btn-outline-info" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle btn btn-outline-info" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dashboard
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="mypurchase.php">My Purchase</a>
          <a class="dropdown-item" href="myearning.php">My Earning</a>
          <a class="dropdown-item" href="myteam.php">My Team</a>
          <a class="dropdown-item" href="mytree.php">My Tree</a>
		  <a class="dropdown-item" href="franchise.php">Franchise</a>
		   <a class="dropdown-item" href="productlist.php">Product List</a>
        </div>
      </li>
       <?php
		if($_SESSION['admin']==1)
			include "adminnav.php";
	   ?>
    </ul>
    <ul class="navbar-nav navbar-right">
      <li style="padding-top:12px;">Welcome: <?php echo $_SESSION['applicantName'];?></li>
	  <li><img src="../img/team/1.jpg" height="40px";width="30px"></li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle btn btn-outline-info" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo " --(".$_SESSION['userId'].")--";?>
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="profile.php">Profile</a>
          <a class="dropdown-item" href="mybank.php">Bank Details</a>
          <a class="dropdown-item" href="address.php">Address</a>
          <a class="dropdown-item" href="changepassword.php">Change Password</a>
          <a class="dropdown-item" href="updatekyc.php">Update KYC</a>
          <a class="dropdown-item" href="support.php">Account Support</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>