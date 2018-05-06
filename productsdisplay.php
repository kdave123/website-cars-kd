
<div class="midlistcontent">
        <?php
    //  $mysqli = mysqli_connect('localhost', 'root', '', 'cart');
        $query = 'SELECT * FROM products ORDER by id ASC';
        $result = mysqli_query($mysqli, $query);

        if ($result):
            if(mysqli_num_rows($result)>0):
                while($product = mysqli_fetch_assoc($result)):
                //print_r($product);
                ?>
          <table border="0" style="display:inline-block;" >
                    <form method="post" action="Accessories.php?action=add&id=<?php echo $product['id']; ?>">
                     
                       
							<tr>
							 <td align="center"><img height="150px" width="" src="<?php echo $product['image']; ?>"/></td>
							</tr>
							
                           <tr> 
						     <td align="center" width="270"><?php echo $product['name']; ?></td>
							</tr>
                           <tr> 
						   <td align="center">Rs <?php echo $product['price']; ?></td>
						   </tr>
						    <tr> 
						   <td align="center"><input type="text" name="quantity" value="1" /></td>
						   </tr>
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <tr> 
						   <td align="center">	<input type="submit" name="add_to_cart" value="Add to Cart" /> </td>
						   </tr>
						
                     
                    </form>
               </table>

                <?php
                endwhile;
            endif;
        endif;   
        ?>

 </div>