<?php 
	require('top.php');
	//prx($_SESSION['cart']);
    if (!isset($_SESSION['cart']) || count($_SESSION['cart'])==0) {
        ?>
        <script>
            window.location.href='index.php';
        </script>
        <?php
    }
    if (isset($_SESSION['USER_LOGIN'])) {
        $email = $_SESSION['USER_EMAIL'];
        $info_query = mysqli_query($con, "select * from users where email='$email'");
        $rows = mysqli_fetch_assoc($info_query);
        $name = $rows['name'];
        $email = $rows['email'];
        $mobile = $rows['mobile'];
    }else{
        $name = '';
        $email = '';
        $mobile = '';
    }

    $cart_total = 0;
    if (isset($_POST['submit'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $productArr = get_product($con,'','',$key);
            $price = $productArr['0']['price'];
            $qty = $value['qty'];
            $cart_total = $cart_total+($price*$qty);
        }
        $user_id      = $_SESSION['ID'];
        $name         = get_safe_value($con, $_POST['name']);
        $address      = get_safe_value($con, $_POST['address']);
        $city         = get_safe_value($con, $_POST['city']);
        $zip          = get_safe_value($con, $_POST['zip']);
        $email        = get_safe_value($con, $_POST['email']);
        $mobile       = get_safe_value($con, $_POST['mobile']);
        $payment_type = get_safe_value($con, $_POST['payment_type']);
        $total_price  = $cart_total;
        if ($payment_type=='COD') {
            $payment_status = 'success';
        }else{
            $payment_status = 'pending';
        }
        $order_status = 'pending';
        $added_on = date("Y-m-d h:i:s");

        mysqli_query($con, "insert into my_order(user_id,name,address,city,zip,email,mobile,payment_type,total_price,payment_status,order_status,added_on) values('$user_id','$name','$address','$city','$zip','$email','$mobile','$payment_type','$total_price','$payment_status','$order_status','$added_on')");

        $order_id = mysqli_insert_id($con);

        foreach ($_SESSION['cart'] as $key => $value) {
            $productArr = get_product($con,'','',$key);
            $price = $productArr['0']['price'];
            $qty = $value['qty'];

            mysqli_query($con, "insert into order_details(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");
        }
        unset($_SESSION['cart']);
        ?>
            <script>
                window.location.href='thank_you.php';
            </script>
        <?php
    }
    
?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                          <a class="breadcrumb-item" href="<?php echo SITE_PATH; ?>">Home</a>
                          <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                          <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">
                            <?php 
                            $accordion_class = 'accordion__title';
                            if (!isset($_SESSION['USER_LOGIN'])) { 
                                $accordion_class = 'accordion__hide';  
                             ?>
                            <div class="accordion__title">
                                Checkout Method
                            </div>
                            <div class="accordion__body">
                                <div class="accordion__body__form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkout-method__login">
                                                <form id="login-form" action="#" method="post">
                                                    <h5 class="checkout-method__title">Login</h5>
                                                    <div class="single-input">
                                                        <label for="user-email">Email Address</label>
                                                        <input type="email" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
                                                        <span class="field_error" id="login_email_error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="user-pass">Password</label>
                                                        <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                                                        <span class="field_error" id="login_password_error"></span>
                                                    </div>
                                                    <p class="require">* Required fields</p>
                                                    <div class="dark-btn">
                                                        <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                                    </div>
                                                </form>
                                                <div class="form-output login_msg">
                                                    <p class="form-messege field_error"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-method__login">
                                                <form id="register-form" action="#" method="post">
                                                    <h5 class="checkout-method__title">Register</h5>
                                                    <div class="single-input">
                                                        <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                                        <span class="field_error" id="name_error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <input type="email" name="email" id="email" placeholder="Your Email*" style="width:100%">
                                                        <span class="field_error" id="email_error"></span>
                                                    </div>
                                                    
                                                    <div class="single-input">
                                                        <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
                                                        <span class="field_error" id="mobile_error"></span>
                                                    </div>

                                                    <div class="single-input">
                                                        <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
                                                        <span class="field_error" id="password_error"></span>
                                                    </div>

                                                    <div class="dark-btn">
                                                        <button type="button" class="fv-btn" onclick="user_register()">Register</button>
                                                    </div>
                                                </form>
                                                <div class="form-output register_msg">
                                                    <p class="form-messege field_error"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="<?php echo $accordion_class; ?>">
                                Address Information
                            </div>
                            <form action="#" method="post">
                                <div class="accordion__body">
                                    <div class="bilinfo">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" name="name" placeholder="First name" value="<?php echo $name; ?>" required="name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" name="address" placeholder="Street Address" class="form-control" required="address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="city" placeholder="City/State" required="city">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="zip" placeholder="Post code/ zip" required="zip">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="email" name="email" placeholder="Email address" value="<?php echo $email; ?>" required="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="mobile" placeholder="Phone number" value="<?php echo $mobile; ?>" required="mobile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion accordion__hide">
                                    payment information
                                </div>
                                <div class="accordion__body">
                                    <div class="paymentinfo">
                                        <div class="single-method">
                                            COD <input type="radio" name="payment_type" value="cod">
                                            &nbsp;&nbsp;PayU <input type="radio" name="payment_type" value="payu">
                                        </div><br/>
                                        <div class="single-method">
                                            
                                        </div>
                                    </div>
                                </div>
                                COD <input type="radio" name="payment_type" value="COD" required>&nbsp;&nbsp;
                                PayU <input type="radio" name="payment_type" value="payu" required><br/><br/>
                                <input type="submit" class="fv-btn" name="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">
                        <?php
                        $cart_total = 0;
                            foreach ($_SESSION['cart'] as $key => $value) {
                            $productArr = get_product($con,'','',$key);
                            $pname = $productArr['0']['name'];
                            $mrp = $productArr['0']['mrp'];
                            $price = $productArr['0']['price'];
                            $image = $productArr['0']['image'];
                            $qty = $value['qty'];
                            $cart_total = $cart_total+($price*$qty);
                        ?>
                        <div class="single-item">
                            <div class="single-item__thumb">
                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image; ?>" alt="ordered item">
                            </div>
                            <div class="single-item__content">
                                <a href="#"><?php echo $pname; ?></a>
                                <span class="price"><?php echo $price*$qty; ?>&nbspINR</span>
                            </div>
                            <div class="single-item__remove">
                                <?php $msg='remove'; ?>
                                <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key; ?>','<?php echo $msg; ?>')">
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price"><?php echo $cart_total; ?>&nbspINR</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	require('footer.php');
?>