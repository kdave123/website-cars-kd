<?php
session_start();


?>

<?php
$product_ids = array();
//session_destroy();

//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        
        //keep track of how mnay products are in the shopping cart
        $count = count($_SESSION['shopping_cart']);
        
        //create sequantial array for matching array keys to products id's
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        
        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['shopping_cart'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );   
        }
        else { //product already exists, increase quantity
            //match array key to id of the product being added to the cart
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    //add item quantity to the existing product in the array
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
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

//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>

<html>
<head>
               <title>Support</title>
<script>
function validateForm() {
    var x = document.forms["form"]["fname"].value;
  
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
   }

	
    x = document.forms["form"]["lname"].value;
    if (x == null || x == "") {
        alert("Last name must be filled out");
        return false;
    }
     


      x = document.forms["form"]["usermail"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        return false;
    

}
}





</script>

</head>


       <link type="text/css" rel="stylesheet" href="stylesheet.css"/>

<body background="IMG/support.jpg" onload="displaycartpersistant();">

<!-- <p id="Head">Cars Empire</p> -->
<?php
require 'headersupport.php';
?>

<?php
require 'loginsys.html';

?>

<?php
	require 'leftnavigation.html'
?>


<br>
<div id ="supportform">
Fill form for Deals. Buy/Sell.


<br>

<br>
<form name="form" onsubmit="return validateForm()" method="post" action="http://localhost:8089/pro/add.jsp"">

<table id="supporttable">
            <tr>
                   <td><font color ="red">*</font>First Name</td><td><input type="text" value="" name="fname"></td>
            </tr>
             
            <tr>
                   <td><font color ="red">*</font>Last Name</td><td><input type="text" value="" name="lname"></td>
            </tr>

            <tr>
                   <td><font color ="red">*</font>E-mail</td><td><input type="text" value="" name="usermail"></td>
            </tr>

            <tr>
                   <td>Phone Number</td><td><input type="text" value="" name="phonenumber"></td>
            </tr>
</table>
            <br><br>
                <font color ="red">*</font><font face="calibri">Description</font><br><textarea rows="7" cols="40" name="Description"></textarea>
            
 <br>
 <br>
  
 <p class="para">(Note:Fields marked with <font color ="red">*</font> are mandatory to be filled.)</p>
  
    
    <input type="submit"  value="Submit" onclick="" name="b1" class="buttons">
    <input type="reset" value="Reset" name="b3" class="buttonreset">

</form>
    
</div>


<?php
	require'footer.html'
?>
</body>

</html>
 

