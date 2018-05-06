<?php 
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require 'db.php';
session_start();

if( count($_SESSION['shopping_cart']) ==0)
{
	header("location: home.php");
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
	
}
 
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before checking out!";
  header("location: error.php");    
}
else {
    // Makes it easy take in Variables
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];

	
}  

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	if(isset($_POST['submitphone']))
	{
		$phone = $mysqli->escape_string($_POST['phone']);
		$query = "UPDATE users SET phone='.$phone.'where email='$email'";
	     mysqli_query($mysqli, $query);
	}
	if(isset($_POST['submitaddress']))
	{
		$address = $mysqli->escape_string($_POST['address']);
		$query = "UPDATE users SET address='.$address.'where email='$email'";
	     mysqli_query($mysqli, $query);
	}
	
	
}



	$query = "SELECT address FROM users where email='$email'";
	$result = mysqli_query($mysqli, $query);
	$address = mysqli_fetch_assoc($result);
	
	$query = "SELECT phone FROM users where email='$email'";
	$result=mysqli_query($mysqli,$query);
	$phone=mysqli_fetch_assoc($result);
?>



<html>
   <head> 

             <title>Checkout</title>

 
       <link type="text/css" rel="stylesheet" href="stylesheet.css"/>

</head>



<body >
  
<?php
require 'header.php';
?>

<?php
require 'loginsys.html';

?>

<?php
	require 'leftnavigation.html'
?>
<center>
<p class="bodyhead"></p>
</center>

	

	
	  <div class="placeordercontent" style="display:inline-block;" >

				<div class="forglow" style="display:inline-block;float:left;padding:20px;">
                
			<div style="padding:25px;display:inline-block;">
					<table >
						<tr>
						<td class="glowmatchaddress"  >
						Address: 
						<form  method="post" action="checkout.php" >
						
							<textarea placeholder="Room no, Building, Locality, Landmark, City, State (For Update)" name="address"  style="float:top;width:150px;height:100px"></textarea> 
							<button type="submit" class="button" style="font-size:9px;float:top;" name="submitaddress">UPDATE</button>
					
						</form>
						
						</td>
						<td class="glowmatchphone" >
						Phone : 
						<form  method="post" action="checkout.php">
							 <input placeholder="Phone Number (For Update)" type="text"  name="phone" style="float:top;width:200px;">
							<button type="submit" class="button" style="font-size:9px;" name="submitphone">UPDATE</button>
						</form>
						</td>
					</tr>
				</table>
				</div>
		  
 <table border="0" class="bill" >  
 <tr class="customerdetails">
 <td ><p class="customerdetails"><?php echo 'Name : '.$first_name.' '.$last_name; ?><br><br><?= 'Email : '.$email ?></p></td>
 
 
 <td  colspan="2" class="glowmatchaddress">
				<p class="customerdetails"><?php echo"Address : "; if(!is_null($address['address'])){ echo $address['address'];}?></p></td>
  
  
  <td  colspan="2" class="glowmatchphone">
				
				<p class="customerdetails"><?php echo"Phone : "; if(!is_null($phone['phone'])){ echo $phone['phone'];}?></p></td>
 </tr>
 
            <tr><th colspan="5" ><font size="10px">Order Summary</font></th></tr>   
        <tr>  
             <th width="40%"align="center">Product Name</th>  
             <th width="10%"align="center">Quantity</th>  
             <th width="20%"align="center">Price</th>  
             <th width="15%"align="center">Total</th>  
             <th width="5%"align="center">Action</th>  
        </tr>  
        <?php   
        if(!empty($_SESSION['shopping_cart'])):  
            
             $total = 0;  
        
             foreach($_SESSION['shopping_cart'] as $key => $product): 
        ?>  
        <tr>  
           <td align="center"><?php echo $product['name']; ?></td>  
           <td align="center"><?php echo $product['quantity']; ?></td>  
           <td align="center" >Rs  <?php echo $product['price']; ?></td>  
           <td align="center" >Rs  <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
           <td align="center" >
               <a href="checkout.php?action=delete&id=<?php echo $product['id']; ?>">
                       <div style="color:white; font-size: 16px; padding: 3px;background-color:red;border-radius:10px;">Remove</div>
               </a>
			
           </td>  
        </tr>  
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']);  
             endforeach;  
        ?>  
        <tr>  
             <td colspan="3" align="right" style="font-weight:bold">Total</td>  
             <td align="center">Rs <?php echo number_format($total, 2); ?></td>  
             <td></td>
        </tr>  
      
            <!-- Show checkout button only if the shopping cart is not empty -->
       
        <?php  
        endif;
        ?>  
        </table>
       </div>
 <div class="paymenttypeselect" style="display:inline-block;">  
      <?php
          
          // Keep reminding the user this account is not active, until they activate
      /*    if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please check your <br>mailbox and
              click verification link!
              </div>';	
          }*/
          ?>	
		
	
	<form name="paymenttype">
    <pre class="para"><span>Online Payment    </span> <input type="radio" name="payment">
	  
<span>Cash on Delivery  </span> <input type="radio" name="payment">
	</pre>
	
	<button class="button" style="height:50px;width:85%">Proceed to Payment</button>
	</form>
    </div>

	</div>
<div id="footer">
<center>Website by Karan Dave</center>
</div>

</body>
</html>