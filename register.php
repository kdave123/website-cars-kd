<?php 
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require 'db.php';
session_start();

 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'registercode.php';
        
    }
}


?>



<html>
   <head> 

             <title>Sign Up </title>

 
       <link type="text/css" rel="stylesheet" href="stylesheet.css"/>

</head>



<body>
   <?php
require 'headersupport.php';
?>


<?php
	require 'leftnavigation.html'
?>



<p class="bodyhead"></p>
	

	
	  <div class="midlistcontent">

          <p class="bodyhead">Sign Up for Free</p>
           
          
          <form action="register.php" method="post" autocomplete="off">
          
    
        <pre>  
            First Name<span class="req">*</span>      <input type="text" required autocomplete="off" name='firstname' />

            Last Name<span class="req">*</span>       <input type="text"required autocomplete="off" name='lastname' />
     
            Email Address<span class="req">*</span>   <input type="email"required autocomplete="off" name='email' />
        
            Set A Password<span class="req">*</span>  <input type="password"required autocomplete="off" name='password'/>
   
            <button type="submit" class="button" name="register" />Register</button>
          </pre>
          </form>


    </div>

<div id="footer">
<center>Website by Karan Dave</center>
</div>

</body>
</html>