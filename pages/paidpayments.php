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
    <?php 
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      }
      else{
        $page = 1;
      }
      if ($page == " " || $page == 1 || $page == 0) {
        $page1 = 0;
      }
      else{
        $page1 = ($page*10)-10;
      }
      $query = "select * from transactions where transactionType = 'Withdrawal' AND transactionStatus = '1' "; 
      $sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $excute = $sth->execute();
      $count = $sth->rowCount();
      $pagescount = ceil($count/10);
    ?>

  <div class="container-fluid">
    <div class="row" style="padding-top: 50px;padding-bottom: 50px;"> 
      <div class="col-sm-12">
        <div id="successMessage" class="alert alert-success" style="display:none;"></div>
            <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
        <table class="table table-striped" style="font-size: 8px;">
            <?php
      $query = "select * from transactions where transactionType = 'Withdrawal' AND transactionStatus = '1' order by dot desc, userId desc LIMIT :page1,10"; 
      //change the limit value with variable $page1
      $sth = $dbh->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth->bindParam(':page1', $page1, PDO::PARAM_INT);
      $excute = $sth->execute();
      
      if(!$excute){
        echo "<p>Error in connection. Please try again!</p>";
        exit;
      }
      
      $result=$sth->fetchall();
      if(empty($result)){ 
        echo "<h4 style='height:300px'>You don't have any Payment Pending!</h4>";
      }else{
        echo '
        <table class="table" style="font-size: 14px;">
      <thead>
        <tr>
          <th scope="col">Sr. No</th>
          <th scope="col">Transaction ID:</th>
          <th scope="col">Date:</th>
          <th scope="col">User ID:</th>
          <th scope="col">Name:</th>
          <th scope="col">Bit Address:</th>
          <th scope="col">Amount</th>        
          <th scope="col">Status</th>        
          <th scope="col">Pay</th> 
        </tr>
      </thead>
      <tbody>';

              #logic to loop over data
        $rowNum = 1 + $page1;
        $numrowid = 1;
        foreach($result as $row){
          $userId = $row['userId'];
          // for fetching data for the respected user
          $query1 = "select applicantName,bitcoinLink from user where userId=:userId";
          $sth1 = $dbh->prepare($query1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $excute1 = $sth1->execute(array(':userId' => $userId));
        
          if(!$excute1){
          die("Error in connection. Please try again!");
          }

          $result1=$sth1->fetchall();
          $row1 = $result1[0];
          $bitlink = $row1['bitcoinLink'];
          $name = $row1['applicantName'];

          echo '
          <form method="post" id="getTransaction'.$numrowid.'">
            <input type="hidden" name="transactionNo" id="transactionId" value="'.$row['refNo'].'">
            <input type="hidden" name="userId" id="useridId" value="'.$row['userId'].'">
            <input type="hidden" name="amount" id="amountId" value="'.$row['amount'].'">
            <tr>
            <th scope="row">'.$rowNum.'</th>
              <td>'.$row['refNo'].'</td>
              <td>'.$row['dot'].'</td>
              <td>BIT'.$row['userId'].'</td>
              <td>'.$name.'</td>
              <td>'.$bitlink.'</td>
              <td>$'.$row['amount'].'</td>';

            if($row['transactionStatus']== 0){
            echo '
            <td>PENDING</td>
            <td><button type ="submit" id="postTransactionNo'.$numrowid.'" class="btn btn-warning" onclick="messageConfirm(';

            echo $row['userId'].','.$row['amount'].
            ');">PAY</button></td>';}
          elseif ($row['transactionStatus']== 1) {
            echo '
            <td>PAID</td>
            <td><button class="btn btn-success disabled">PAID</button></td>
            ';
          }
          $rowNum++;
          $numrowid++;
          echo '</form>';          
        }

        echo '</tr>
        </tbody>
        </table>';
      }
    ?>
      </div> <!--end of div col-sm-8-->
    </div> <!--end of div row-->
    <div class="row">
      <div class="col-sm-6 offset-sm-3">
        <?php 
        echo '<nav aria-label="Page navigation example ">
      <ul class="pagination">';
          if($pagescount<=1){
            echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
          }
          else{

            echo '<li class="page-item"><a class="page-link" href="#">Previous</a></li>';
          for ($i=1; $i <= $pagescount ; $i++) { 
           echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
          }

          echo '<li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
          </nav>';
        }
        ?>
        
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
    <script type="text/javascript">
      function messageConfirm(userId,amount){
        var amount = amount;
        var userId = userId;
        alert('You want to confirm the payment of amount $' +amount+ ' to User Id BIT'+userId);
      }
 $(document).ready(function(){
<?php for ($i=1; $i <= 10 ; $i++) {

echo
  '$("#postTransactionNo'.$i.'").click(function(){
  var data = $("#getTransaction'.$i.'").serialize();
  var check=$.ajax({
  type:"post",
  url:"updateTransactionDetails.php",
  data:data,
  contentType:"application/x-www-form-urlencoded",
  dataType: "json",
  success: function(responseData, textStatus , jqXHR){
    if(responseData["status"] == "true") {
      $("#successMessage").show();
      $("#errorMessage").hide();
      $("#successMessage").html(responseData["message"]);
    }
    else{
      $("#errorMessage").show();
      $("#successMessage").hide();
      $("#errorMessage").html(responseData["message"]);
    }
  },
  error:function(textStatus, errorThrown){console.log(errorThrown);}
 });
 return false;
 });'; 
}
?>

 });//end of document ready
 </script>

  </body>

</html>
