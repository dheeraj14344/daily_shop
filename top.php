<?php 
    require('connection.inc.php'); 
    require('functions.inc.php'); 
    require('add_to_cart.inc.php'); 
    $cat_res = mysqli_query($con, "select * from categories where status=1 order by categories asc");
    $cat_arr = array();
    while($row = mysqli_fetch_assoc($cat_res)){
        $cat_arr[]=$row;
    }
$obj = new add_to_cart();
$totalProduct = $obj->totalProduct();
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
   
    <div class="wrapper">
        <header id="htc__header" class="htc__header__area header--one">
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo">
                                     <a href="index.php"><img src="images/logo/4.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <?php 
                                            foreach ($cat_arr as $list) {
                                            ?>
                                            <li>
                                                <a href="categories.php?id=<?php echo $list['id']; ?>"><?php echo $list['categories']; ?>
                                                </a>
                                            </li>
                                            <?php
                                            } 
                                        ?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <?php 
                                            foreach ($cat_arr as $list) {
                                            ?>
                                            <li>
                                                <a href="categories.php?id=<?php echo $list['id']; ?>"><?php echo $list['categories']; ?>
                                                </a>
                                            </li>
                                            <?php
                                            } 
                                        ?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                                <div class="header__right">

                                    <div class="header__account">
                                        <?php 
                                            if (isset($_SESSION['USER_LOGIN'])) {
                                                echo '<a href="my_order.php">My Order</a>';
                                                echo '<a href="logout.php">&nbspLogout</a>';
                                            }else{
                                                echo '<a href="login.php"><i class="icon-user icons"></i>&nbspLogin/Register</a>';
                                            }
                                        ?>
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct; ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
        </header>
        <!-- End Header Area -->