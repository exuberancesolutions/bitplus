<?php 
$sitename= "Bit Plus<sup>+</sup> Market";

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>.com</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">
    <link href="css/modified.css" rel="stylesheet">

  </head>

  <body id="page-top" onload="pageLoader()">
    <div id="loader"></div>
    <div id="myDiv">
      

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><?php echo $sitename;?><sup></sup></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Services</a>
            </li>
           <!--  <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#team">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="gallery.php">Gallery</a>
            </li>
             <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="login.php">Log In</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
	<!-- images -->
	<section>
		<div class="container-fluid">
			<div class="row">
				<!-- this section goes foreach loop-->
				<div class="col-sm-3"></div>
			</div>
		</div>
	</section>
	
	<!-- video -->
	<section>
	</section>
	


    <!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text-muted">We would love to hear from you.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name *" required data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email *" required data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message *" required data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <div class="footer-top">
    <div class="container">
      <div class="row">
      <div class="col-md-4 foot-left">
        <h3>About Us</h3>
      
        <p>  We Have Been Trading Since Then Investing, Trading And Paying Our Investors. The Growing Demand Of Cryptocurrencies Bit Plus<sup>+</sup> Market Investment Centre Is Also Increasing Its Investments In Cryptocurrencies In The Form Of Bitcoins. The Company Trades Around The Clock On A 24/7 Basis.</p>
      </div>
      <div class="col-md-4 foot-left">
          <h3>Get In Touch</h3>
          <p></p>
        
            <div class="contact-btm">
              <span class="glyphicon glyphicons-message-empty" aria-hidden="true"></span>
                            <p></p>                
                           
            </div>
            <div class="contact-btm">
              <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                            <p></p>
            <div class="contact-btm">
            </div>
              <span class="fa fa-envelope-o" aria-hidden="true"></span>
              <p>Information<br><a href="mailto:info@bitplusmarket.com">info@bitplusmarket.com</a></p>
            </div>
            <div class="clearfix"></div>

      </div>
      <div class="col-md-4 foot-left">
      <h3>Subscribe</h3>
      <p>your email ID Subscribe here </p>
      <form action="#" id="lettersubscribe" method="post"> 
          <input type="email" Name="Enter Your Email" placeholder="Enter Your Email" required=""><br>
        <button type="submit" class="btn btn-primary">Subscribe</button>
      </form>
      </div>
        <div class="clearfix"></div>
    </div>
  </div>
  </div>

    <footer class="footer-top">
      <div class="container ">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; <?php echo $sitename;?> 2017</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
<!--               <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-linkedin"></i>
                </a>
              </li>
            </ul> -->
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
                <a href="#">Privacy Policy</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Terms of Use</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>
    <script>
var myVar;

function pageLoader() {
    myVar = setTimeout(showPage, 1500);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>
  </body>

</html>
