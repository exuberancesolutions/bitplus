<?php
#Turn off all error reporting
error_reporting(0);
session_start();
if(!isset($_SESSION['userId'])){
  header('LOCATION:../login.php');
  exit;
}
include "../connect.php";
include "queue.php" ;
$queue = new Queue();
$level = 1;
$queue->enqueue(substr($_SESSION['userId'],3));
$queue->enqueue('level');
$treeid = null;
$previoustree = substr($_SESSION['userId'],3);
$nexttree = substr($_SESSION['userId'],3);
//check whether the more is clicked and then change the value to plus 3 each and then the value of the next three chiled will be chnaged to 
?>
<html>
  <head>
    <?php include'headtag.php';?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      var pd = [];var c1 = [];var c2 = [];var c3 = [];var gc11 = [];var gc12 = [];var gc13 = [];var gc21 = [];var gc22 = [];var gc23 = [];var gc31 = [];var gc32 = [];var gc33 = [];
	  
    </script>
  </head>
  <body>
    <?php include'nav.php'; ?>
    <div class="container-fluid" style="padding-top: 10px;">
     <div class="row">
      <div class="col-md-12">

         <?php 
		// for searching and more
        if(isset($_GET['moreId'])&&!empty($_GET['moreId']))
        {
          $moreIdstrip = $_GET['moreId'];
          $GLOBALS['treeid'] = substr($moreIdstrip,3);
        }
        elseif (isset($_GET['searchId'])&&!empty($_GET['searchId']))
         {
          $searchIdstrip = $_GET['searchId'];
          $GLOBALS['treeid'] = substr($searchIdstrip,3);
        }
        else{
          $GLOBALS['treeid'] = substr($_SESSION['userId'],3);
        }
		// for changing the child to next and previous	
		if(isset($_GET['treechild'])){
			$childlist = $_GET['treechild'];
			$childlistp = $_GET['treechild']-1;
			$childlistn = $_GET['treechild']+1;
			$child1=$childlist*3+1;
			$child2=$childlist*3+2;
			$child3=$childlist*3+3;
			echo $childlistp."<br>";
			echo $childlistn."<br>";
			echo $child1."<br>";
			}
			else{
				$child1=1;$child2=2;$child3=3;
			}
		
        ?>
        <br>
      </div>
    </div>


      <div class="row" style="font-size:13px; padding:0px;">
        <div class="col-md-3 offset-md-2">
          <p class="text-success">
            Name: 
            <span class="text-danger" id="name"></span><br>
            Date Of Active: 
            <span class="text-danger" id="doi"></span>
          </p>
        </div>
        <div class="col-md-3">
          <p class="text-success">
            User Id:
            <span class="text-danger" id="userId"></span><br>
            Date Of Maturity:
            <span class="text-danger" id="dom"></span>
          </p>
        </div>
        <div class="col-md-3">
          <p class="text-success">
            Investment:
            <span class="text-danger" id="investment"></span><br>
            Team Earning:
            <span class="text-danger" id="teamEarning"></span>
          </p>
        </div>

      </div>
<hr>
<hr>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
          <form class="form-inline" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
              <div class="form-group mx-sm-3 mb-2">
                <label for="text" class="sr-only">Search ID</label>
                <input type="text" class="form-control" id="searchId" placeholder="Search Id" name="searchId">
              </div>
                <button type="submit" class="btn btn-primary mb-2">Search</button>
              <div class="form-group mx-sm-3 mb-2">
              <div id="successMessage" class="alert alert-success" style="display:none;">
              </div>
              </div>
          </form>
        </div>
        <div class="col-sm-4 text-primary">
          <h5 id="treemsg">Tree For : <?php echo 'BIT'.$GLOBALS['treeid'];?></h5>
        </div>
      </div>
      <script type="text/javascript">
                function displaydetails(name,userId,doi,investment,teamEarning,dom) 
        {
          document.getElementById("name").innerHTML = name;
          document.getElementById("userId").innerHTML = userId;
          document.getElementById("doi").innerHTML = doi;
          document.getElementById("investment").innerHTML = investment;
          document.getElementById("teamEarning").innerHTML = teamEarning;
          document.getElementById("dom").innerHTML = dom;
        }
      </script>
      <style type="text/css">
        .activegreen{
          color: green;
        }
        .deactivered{
          color: red;
        }
      </style>

      <div class="row">
        <div class="col-md-12">
          <table class="treetable text-center">
             <tr>
              <th colspan="9" >
                <p><span id="parentName"></span><br><span id="parentId"></span></p>
                <i onclick="displaydetails(pd[1],pd[0],pd[4],pd[2],pd[5],pd[3])"; class="fa fa-user" id="parentIcon" aria-hidden="true"></i><br>
                <a href="#">Add Here</a>
              </th>
           </tr>
          <tr>
              <th colspan="3">
                <a style="float:left;color: blue;" href="<?php echo $_SERVER['PHP_SELF'].'?searchId='.'BIT'.$GLOBALS['treeid'].'&treechild='.$childlistp; ?>"><i class="fa fa-arrow-circle-o-left" style="font-size: 20px;color: blue;" aria-hidden="true"></i><br>Previous</a>
                <p><span id="child1Name"></span><br><span id="child1Id"></span></p>
                <i onclick="displaydetails(c1[1],c1[0],c1[4],c1[2],c1[5],c1[3])"; class="fa fa-user" id="child1Icon" aria-hidden="true"></i>
                <br><a href="#">Add Here</a></th>
              </th> 
              <th colspan="3" >
                <p><span id="child2Name"></span><br><span id="child2Id"></span></p>
                <i onclick="displaydetails(c2[1],c2[0],c2[4],c2[2],c2[5],c2[3])"; class="fa fa-user" id="child2Icon" aria-hidden="true"></i>
                <br><a href="#">Add Here</a></th>
              </th>
              <th colspan="3">
                <a style="float: right;color: blue;" href="<?php echo $_SERVER['PHP_SELF'].'?searchId='.'BIT'.$GLOBALS['treeid'].'&treechild='.$childlistn; ?>"><i class="fa fa-arrow-circle-o-right" style="font-size: 20px;color: blue;" aria-hidden="true"></i><br>Next</a>
                <p><span id="child3Name"></span><br><span id="child3Id"></span></p>
                <i  onclick="displaydetails(c3[1],c3[0],c3[4],c3[2],c3[5],c3[3])"; class="fa fa-user" id="child3Icon" aria-hidden="true"></i>
                <br><a href="#">Add Here</a>
                
              </th>
          </tr>
          <tr>

              <th >
                <p><span id="gchild11Name"></span><br><span id="gchild11Id"></span></p>
                <i onclick="displaydetails(gc11[1],gc11[0],gc11[4],gc11[2],gc11[5],gc11[3])"; class="fa fa-user" id="gchild11Icon" aria-hidden="true"></i>
                <br>
                <a href="#">Add Here</a><br>
                <a href="#"><i class="fa fa-arrow-down" aria-hidden="true"> more</i></a>
              </th>


              <th >
                <p><span id="gchild12Name"></span><br><span id="gchild12Id"></span></p>
                <i onclick="displaydetails(gc12[1],gc12[0],gc12[4],gc12[2],gc12[5],gc12[3])"; class="fa fa-user" id="gchild12Icon" aria-hidden="true"></i>
                <br>
                <a href="#">Add Here</a><br>
                <a href="#"><i class="fa fa-arrow-down" aria-hidden="true"> more</i></a>
              </th>
 
              <th >
                <p><span id="gchild13Name"></span><br><span id="gchild13Id"></span></p>
                <i onclick="displaydetails(gc13[1],gc13[0],gc13[4],gc13[2],gc13[5],gc13[3])"; class="fa fa-user" id="gchild13Icon" aria-hidden="true"></i>
                <br>
                <a href="#">Add Here</a><br>
                <a href="#"><i class="fa fa-arrow-down" aria-hidden="true"> more</i></a>
              </th>
  
              <th >
                <p><span id="gchild21Name"></span><br><span id="gchild21Id"></span></p>
                <i onclick="displaydetails(gc21[1],gc21[0],gc21[4],gc21[2],gc21[5],gc21[3])"; class="fa fa-user" id="gchild21Icon" aria-hidden="true"></i>
                <br>
                <a href="#">Add Here</a><br>
                <a href="#"><i class="fa fa-arrow-down" aria-hidden="true"> more</i></a>
              </th>
  
              <th >
                <p><span id="gchild22Name"></span><br><span id="gchild22Id"></span></p>
                <i onclick="displaydetails(gc22[1],gc22[0],gc22[4],gc22[2],gc22[5],gc22[3])"; class="fa fa-user" id="gchild22Icon" aria-hidden="true"></i>
                <br>
                <a href="#">Add Here</a><br>
                <a href="#"><i class="fa fa-arrow-down" aria-hidden="true"> more</i></a>
              </th>
  
              <th >
                <p><span id="gchild23Name"></span><br><span id="gchild23Id"></span></p>
                <i onclick="displaydetails(gc23[1],gc23[0],gc23[4],gc23[2],gc23[5],gc23[3])"; class="fa fa-user" id="gchild23Icon" aria-hidden="true"></i>
                <br>
                <a href="#">Add Here</a><br>
                <a href="#"><i class="fa fa-arrow-down" aria-hidden="true"> more</i></a>
              </th>
                
             <th >
                <p><span id="gchild31Name"></span><br><span id="gchild31Id"></span></p>
                <i onclick="displaydetails(gc31[1],gc31[0],gc31[4],gc31[2],gc31[5],gc31[3])"; class="fa fa-user" id="gchild31Icon" aria-hidden="true"></i>
                <br>
                <a href="#">Add Here</a><br>
                <a href="#"><i class="fa fa-arrow-down" aria-hidden="true"> more</i></a>
              </th>
  
              <th >
                <p><span id="gchild32Name"></span><br><span id="gchild32Id"></span></p>
                <i onclick="displaydetails(gc32[1],gc32[0],gc32[4],gc32[2],gc32[5],gc32[3])"; class="fa fa-user" id="gchild32Icon" aria-hidden="true"></i>
                <br>
                <a href="#">Add Here</a><br>
                <a href="#"><i class="fa fa-arrow-down" aria-hidden="true"> more</i></a>
              </th>
  
              <th >
                <p><span id="gchild33Name"></span><br><span id="gchild33Id"></span></p>
                <i onclick="displaydetails(gc33[1],gc33[0],gc33[4],gc33[2],gc33[5],gc33[3])"; class="fa fa-user" id="gchild33Icon" aria-hidden="true"></i>
                <br>
                <a href="#">Add Here</a><br>
                <a href="#"><i class="fa fa-arrow-down" aria-hidden="true"> more</i></a>
              </th>
  
          </tr>
          </table>
        </div>
      </div>

        <p id="demo"></p>
        
    </div><!-- CONTAINER FLUID END  -->

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
   
  getTree(<?php echo $GLOBALS['treeid']; ?>);//uncomment this and rather call the function after click
  var parent = "";
  function getTree(userId) {
    var dict = {};
    var dict = {
      userId: userId
    };
    var check=$.ajax({
      type:"post",
      url:"getTree.php",
      data:dict,
      contentType:"application/x-www-form-urlencoded",
      dataType: "json",
      success: function(responseData, textStatus , jqXHR){
        console.log(responseData);
        document.getElementById("demo").innerHTML = JSON.stringify(responseData);
        var message = "";

        function changeClass(elementId,newClass) {
          var elementId = elementId;
          var newClass = newClass;
          var NAME = document.getElementById(elementId)
          var classNamefinal = "fa fa-user "+ newClass;
          NAME.className=classNamefinal;
          }

        function checkDefined(data,id)
          {
           if (typeof data !== 'undefined' && typeof data !== null ){
              return true;                                     
            }
            else{
              message+= id+' not Found\n';
            }
          }

        function checkTreeLevel(obj,userId){
          var obj = obj;
          var treeId = userId;
          if(checkDefined(obj[userId],'Parent')){
            message+= "object of parent found\n";
            document.getElementById("parentId").innerHTML = 'BIT'+obj[userId]['info'][0]['userId'];
            pd[0] = 'BIT'+obj[userId]['info'][0][0];
            pd[1] = obj[userId]['info'][0][1];
            pd[2] = '$'+obj[userId]['info'][0][2];
            pd[3] = obj[userId]['info'][0][3];
            pd[4] = obj[userId]['info'][0][4];
            pd[5] = obj[userId]['info'][0][5];
            document.getElementById("parentName").innerHTML = obj[userId]['info'][0]['applicantName'];
             if (!checkDefined(obj[userId]['info'][0]['package']) || JSON.stringify(obj[userId]['info'][0]['package']) == 'null') {
              console.log(obj[userId]['info'][0]['package']);
                 changeClass('parentIcon','deactivered');
             }
             else{
                changeClass('parentIcon','activegreen');
             }
             }
             else{
            message+= "Parent Not Found";
          }

              //for child one
              if(checkDefined(obj[userId][<?php echo $child1; ?>],'Child 1')){
            message+= "object of child1 found\n";
            document.getElementById("child1Id").innerHTML = 'BIT'+obj[userId]['1'];
            var child1 = obj[userId]['1'];
            document.getElementById("child1Name").innerHTML = obj[child1]['info'][0]['applicantName'];
            c1[0] = 'BIT'+obj[child1]['info'][0][0];
            c1[1] = obj[child1]['info'][0][1];
            c1[2] = '$'+obj[child1]['info'][0][2];
            c1[3] = obj[child1]['info'][0][3];
            c1[4] = obj[child1]['info'][0][4];
            c1[5] = obj[child1]['info'][0][5];
             if (!checkDefined(obj[userId]['info'][0]['package']) || JSON.stringify(obj[child1]['info'][0]['package']) == 'null') {
                 changeClass('child1Icon','deactivered');
             }
             else{
                changeClass('child1Icon','activegreen');
             }
             }

             //for second child
              if(checkDefined(obj[userId][2],'Child 2')){
            message+= "object of child2 found\n";
            document.getElementById("child2Id").innerHTML = 'BIT'+obj[userId]['2'];
            var child2 = obj[userId]['2'];
            document.getElementById("child2Name").innerHTML = obj[child2]['info'][0]['applicantName'];
            c2[0] = 'BIT'+obj[child2]['info'][0][0];
            c2[1] = obj[child2]['info'][0][1];
            c2[2] = '$'+obj[child2]['info'][0][2];
            c2[3] = obj[child2]['info'][0][3];
            c2[4] = obj[child2]['info'][0][4];
            c2[5] = obj[child2]['info'][0][5];
             if (!checkDefined(obj[child2]['info'][0]['package']) || JSON.stringify(obj[child2]['info'][0]['package']) == 'null') {
                 changeClass('child2Icon','deactivered');
             }
             else{
                changeClass('child2Icon','activegreen');
             }
             }

             //for child3
               if(checkDefined(obj[userId][3],'Child 3')){
            message+= "object of child3 found \n";
            var child3 = obj[userId]['3'];
            document.getElementById("child3Id").innerHTML = 'BIT'+child3;
            document.getElementById("child3Name").innerHTML = obj[child3]['info'][0]['applicantName'];
            c3[0] = 'BIT'+obj[child3]['info'][0][0];
            c3[1] = obj[child3]['info'][0][1];
            c3[2] = '$'+obj[child3]['info'][0][2];
            c3[3] = obj[child3]['info'][0][3];
            c3[4] = obj[child3]['info'][0][4];
            c3[5] = obj[child3]['info'][0][5];
             if (!checkDefined(obj[child3]['info'][0]['package']) || JSON.stringify(obj[child2]['info'][0]['package']) == 'null') {
                 changeClass('child3Icon','deactivered');
             }
             else{
                changeClass('child3Icon','activegreen');
             }
             }

             //for gchild11
               if(checkDefined(obj[child1][1],'Grand Child 1>1')){
            message+= "object of gchild11 found \n";
            var gchild11 = obj[child1][1];
            document.getElementById("gchild11Id").innerHTML = 'BIT'+gchild11;
            document.getElementById("gchild11Name").innerHTML = obj[gchild11]['info'][0]['applicantName'];
            gc11[0] = 'BIT'+obj[gchild11]['info'][0][0];
            gc11[1] = obj[gchild11]['info'][0][1];
            gc11[2] = '$'+obj[gchild11]['info'][0][2];
            gc11[3] = obj[gchild11]['info'][0][3];
            gc11[4] = obj[gchild11]['info'][0][4];
            gc11[5] = obj[gchild11]['info'][0][5];
             if (!checkDefined(obj[gchild11]['info'][0]['package']) || JSON.stringify(obj[gchild11]['info'][0]['package']) == 'null') {
                 changeClass('gchild11Icon','deactivered');
             }
             else{
                changeClass('gchild11Icon','activegreen');
             }
             }

               //for gchild12
               if(checkDefined(obj[child1][2],'Grand Child 1>2')){
            message+= "object of gchild12 found \n";
            var gchild12 = obj[child1][2];
            document.getElementById("gchild12Id").innerHTML = 'BIT'+gchild12;
            document.getElementById("gchild12Name").innerHTML = obj[gchild12]['info'][0]['applicantName'];
            gc12[0] = 'BIT'+obj[gchild12]['info'][0][0];
            gc12[1] = obj[gchild12]['info'][0][1];
            gc12[2] = '$'+obj[gchild12]['info'][0][2];
            gc12[3] = obj[gchild12]['info'][0][3];
            gc12[4] = obj[gchild12]['info'][0][4];
            gc12[5] = obj[gchild12]['info'][0][5];
             if (!checkDefined(obj[gchild12]['info'][0]['package']) || JSON.stringify(obj[gchild12]['info'][0]['package']) == 'null') {
                 changeClass('gchild12Icon','deactivered');
             }
             else{
                changeClass('gchild12Icon','activegreen');
             }
             }


                    //for gchild13
               if(checkDefined(obj[child1][3],'Grand Child 1>3')){
            message+= "object of gchild13 found \n";
            var gchild13 = obj[child1][3];
            document.getElementById("gchild13Id").innerHTML = 'BIT'+gchild13;
            document.getElementById("gchild13Name").innerHTML = obj[gchild13]['info'][0]['applicantName'];
            gc13[0] = 'BIT'+obj[gchild13]['info'][0][0];
            gc13[1] = obj[gchild13]['info'][0][1];
            gc13[2] = '$'+obj[gchild13]['info'][0][2];
            gc13[3] = obj[gchild13]['info'][0][3];
            gc13[4] = obj[gchild13]['info'][0][4];
            gc13[5] = obj[gchild13]['info'][0][5];
             if (!checkDefined(obj[gchild13]['info'][0]['package']) || JSON.stringify(obj[gchild13]['info'][0]['package']) == 'null') {
                 changeClass('gchild13Icon','deactivered');
             }
             else{
                changeClass('gchild13Icon','activegreen');
             }
             }



              //for gchild21
               if(checkDefined(obj[child2][1],'Grand Child 2>1')){
            message+= "object of gchild11 found \n";
            var gchild21 = obj[child2][1];
            document.getElementById("gchild21Id").innerHTML = 'BIT'+gchild21;
            document.getElementById("gchild21Name").innerHTML = obj[gchild21]['info'][0]['applicantName'];
            gc21[0] = 'BIT'+obj[gchild21]['info'][0][0];
            gc21[1] = obj[gchild21]['info'][0][1];
            gc21[2] = '$'+obj[gchild21]['info'][0][2];
            gc21[3] = obj[gchild21]['info'][0][3];
            gc21[4] = obj[gchild21]['info'][0][4];
            gc21[5] = obj[gchild21]['info'][0][5];
             if (!checkDefined(obj[gchild21]['info'][0]['package']) || JSON.stringify(obj[gchild21]['info'][0]['package']) == 'null') {
                 changeClass('gchild21Icon','deactivered');
             }
             else{
                changeClass('gchild21Icon','activegreen');
             }
             }

               //for gchild22
               if(checkDefined(obj[child2][3],'Grand Child 2>2')){
            message+= "object of gchild12 found \n";
            var gchild22 = obj[child2][3];
            document.getElementById("gchild22Id").innerHTML = 'BIT'+gchild22;
            document.getElementById("gchild22Name").innerHTML = obj[gchild22]['info'][0]['applicantName'];
            gc22[0] = 'BIT'+obj[gchild22]['info'][0][0];
            gc22[1] = obj[gchild22]['info'][0][1];
            gc22[2] = '$'+obj[gchild22]['info'][0][2];
            gc22[3] = obj[gchild22]['info'][0][3];
            gc22[4] = obj[gchild22]['info'][0][4];
            gc22[5] = obj[gchild22]['info'][0][5];
             if (!checkDefined(obj[gchild22]['info'][0]['package']) || JSON.stringify(obj[gchild22]['info'][0]['package']) == 'null') {
                 changeClass('gchild22Icon','deactivered');
             }
             else{
                changeClass('gchild22Icon','activegreen');
             }
             }


                    //for gchild23
               if(checkDefined(obj[child2][4],'Grand Child 2>3')){
            message+= "object of gchild13 found \n";
            var gchild23 = obj[child2][4];
            document.getElementById("gchild23Id").innerHTML = 'BIT'+gchild23;
            document.getElementById("gchild23Name").innerHTML = obj[gchild23]['info'][0]['applicantName'];
            gc23[0] = 'BIT'+obj[gchild23]['info'][0][0];
            gc23[1] = obj[gchild23]['info'][0][1];
            gc23[2] = '$'+obj[gchild23]['info'][0][2];
            gc23[3] = obj[gchild23]['info'][0][3];
            gc23[4] = obj[gchild23]['info'][0][4];
            gc23[5] = obj[gchild23]['info'][0][5];
             if (!checkDefined(obj[gchild23]['info'][0]['package']) || JSON.stringify(obj[gchild23]['info'][0]['package']) == 'null') {
                 changeClass('gchild23Icon','deactivered');
             }
             else{
                changeClass('gchild23Icon','activegreen');
             }
             }


              //for gchild31
               if(checkDefined(obj[child3][1],'Grand Child 3>1')){
            message+= "object of gchild11 found \n";
            var gchild31 = obj[child3][1];
            document.getElementById("gchild31Id").innerHTML = 'BIT'+gchild31;
            document.getElementById("gchild31Name").innerHTML = obj[gchild31]['info'][0]['applicantName'];
            gc31[0] = 'BIT'+obj[gchild31]['info'][0][0];
            gc31[1] = obj[gchild31]['info'][0][1];
            gc31[2] = '$'+obj[gchild31]['info'][0][2];
            gc31[3] = obj[gchild31]['info'][0][3];
            gc31[4] = obj[gchild31]['info'][0][4];
            gc31[5] = obj[gchild31]['info'][0][5];
             if (!checkDefined(obj[gchild31]['info'][0]['package']) || JSON.stringify(obj[gchild31]['info'][0]['package']) == 'null') {
                 changeClass('gchild31Icon','deactivered');
             }
             else{
                changeClass('gchild31Icon','activegreen');
             }
             }

               //for gchild32
               if(checkDefined(obj[child3][3],'Grand Child 3>2')){
            message+= "object of gchild12 found \n";
            var gchild32 = obj[child3][3];
            document.getElementById("gchild32Id").innerHTML = 'BIT'+gchild32;
            document.getElementById("gchild32Name").innerHTML = obj[gchild32]['info'][0]['applicantName'];
            gc32[0] = 'BIT'+obj[gchild32]['info'][0][0];
            gc32[1] = obj[gchild32]['info'][0][1];
            gc32[2] = '$'+obj[gchild32]['info'][0][2];
            gc32[3] = obj[gchild32]['info'][0][3];
            gc32[4] = obj[gchild32]['info'][0][4];
            gc32[5] = obj[gchild32]['info'][0][5];
             if (!checkDefined(obj[gchild32]['info'][0]['package']) || JSON.stringify(obj[gchild32]['info'][0]['package']) == 'null') {
                 changeClass('gchild32Icon','deactivered');
             }
             else{
                changeClass('gchild32Icon','activegreen');
             }
             }


                    //for gchild33
               if(checkDefined(obj[child3][4],'Grand Child 3>3')){
            message+= "object of gchild13 found \n";
            var gchild33 = obj[child3][4];
            document.getElementById("gchild33Id").innerHTML = 'BIT'+gchild33;
            document.getElementById("gchild33Name").innerHTML = obj[gchild33]['info'][0]['applicantName'];
            gc33[0] = 'BIT'+obj[gchild33]['info'][0][0];
            gc33[1] = obj[gchil33]['info'][0][1];
            gc33[2] = '$'+obj[gchild33]['info'][0][2];
            gc33[3] = obj[gchild33]['info'][0][3];
            gc33[4] = obj[gchild33]['info'][0][4];
            gc33[5] = obj[gchild33]['info'][0][5];
             if (!checkDefined(obj[gchild33]['info'][0]['package']) || JSON.stringify(obj[gchild33]['info'][0]['package']) == 'null') {
                 changeClass('gchild33Icon','deactivered');
             }
             else{
                changeClass('gchild33Icon','activegreen');
             }
             }

          console.log(message);
        }

        checkTreeLevel(responseData,userId);
          



      },
      error:function(textStatus, errorThrown){
        console.log(errorThrown);
      }
    });
    return false;
  }

 });//end of document ready
 </script>
</html>