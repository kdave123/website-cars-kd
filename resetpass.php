<?php 
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require 'db.php';
session_start();

// Make sure email and hash variables aren't empty
if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{
    $email = $mysqli->escape_string($_GET['email']); 
    $hash = $mysqli->escape_string($_GET['hash']); 

    // Make sure user email with matching hash exist
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "You have entered invalid URL for password reset!";
        header("location: error.php");
    }
}
else {
    $_SESSION['message'] = "Sorry, verification failed, try again!";
    header("location: error.php");  

}
if (!empty($_GET['doaction']) && $_GET['doaction'] == "passchanged" ){
echo '<script>alert("Password resetted sucessfully");</script>';
}
?>
<!DOCTYPE>
<html>
   <head> 
   <meta charset="UTF-8">
             <title>Reset Password</title>

 
       <link type="text/css" rel="stylesheet" href="stylesheet.css"/>

</head>



<body>
    <div id="header">
    <img id="Head" class="hli"src="IMG/logo2.jpg"/>



	<ul id="hul">
                 
                <li class="hli"><a href="Support.php">SUPPORT</a></li>
                <li class="hli"><a href="cars.php">CARS</a></li>    
                <li class="hli"><a href="Home.php"><span id="spanheader">HOME </span></a></li>         
                <li class="hli"><a href="About us.php">ABOUT US</a></li>
                <li class="hli"><a href="Contact us.php">CONTACT US</a></li> 
         </ul>


<!-- <p id="Head">Cars Empire</p> -->


</div>


<div id="left">

   <ul>
       <li id="lihead"><a href="cars.php" class="linav">CARS</a></li>
       <li class="li"><a href="suv.php"  class="linav">SUV</a></li>
       <li class="li"><a href="luxury.php"  class="linav">Luxury</a></li>
       <li class="li"><a href="sedan.php"  class="linav">Sedan</a></li>
       <li class="li"><a href="hatch-back.php"  class="linav">Hatch-Back</a></li>
        <li class="li"><a href="Accessories.php" class="linav">Accessories</a></li>
   </ul> 
     
</div>


<p class="bodyhead"></p>
	

	
	  <div class="midlistcontent">

          <p class="bodyhead">Choose Your New Password</p>
          
          <form action="reset_password.php" method="post">
              
<pre>New Password<span>*</span>	     <input type="password"required name="newpassword" autocomplete="off"/>

Confirm New Password<span>*</span><input type="password"required name="confirmpassword" autocomplete="off"/>

				       <button>Apply</button></pre>
       
          
          <!-- This input field is needed, to get the email of the user -->
          <input type="hidden" name="email" value="<?= $email ?>">    
          <input type="hidden" name="hash" value="<?= $hash ?>">    
              
        
          
          </form>

    </div>

<div id="footer">
<center>Website by Karan Dave</center>
</div>

</body>
</html>