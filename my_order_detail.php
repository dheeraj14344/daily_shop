<?php 
	require('top.php');
	$order_id = get_safe_value($con, $_GET['id']);
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
                          <span class="breadcrumb-item active">My Order Details</span>
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
                                    <th class="product-thumbnail">Product Name</th>
                                    <th class="product-name">Image</th>
                                    <th class="product-price">Qty</th>
                                    <th class="product-quantity">Price</th>
                                    <th class="product-quantity">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $uid = $_SESSION['ID'];
                                    $res = mysqli_query($con, "select distinct(order_details.id), order_details.*,products.name,products.image from order_details,products,my_order where order_details.order_id='$order_id' and my_order.user_id='$uid' and products.id=order_details.product_id");
                                    $total_price=0;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    	$total_price=$total_price+($row['qty']*$row['price']);
                                        ?>
                                    <tr>
                                        <td class="product-add-to-cart">
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td class="product-thumbnail">
                                        	
                                        		<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']; ?>">
                                        	
                                        </td>
                                        <td class="product-name">
                                            <?php echo $row['qty']; ?>
                                        </td>
                                        <td class="product-name">
                                            <?php echo $row['price']; ?>&nbsp;INR
                                        </td>
                                        <td class="product-name">
                                            <?php echo $row['qty']*$row['price']; ?>&nbsp;INR
                                        </td>
                                        
                                    </tr>
                                        <?php
                                    }
                                    if ($uid=='') {
                                        echo "<tr><td colspan='6'><center><h4>Your Cart is empty...</h4></center></td></tr>";
                                    }
                                 ?>
                                 	<tr>
                                 		<td colspan='3'></td>
                                 		<td style="font-weight: bold;">Total Price : </td>
                                 		<td style="font-weight: bold;"><?php echo $total_price; ?>&nbsp;INR</td>
                                 	</tr>
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