<?php
/* Displays all error messages here */
session_start();
?>

<html>
<head>
  <title>Error</title>
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
  </head>
<body>
<div class="midlistcontent">
    <h1>Error</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location: home.php" );
    endif;
    ?>
    </p>     
    <a href="home.php"><button class="buttons"/>Home</button></a>
</div>
</body>
</html>
