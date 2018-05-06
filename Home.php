<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';

session_start();

if (!empty($_GET['doaction']) && $_GET['doaction'] == "linksent" ){
echo '<script>alert("Verification link sent");</script>';
}
if (!empty($_GET['pass']) && $_GET['pass'] == "reset" ){
echo '<script>alert("Password reset Sucessful");</script>';
}

if (!empty($_GET['verify']) && $_GET['verify'] == "done" ){
echo '<script>alert("Your Email has been Verified !");</script>';
}


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
             <title>Home</title>

       <meta http-equiv="refresh" content="26">
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



<div class="content">
<img class="photo photo1" id="anim" src="IMG/slider/s1.jpg" alt="" width="" height=""/>
<img class="photo photo2" id="anim" src="IMG/slider/s2.jpg" alt="" width="" height=""/>
<img class="photo photo3" id="anim" src="IMG/slider/s3.jpg" alt="" width="" height=""/>
<img class="photo photo4" id="anim" src="IMG/slider/s4.jpg" alt="" width="" height=""/>
<img class="photo photo5" id="anim" src="IMG/slider/s5.jpg" alt="" width="" height=""/>
</div>




<table id="shop" border="0" >

<tr>
<td class="options"><img src="IMG/shop/emi2.jpg" alt="" height="100" width="100"></td>
<td class="options"><img src="IMG/shop/save.jpg" alt="" height="100" width="100"></td>
<td class="options"><img src="IMG/shop/service.png" alt="" height="100" width="100"></td>
</tr>

<tr>
<td><p class="options">EMI options Available <br>on 0% Interest, Buy Now.</p></td>
<td class="options"><p class="para">Lots of offers and discounts on <br>various segments, Save More.</p></td>
<td><p class="options">Free service,<br>for 1 year<br>just a Click Away!</td>
</tr>


</table>

<?php	
	require 'footer.html'
?>
	
</body>
</html>








