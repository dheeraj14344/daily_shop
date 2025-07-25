<?php 
require("top.inc.php");
$categories_id = '';
$name          = '';
$mrp           = '';
$price         = '';
$qty           = '';
$image         = '';
$short_desc    = '';
$description   = '';
$meta_title    = '';
$meta_desc     = '';
$meta_keywords = '';
$msg           = '';

$image_required = "required";
if (isset($_GET['id']) && $_GET['id']!='') {
    $image_required = '';
    $id    = get_safe_value($con, $_GET['id']);
    $res   = mysqli_query($con, "select * from products where id='$id'");
    $check = mysqli_num_rows($res);

    if ($check>0) {
        $rows = mysqli_fetch_assoc($res);
        $categories_id = $rows['categories_id'];
        $name          = $rows['name'];
        $mrp           = $rows['mrp'];
        $price         = $rows['price'];
        $qty           = $rows['qty'];
        $old_image     = $rows['image'];
        $short_desc    = $rows['short_desc'];
        $description   = $rows['description'];
        $meta_title    = $rows['meta_title'];
        $meta_desc     = $rows['meta_desc'];
        $meta_keywords = $rows['meta_keywords'];
    }else{
        header('location:product.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    //print_r($_POST);
    $categories_id = get_safe_value($con, $_POST['categories_id']);
    $name          = get_safe_value($con, $_POST['name']);
    $mrp           = get_safe_value($con, $_POST['mrp']);
    $price         = get_safe_value($con, $_POST['price']);
    $qty           = get_safe_value($con, $_POST['qty']);
    $short_desc    = get_safe_value($con, $_POST['short_desc']);
    $description   = get_safe_value($con, $_POST['description']);
    $meta_title    = get_safe_value($con, $_POST['meta_title']);
    $meta_desc     = get_safe_value($con, $_POST['meta_desc']);
    $meta_keywords = get_safe_value($con, $_POST['meta_keywords']);

    $res    = mysqli_query($con, "select * from products where name='$name'");
    
    $check = mysqli_num_rows($res);

    if ($check>0) {
        if (isset($_GET['id']) && $_GET['id']!='') {
            $getData = mysqli_fetch_assoc($res);
            if ($id==$getData['id']) {
                //echo "fdas";
            }else{
                $msg = "Product alresy exist";
            }
        }else{
            $msg = "Product alresy exist";
        }
    }

    if ($_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpeg') {
        $msg = "Please Select png, jpg or jpeg image format";
    }else{
        $msg = '';
    }

    if ($msg == '') {  

        if (isset($_GET['id']) && $_GET['id']!='') {
            if ($_FILES['image']['name']!='') {
                $image = rand(111111111,999999999)."_".$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                unlink(PRODUCT_IMAGE_SERVER_PATH.$old_image);
                $update_sql = "update products set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',image='$image',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keywords='$meta_keywords' where id='$id'";
            }else{
                $update_sql = "update products set categories_id='$categories_id',name='$name',mrp='$mrp',image='$old_image',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keywords='$meta_keywords' where id='$id'";
            }
            mysqli_query($con,$update_sql);
        }else{
            $image = rand(111111111,999999999)."_".$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
            mysqli_query($con,"insert into products(categories_id,name,mrp,price,qty,image,short_desc,description,meta_title,meta_desc,meta_keywords,status) values('$categories_id','$name','$mrp','$price','$qty','$image','$short_desc','$description','$meta_title','$meta_desc','$meta_keywords','1')");
        }
        	?>
    	<script>
    		window.location.href = "http://localhost/my_shop/admin/product.php";
    	</script>
    	<?php
    }
}


?>
		<h4 class="page-title">Manage Product</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                        	<a href="http://localhost/my_shop/admin/categories.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                        	<a href="product.php">Back</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
	<div class="container-fluid bg-white">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="w-75 mx-auto my-2">
                        	<form method="post" enctype="multipart/form-data">
                        		<div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Category : </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="categories_id" class="form-control" required>
                                                <?php
                                                $res = mysqli_query($con, "select * from categories order by categories desc");
                                                while ($rows = mysqli_fetch_assoc($res)) {
                                                    if ($rows['id']==$categories_id) {
                                                        echo "<option value=".$rows['id']." selected >".$rows['categories']."</option>";
                                                    }else{
                                                        echo "<option value=".$rows['id'].">".$rows['categories']."</option>";
                                                    }
                                                 } 
                                                 ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Product : </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" name="name" class="form-control" required placeholder="Enter Product Name" value="<?php echo $name; ?>" >
                                        </div>
                                    </div>
                                </div><hr>
                                <div class="col-sm-12 my-2">
                                    <div class="row">
                                       <div class="col-sm-2">
                                            <label>MRP : </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" name="mrp" class="form-control" required placeholder="Enter Product MRP" value="<?php echo $mrp; ?>">
                                        </div> 
                                        <div class="col-sm-2">
                                            <label>Price : </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" name="price" class="form-control" required placeholder="Enter Product Price" value="<?php echo $price; ?>">
                                        </div>
                                    </div>
                                </div><hr>
                                <div class="col-sm-12 my-2">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Qty : </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" name="qty" class="form-control" required placeholder="Enter Product Qty" value="<?php echo $qty; ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Image : </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="file" name="image" class="form-control" <?php echo $image_required; ?>/>
                                        </div>
                                    </div>
                                </div><hr>
                                <div class="col-sm-12 my-2">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Short Desc : </label>
                                        </div>
                                        <div class="col-sm-10">
                                            <textarea name="short_desc" id="short_desc" class="form-control" required="" placeholder="Enter Short Description"><?php echo $short_desc; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 my-2">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Description : </label>
                                        </div>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description" class="form-control" required="" placeholder="Enter Product Description"><?php echo $description; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 my-2">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Meta Title : </label>
                                        </div>
                                        <div class="col-sm-10">
                                            <textarea name="meta_title" id="meta_title" class="form-control" required="" placeholder="Enter Product Meta Title"><?php echo $meta_title; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 my-2">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Meta Desc : </label>
                                        </div>
                                        <div class="col-sm-10">
                                            <textarea name="meta_desc" id="meta_desc" class="form-control" required="" placeholder="Enter Product Meta Description"><?php echo $meta_desc; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 my-2">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Meta Keywords : </label>
                                        </div>
                                        <div class="col-sm-10">
                                            <textarea name="meta_keywords" id="meta_keywords" class="form-control" placeholder="Enter Meta Keywords" required=""><?php echo $meta_keywords; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                        		<div class="col-sm-12">
                        			<div class="row">
                        				<div class="col-sm-4"><label> </label></div>
                        				<div class="col-sm-8">
                        					<input type="submit" name="submit" class="btn btn-outline-success px-4">
                        				</div>
                        			</div>
                        		</div>
                        	</form> 
                        </div>
                        <div class="bg-warning py-1">
                            <h4 class="text-danger text-center mt-2"><?php echo $msg; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include("footer.inc.php");
?>