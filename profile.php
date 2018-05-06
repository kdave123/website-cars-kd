<?php 
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require 'db.php';
session_start();

 
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easy take in Variables
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];

}
?>



<html>
   <head> 

             <title>Profile</title>

 
       <link type="text/css" rel="stylesheet" href="stylesheet.css"/>

</head>



<body onload="displaycartpersistant();">

<?php
require 'header.php';
?>

<?php
require 'loginsys.html';

?>

<?php
	require 'leftnavigation.html'
?>


<p class="bodyhead"></p>
	

	
	  <div class="midlistcontent">

          <p class="bodyhead">Profile</p>
           
          
      
          
          <?php
          
          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
              </div>';
          }
          
          ?>
          
          <h2><?php echo $first_name.' '.$last_name; ?></h2>
          <p><?= $email ?></p>
          
          <a href="logout.php"><button class="button" name="logout"/>Log Out</button></a>



    </div>

<div id="footer">
<center>Website by Karan Dave</center>
</div>

</body>
</html>