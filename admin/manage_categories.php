<?php 
require("top.inc.php");
$categories = '';
$msg = '';

if (isset($_GET['id']) && $_GET['id']!='') {
    $id   = get_safe_value($con, $_GET['id']);
    $res  = mysqli_query($con, "select * from categories where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check>0) {
        $rows = mysqli_fetch_assoc($res);
        $categories = $rows['categories'];
    }else{
        header('location:categories.php');
        die();
    }
}

if (isset($_POST['submit'])) {
	$category = get_safe_value($con, $_POST['category']);
    $res  = mysqli_query($con, "select * from categories where categories='$category'");
    $check = mysqli_num_rows($res);
    if ($check>0) {
        if (isset($_GET['id']) && $_GET['id']!='') {
            $getData = mysqli_fetch_assoc($res);
            if ($id==$getData['id']) {
                // code...
            }else{
                $msg = "Category alresy exist";
            }
        }else{
            $msg = "Category alresy exist";
        }
    }

    if ($msg == '') {        
        if (isset($_GET['id']) && $_GET['id']!='') {
            mysqli_query($con,"update categories set categories='$category' where id='$id'");
        }else{
            mysqli_query($con,"insert into categories(categories,status) values('$category','1')");
        }
        	?>
    	<script>
    		window.location.href = "http://localhost/my_shop/admin/categories.php";
    	</script>
    	<?php
    }
}


?>
		<h4 class="page-title">Add Category</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                        	<a href="http://localhost/my_shop/admin/categories.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                        	<a href="categories.php">Back</a>
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
                        <div class="w-50 mx-auto">
                        	<h2 class="text-info text-center my-4">Add Category</h2>
                        	<form method="post" >
                        		<div class="col-sm-12 my-2">
                        			<div class="row">
                        				<div class="col-sm-4">
                        					<label>Category : </label>
                        				</div>
                        				<div class="col-sm-6">
                        					<input type="text" name="category" class="form-control" required value="<?php echo $categories; ?>">
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
                            <p class="text-danger text-center mt-2"><?php echo $msg; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include("footer.inc.php");
?>