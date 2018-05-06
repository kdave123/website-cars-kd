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
               <title>CARS</title>
</head>

       <link type="text/css" rel="stylesheet" href="stylesheet.css"/>

<body onload="displaycartpersistant();">


<?php
require 'headercars.php';
?>

<?php
require 'loginsys.html';

?>

<?php
	require 'leftnavigation.html'
?>   



<center><p class="bodyhead">CARS</p>
</center>
<div class="midlistcontent">
<table class="" cellspacing="30">
<tr>
	<td><a href=suv.php><img src="IMG/cars/SUV.jpeg" alt="" width="80%" height=""/></a></td>
	<td><a href=sedan.php><img src="IMG/cars/sedan.jpg" alt="" width="80%" height=""/></a></td>
</tr>
<tr>
	<td class="cars">SUV</td>
	<td class="cars">SEDAN</td>
</tr>



<tr>
	<td><a href=luxury.php> <img src="IMG/cars/luxury.jpg" alt="" width="80%" height=""/></a></td>
	<td><a href=hatch-back.php><img src="IMG/cars/hatch-back.jpg" alt="" width="80%" height=""/></a></td>
</tr>
<tr>
	<td class="cars">LUXURY</td>
	<td class="cars">HATCH-BACK</td>
</tr>

</table>
</div>


<?php

	require'footer.html'
?>
</body>
</html>