<?php 
#Turn off all error reporting
error_reporting(0);
$sitename= "Bit Plus<sup>+</sup> Market";
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

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background-color:#212529;">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><?php echo $sitename;?>>> UserRegistration<sup></sup></a>
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




<!--Thesection starts from here-->
  <div class="container-fluid" style="background-color:#f0f0f0;">
  
  <div class="row" >
    <div class="col-sm-12">
      <h2 class="text-center">Registration Form/ Sign Up</h2>
    </div>
  </div>
  
  
  
  <div class="row ">
    <!-- <div class="col-sm-3 col-sm-offset-1">
      <h2>Help/Instruction</h2>
    
    
    </div> -->
    <div class="bg1 col-sm-8 offset-sm-2">
    

    <form method="post" id="regForm" role="form">
        <h3>Sponsor Details</h3><br>
        <div class="row">
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="Sponsor Id"> Sponsor ID / Referal Code : <span style="color: red"> * </span></label>
			<?php
				if(isset($_GET['sponsor'])){
					echo '<input type="text" class="form-control" id="orderform" placeholder="Sponsor ID / Referal Code" name="sponsorId" required readonly value="'.$_GET['sponsor'].'">';
				}else{
					echo '<input type="text" class="form-control" id="orderform" placeholder="Sponsor ID / Referal Code" name="sponsorId" required>';
				}
			?>
          </div>
        </div>
        <h3>Personal Details</h3>
        <div class="row">
          
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="name">Applicant Name : <span style="color: red"> * </span> </label>
            <input type="text" class="form-control" id="orderform" placeholder="Applicant Name" name="applicantName" required>
          </div>
        </div>

        <div class="row">
        <div class="col-sm-10 offset-sm-1 form-group">
          <label for="email address">Father's / Husband Name of the applicant : <span style="color: red"> * </span> </label>
          <input type="text" class="form-control" id="orderform" placeholder="Father's / Husband Name" name="applicantFatherName" required>
        </div>
        <div class="col-sm-10 offset-sm-1 form-group">
          <!-- <label for="email address">Mother's Name of the applicant : <span style="color: red"> * </span>  </label> -->
          <input type="hidden" class="form-control" id="orderform" placeholder="Mother's Name" name="applicantMotherName" value="unknown" required>
        </div>
        <div class="col-sm-10 offset-sm-1 form-group">
          <label for="email address">Gender : <span style="color: red"> * </span> </label><br>
          <input type="radio" name="gender" value="male" checked> Male<br>
            <input type="radio" name="gender" value="female"> Female<br>
            <input type="radio" name="gender" value="other"> Other 
        </div>

        <div class="col-sm-10 offset-sm-1 form-group">
            <label for="promocode">Date Of Birth : <span style="color: red"> * </span> </label>
            <input type="date" class="form-control" id="orderform" placeholder="dd/mm/yyyy" name="applicantDOB" required>
          </div>
        <div class="col-sm-10 offset-sm-1 form-group">
            <label for="promocode">Marital Status : <span style="color: red"> * </span> </label>
            <select class="form-control" name="maritalStatus">
             <option value="UN">Unmarried</option>
             <option value="M">Married</option>
            </select>
        </div>



        </div>
        <h3>Contact Details</h3>
        <div class="row">
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="address">Mailling Address : <span style="color: red"> * </span> </label>
            <input type="text" class="form-control" id="orderform" placeholder="House Number / Block Number" name="address1" required>
            <input type="hidden" class="form-control" id="orderform" placeholder="Address Line 1" name="address2" value="Unknown" required>
            <input type="hidden" class="form-control" id="orderform" placeholder="Locality / Street / Area" name="address3" value="Unknow" required>
            <input type="hidden" class="form-control" id="orderform" placeholder="State / Province" name="state" value="unknown" required>

            <select class="form-control" name="country">
              <option value="nil">Country</option>
              <option value="AFG">Afghanistan</option>
              <option value="ALA">Åland Islands</option>
              <option value="ALB">Albania</option>
              <option value="DZA">Algeria</option>
              <option value="ASM">American Samoa</option>
              <option value="AND">Andorra</option>
              <option value="AGO">Angola</option>
              <option value="AIA">Anguilla</option>
              <option value="ATA">Antarctica</option>
              <option value="ATG">Antigua and Barbuda</option>
              <option value="ARG">Argentina</option>
              <option value="ARM">Armenia</option>
              <option value="ABW">Aruba</option>
              <option value="AUS">Australia</option>
              <option value="AUT">Austria</option>
              <option value="AZE">Azerbaijan</option>
              <option value="BHS">Bahamas</option>
              <option value="BHR">Bahrain</option>
              <option value="BGD">Bangladesh</option>
              <option value="BRB">Barbados</option>
              <option value="BLR">Belarus</option>
              <option value="BEL">Belgium</option>
              <option value="BLZ">Belize</option>
              <option value="BEN">Benin</option>
              <option value="BMU">Bermuda</option>
              <option value="BTN">Bhutan</option>
              <option value="BOL">Bolivia, Plurinational State of</option>
              <option value="BES">Bonaire, Sint Eustatius and Saba</option>
              <option value="BIH">Bosnia and Herzegovina</option>
              <option value="BWA">Botswana</option>
              <option value="BVT">Bouvet Island</option>
              <option value="BRA">Brazil</option>
              <option value="IOT">British Indian Ocean Territory</option>
              <option value="BRN">Brunei Darussalam</option>
              <option value="BGR">Bulgaria</option>
              <option value="BFA">Burkina Faso</option>
              <option value="BDI">Burundi</option>
              <option value="KHM">Cambodia</option>
              <option value="CMR">Cameroon</option>
              <option value="CAN">Canada</option>
              <option value="CPV">Cape Verde</option>
              <option value="CYM">Cayman Islands</option>
              <option value="CAF">Central African Republic</option>
              <option value="TCD">Chad</option>
              <option value="CHL">Chile</option>
              <option value="CHN">China</option>
              <option value="CXR">Christmas Island</option>
              <option value="CCK">Cocos (Keeling) Islands</option>
              <option value="COL">Colombia</option>
              <option value="COM">Comoros</option>
              <option value="COG">Congo</option>
              <option value="COD">Congo, the Democratic Republic of the</option>
              <option value="COK">Cook Islands</option>
              <option value="CRI">Costa Rica</option>
              <option value="CIV">Côte d'Ivoire</option>
              <option value="HRV">Croatia</option>
              <option value="CUB">Cuba</option>
              <option value="CUW">Curaçao</option>
              <option value="CYP">Cyprus</option>
              <option value="CZE">Czech Republic</option>
              <option value="DNK">Denmark</option>
              <option value="DJI">Djibouti</option>
              <option value="DMA">Dominica</option>
              <option value="DOM">Dominican Republic</option>
              <option value="ECU">Ecuador</option>
              <option value="EGY">Egypt</option>
              <option value="SLV">El Salvador</option>
              <option value="GNQ">Equatorial Guinea</option>
              <option value="ERI">Eritrea</option>
              <option value="EST">Estonia</option>
              <option value="ETH">Ethiopia</option>
              <option value="FLK">Falkland Islands (Malvinas)</option>
              <option value="FRO">Faroe Islands</option>
              <option value="FJI">Fiji</option>
              <option value="FIN">Finland</option>
              <option value="FRA">France</option>
              <option value="GUF">French Guiana</option>
              <option value="PYF">French Polynesia</option>
              <option value="ATF">French Southern Territories</option>
              <option value="GAB">Gabon</option>
              <option value="GMB">Gambia</option>
              <option value="GEO">Georgia</option>
              <option value="DEU">Germany</option>
              <option value="GHA">Ghana</option>
              <option value="GIB">Gibraltar</option>
              <option value="GRC">Greece</option>
              <option value="GRL">Greenland</option>
              <option value="GRD">Grenada</option>
              <option value="GLP">Guadeloupe</option>
              <option value="GUM">Guam</option>
              <option value="GTM">Guatemala</option>
              <option value="GGY">Guernsey</option>
              <option value="GIN">Guinea</option>
              <option value="GNB">Guinea-Bissau</option>
              <option value="GUY">Guyana</option>
              <option value="HTI">Haiti</option>
              <option value="HMD">Heard Island and McDonald Islands</option>
              <option value="VAT">Holy See (Vatican City State)</option>
              <option value="HND">Honduras</option>
              <option value="HKG">Hong Kong</option>
              <option value="HUN">Hungary</option>
              <option value="ISL">Iceland</option>
              <option value="IND">India</option>
              <option value="IDN">Indonesia</option>
              <option value="IRN">Iran, Islamic Republic of</option>
              <option value="IRQ">Iraq</option>
              <option value="IRL">Ireland</option>
              <option value="IMN">Isle of Man</option>
              <option value="ISR">Israel</option>
              <option value="ITA">Italy</option>
              <option value="JAM">Jamaica</option>
              <option value="JPN">Japan</option>
              <option value="JEY">Jersey</option>
              <option value="JOR">Jordan</option>
              <option value="KAZ">Kazakhstan</option>
              <option value="KEN">Kenya</option>
              <option value="KIR">Kiribati</option>
              <option value="PRK">Korea, Democratic People's Republic of</option>
              <option value="KOR">Korea, Republic of</option>
              <option value="KWT">Kuwait</option>
              <option value="KGZ">Kyrgyzstan</option>
              <option value="LAO">Lao People's Democratic Republic</option>
              <option value="LVA">Latvia</option>
              <option value="LBN">Lebanon</option>
              <option value="LSO">Lesotho</option>
              <option value="LBR">Liberia</option>
              <option value="LBY">Libya</option>
              <option value="LIE">Liechtenstein</option>
              <option value="LTU">Lithuania</option>
              <option value="LUX">Luxembourg</option>
              <option value="MAC">Macao</option>
              <option value="MKD">Macedonia, the former Yugoslav Republic of</option>
              <option value="MDG">Madagascar</option>
              <option value="MWI">Malawi</option>
              <option value="MYS">Malaysia</option>
              <option value="MDV">Maldives</option>
              <option value="MLI">Mali</option>
              <option value="MLT">Malta</option>
              <option value="MHL">Marshall Islands</option>
              <option value="MTQ">Martinique</option>
              <option value="MRT">Mauritania</option>
              <option value="MUS">Mauritius</option>
              <option value="MYT">Mayotte</option>
              <option value="MEX">Mexico</option>
              <option value="FSM">Micronesia, Federated States of</option>
              <option value="MDA">Moldova, Republic of</option>
              <option value="MCO">Monaco</option>
              <option value="MNG">Mongolia</option>
              <option value="MNE">Montenegro</option>
              <option value="MSR">Montserrat</option>
              <option value="MAR">Morocco</option>
              <option value="MOZ">Mozambique</option>
              <option value="MMR">Myanmar</option>
              <option value="NAM">Namibia</option>
              <option value="NRU">Nauru</option>
              <option value="NPL">Nepal</option>
              <option value="NLD">Netherlands</option>
              <option value="NCL">New Caledonia</option>
              <option value="NZL">New Zealand</option>
              <option value="NIC">Nicaragua</option>
              <option value="NER">Niger</option>
              <option value="NGA">Nigeria</option>
              <option value="NIU">Niue</option>
              <option value="NFK">Norfolk Island</option>
              <option value="MNP">Northern Mariana Islands</option>
              <option value="NOR">Norway</option>
              <option value="OMN">Oman</option>
              <option value="PAK">Pakistan</option>
              <option value="PLW">Palau</option>
              <option value="PSE">Palestinian Territory, Occupied</option>
              <option value="PAN">Panama</option>
              <option value="PNG">Papua New Guinea</option>
              <option value="PRY">Paraguay</option>
              <option value="PER">Peru</option>
              <option value="PHL">Philippines</option>
              <option value="PCN">Pitcairn</option>
              <option value="POL">Poland</option>
              <option value="PRT">Portugal</option>
              <option value="PRI">Puerto Rico</option>
              <option value="QAT">Qatar</option>
              <option value="REU">Réunion</option>
              <option value="ROU">Romania</option>
              <option value="RUS">Russian Federation</option>
              <option value="RWA">Rwanda</option>
              <option value="BLM">Saint Barthélemy</option>
              <option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
              <option value="KNA">Saint Kitts and Nevis</option>
              <option value="LCA">Saint Lucia</option>
              <option value="MAF">Saint Martin (French part)</option>
              <option value="SPM">Saint Pierre and Miquelon</option>
              <option value="VCT">Saint Vincent and the Grenadines</option>
              <option value="WSM">Samoa</option>
              <option value="SMR">San Marino</option>
              <option value="STP">Sao Tome and Principe</option>
              <option value="SAU">Saudi Arabia</option>
              <option value="SEN">Senegal</option>
              <option value="SRB">Serbia</option>
              <option value="SYC">Seychelles</option>
              <option value="SLE">Sierra Leone</option>
              <option value="SGP">Singapore</option>
              <option value="SXM">Sint Maarten (Dutch part)</option>
              <option value="SVK">Slovakia</option>
              <option value="SVN">Slovenia</option>
              <option value="SLB">Solomon Islands</option>
              <option value="SOM">Somalia</option>
              <option value="ZAF">South Africa</option>
              <option value="SGS">South Georgia and the South Sandwich Islands</option>
              <option value="SSD">South Sudan</option>
              <option value="ESP">Spain</option>
              <option value="LKA">Sri Lanka</option>
              <option value="SDN">Sudan</option>
              <option value="SUR">Suriname</option>
              <option value="SJM">Svalbard and Jan Mayen</option>
              <option value="SWZ">Swaziland</option>
              <option value="SWE">Sweden</option>
              <option value="CHE">Switzerland</option>
              <option value="SYR">Syrian Arab Republic</option>
              <option value="TWN">Taiwan, Province of China</option>
              <option value="TJK">Tajikistan</option>
              <option value="TZA">Tanzania, United Republic of</option>
              <option value="THA">Thailand</option>
              <option value="TLS">Timor-Leste</option>
              <option value="TGO">Togo</option>
              <option value="TKL">Tokelau</option>
              <option value="TON">Tonga</option>
              <option value="TTO">Trinidad and Tobago</option>
              <option value="TUN">Tunisia</option>
              <option value="TUR">Turkey</option>
              <option value="TKM">Turkmenistan</option>
              <option value="TCA">Turks and Caicos Islands</option>
              <option value="TUV">Tuvalu</option>
              <option value="UGA">Uganda</option>
              <option value="UKR">Ukraine</option>
              <option value="ARE">United Arab Emirates</option>
              <option value="GBR">United Kingdom</option>
              <option value="USA">United States</option>
              <option value="UMI">United States Minor Outlying Islands</option>
              <option value="URY">Uruguay</option>
              <option value="UZB">Uzbekistan</option>
              <option value="VUT">Vanuatu</option>
              <option value="VEN">Venezuela, Bolivarian Republic of</option>
              <option value="VNM">Viet Nam</option>
              <option value="VGB">Virgin Islands, British</option>
              <option value="VIR">Virgin Islands, U.S.</option>
              <option value="WLF">Wallis and Futuna</option>
              <option value="ESH">Western Sahara</option>
              <option value="YEM">Yemen</option>
              <option value="ZMB">Zambia</option>
              <option value="ZWE">Zimbabwe</option>
            </select>

            
          </div>
        </div>

        <div class="row">
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="email address">Email Address : <span style="color: red"> * </span> </label>
            <input type="email" class="form-control" id="orderform" placeholder="Email Address" name="applicantEmail" required>
          </div>
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="email address">Contact Number : <span style="color: red"> * </span> </label>
            <input type="text" class="form-control" id="orderform" placeholder="9876543210" name="applicantContactNo" required>
          </div>
          
        </div>
        <h3>Payment Details</h3>
        <div class="row">
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="address"> Name of tha bank : <span style="color: red"> * </span></label>
            <input type="text" class="form-control" id="orderform" placeholder="Name of tha bank" name="bitcoinLink" required>
          </div>
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="address">Name of the Branch : <span style="color: red"> * </span> </label>
            <input type="text" class="form-control" id="orderform" placeholder="Name Of the Branch" name="nomineeFatherName" required>
          </div>
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="address"> Bank Account Number : </label>
            <input type="text" class="form-control" id="orderform" placeholder="Bank Account Number " name="bankAccNo">
          </div>
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="address">IFSC : <span style="color: red"> * </span> </label>
            <input type="text" class="form-control" id="orderform" placeholder="IFSC" name="nomineeMotherName" required>
          </div>
        </div>
        <h3>Nominee Details</h3>
        <div class="row">
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="address">Nominee Name: <span style="color: red"> * </span> </label>
            <input type="text" class="form-control" id="orderform" placeholder="Nominee Name" name="nomineeName" required>
          </div>
          <div class="col-sm-10 offset-sm-1 form-group">
            <label for="address"> Relation with the Applicant : <span style="color: red"> * </span> </label>
            <select class="form-control" name="relation">
             <option value="father">Father of the Applicant</option>
             <option value="mother">Mother of the Applicant</option>
             <option value="husband">Husband of the Applicant</option>
             <option value="wife">Wife of the Applicant</option>
             <option value="son">Son of the Applicant</option>
             <option value="daughter">Daughter of the Applicant</option>
             <option value="brother">Brother of the Applicant</option>
             <option value="sister">Sister of the Applicant</option>
             <option value="father-in-law">Father-in-law of the Applicant</option>
             <option value="mother-in-law">Mother-in-law of the Applicant</option>
             <option value="brother-in-law">Brother-in-law of the Applicant</option>
             <option value="sister-in-law">Sister-in-law of the Applicant</option>
             <option value="uncle">Uncle of the Applicant</option>
             <option value="aunt">Aunt of the Applicant</option>
             <option value="other">Other</option>
            </select>
          </div>
		  <input type="hidden" name="doj" id="doj" value="">
        </div>
        
        <h3>Declaration  </h3>
        <div class="row">
          <div class="col-sm-10 offset-sm-1 form-group">
            
            <input type="checkbox" name="termsAndCondition" value="yes" required>
              I agree to the terms and conditions.<a href="tnc.html" target="_blank"> Click here to see the Terms and Conditions</a> <span style="color: red"> * </span><br>
          </div>
	  <br><br>
		<div id="successMessage" class="alert alert-success" style="display:none;"></div>
		<div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
	  <br><br>
        </div>
          <script>
          function changeclass() {

          var NAME = document.getElementById("regFormSubmit")

          NAME.className="invisible"
          document.getElementById('showhide').innerHTML = "Wait..";

          } 
          </script>
        <button id="regFormSubmit" type="submit" class="btn btn-primary" onclick="changeclass();">Submit</button>
        <div class="row"><hr></div>
    </form>
    <p style="color: red">* all are Required Field</p>
    
    </div> <!--end of the the coloum for the sm-6-->
    <div class="col-sm-1"></div>
    
    </div> <!--end of the the row-->
    <hr>
  
  
  </div><!--end of the container fluid-->


  </body>
   <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>
   <script type="text/javascript">
 $(document).ready(function(){
	 
  var today = new Date();
  document.getElementById('doj').value = today.toISOString().substr(0, 10);

 $('#regFormSubmit').click(function(){
	var data = $('#regForm').serialize();
	var check=$.ajax({
	type:"post",
	url:"signupValidate.php",
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
