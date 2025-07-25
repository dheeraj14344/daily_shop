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
                          <span class="breadcrumb-item active">My Order</span>
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
                                    <th class="product-thumbnail">Order ID</th>
                                    <th class="product-name">Order Date</th>
                                    <th class="product-price">Address</th>
                                    <th class="product-quantity">Payment Type</th>
                                    <th class="product-quantity">Payment Status</th>
                                    <th class="product-quantity">Order Status</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $uid = $_SESSION['ID'];
                                    $res = mysqli_query($con, "select * from my_order where user_id='$uid'");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                    <tr>
                                        <td class="product-add-to-cart buttons-cart">
                                            <a href="my_order_detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#"><?php echo $row['added_on']; ?></a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#">
                                                <?php echo $row['address']; ?><br/>
                                                <?php echo $row['city']; ?><br/>
                                                <?php echo $row['zip']; ?>
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#"><?php echo $row['payment_type']; ?></a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#"><?php echo $row['payment_status']; ?></a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#"><?php echo $row['order_status']; ?></a>
                                        </td>
                                    </tr>
                                        <?php
                                    }
                                    if ($uid=='') {
                                        echo "<tr><td colspan='6'><center><h4>Your Cart is empty...</h4></center></td></tr>";
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