<?php 
	require('top.php');
	//prx($_SESSION['cart']);
?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                          <a class="breadcrumb-item" href="index.php">Home</a>
                          <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                          <span class="breadcrumb-item active">shopping cart</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">Name of products</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                            	<?php 
                            	if (isset($_SESSION['cart'])) {
	                            	foreach ($_SESSION['cart'] as $key => $value) {
	                            		$productArr = get_product($con,'','',$key);
	                            		$pname = $productArr['0']['name'];
	                            		$mrp = $productArr['0']['mrp'];
	                            		$price = $productArr['0']['price'];
	                            		$image = $productArr['0']['image'];
	                            		$qty = $value['qty'];
	                            	 ?>
	                                <tr>
	                                    <td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image; ?>" alt="product img" /></a></td>
	                                    <td class="product-name"><a href="#"><?php echo $pname; ?></a>
	                                        <ul  class="pro__prize">
	                                            <li class="old__prize"><?php echo $mrp; ?>&nbspINR</li>
	                                            <li><?php echo $price; ?>&nbspINR</li>
	                                        </ul>
	                                    </td>
	                                    <td class="product-price"><span class="amount"><?php echo $price; ?>&nbspINR</span></td>
	                                    <td class="product-quantity">
	                                    	<?php $msg='update'; ?>
	                                    	<input type="number" id="<?php echo $key; ?>qty" value="<?php echo $qty; ?>" />
	                                    	<a href="javascript:void(0)" onclick="manage_cart('<?php echo $key; ?>','<?php echo $msg; ?>')">Update</a>
	                                    </td>
	                                    <td class="product-subtotal"><?php echo $price*$qty; ?></td>
	                                    <td class="product-remove">
	                                    	<?php $msg='remove'; ?>
	                                    	<a href="javascript:void(0)" onclick="manage_cart('<?php echo $key; ?>','<?php echo $msg; ?>')">
	                                    		<i class="icon-trash icons"></i>
	                                    	</a>
	                                    </td>
	                                </tr>
                                <?php 
		                            }
		                        }else{
								?>
								<tr>
									<td colspan="6"><center><h4>Your Cart is empty...</h4></center></td>
								</tr>
                                <?php 
		                        }
		                        ?>
                            </tbody>
                            <div id="getType"><?php //echo json_encode(['msg'=>$msg]); ?></div>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="<?php echo SITE_PATH; ?>">Continue Shopping</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    
                                    <a href="<?php echo SITE_PATH; ?>checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<?php
	require('footer.php');
?>