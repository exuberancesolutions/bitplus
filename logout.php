<?php
 session_start();
 $_SESSION = array();
 
 #remove all session variables
 session_unset(); 

 #destroy the session 
 session_destroy();
 ?>
 <meta http-equiv="refresh" content="0;login.php">