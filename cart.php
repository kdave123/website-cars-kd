
<script>

/*
function displaycart()
{
	 x = document.getElementById("cartview");
	var c = localStorage.getItem("c");
    if(c==="0") 
	{
        
		localStorage.setItem("c", "1");
    }
	else
	{
        x.style.display = "none";
		localStorage.setItem("c", "0");
    }
	
}
*/
function displaycartpersistant()
{
	var c = localStorage.getItem("c");
	
	if(c==="1")
	{
	document.getElementById("cartview").style.marginLeft= "50%";
	
	}
	
	
	if(c==="0")
	{
		
	document.getElementById("cartview").style.marginLeft = "-1000px";
	}
}
	

    function movecart(){
	
		var move = document.getElementById('cartview');
        if (move.style.marginLeft === "-1000px") {
			localStorage.setItem("c", "1");
		
            move.style.marginLeft = "50%";

        } else {
			localStorage.setItem("c", "0");
			move.style.marginLeft = "-1000px";
		
            
        }
    }

</script>



<div class="cartbutton" id="cartbutton" onclick="movecart();"  style="display:inline-block;"  >

<p class="cartvalue">(<?php if(isset($_SESSION['shopping_cart'])){echo count($_SESSION['shopping_cart']); }?>)<br>CART</p>
</div>

<table id="cartview" class="cartview" border="0" >  

 
        
        <tr>  
             <th width="40%"align="center">Product Name</th>  
             <th width="10%"align="center">Quantity</th>  
             <th width="20%"align="center">Price</th>   
             <th width="15%"align="center">Total</th>  
             <th width="5%"align="center"></th>  
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
               <a href="<?php echo $_SERVER['PHP_SELF'];?>?action=delete&id=<?php echo $product['id']; ?>">
                       <div style="color:white; font-size: 16px; padding: 3px;background-color:red;border-radius:10px;">Remove</div>
               </a>
			
           </td>  
        </tr>  
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']);  
             endforeach;  
        ?>  
        <tr>  
             <td colspan="3" align="right">Total</td>  
             <td align="center">Rs <?php echo number_format($total, 2); ?></td>  
             
        
	   <td>    <?php 
                if (isset($_SESSION['shopping_cart'])):
                if (count($_SESSION['shopping_cart']) > 0):
             ?>
                <a href="checkout.php" class="button" style=" font-size: 20px; " >Checkout</a>
             <?php endif; endif; ?></td>  
     
      
            <!-- Show checkout button only if the shopping cart is not empty -->
       
        <?php  
        endif;
        ?>
        </table>
		

