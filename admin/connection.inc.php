<?php 
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "my_shop";


$con = mysqli_connect($host, $user, $pass, $dbname);
if ($con) {
	echo "";
}else{
	echo "fialed";
}

define("SERVER_PATH",$_SERVER['DOCUMENT_ROOT'].'/my_shop/');
define("SITE_PATH",'http://localhost/my_shop/');
define("PRODUCT_IMAGE_SERVER_PATH",SERVER_PATH.'media/product/');
define("PRODUCT_IMAGE_SITE_PATH",SITE_PATH.'media/product/');
 ?>