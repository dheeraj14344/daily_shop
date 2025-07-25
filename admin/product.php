<?php 
require("top.inc.php");
//prx(PRODUCT_IMAGE_SERVER_PATH);
//echo ;
if (isset($_GET['type']) && $_GET['type']!="") {
	$type = get_safe_value($con, $_GET['type']);
	if ($type=="status") {
		$operation = get_safe_value($con, $_GET['operation']);
		$id        = get_safe_value($con, $_GET['id']);
		if ($operation == "active") {
			$status = '1';
		}else{
			$status = '0';
		}
		$update_status_sql = "update products set status='$status' where id='$id'";
		mysqli_query($con, $update_status_sql);
	}
	if ($type=='delete') {
		$id = get_safe_value($con, $_GET['id']);
		$delete_sql = "delete from products where id='$id'";
		mysqli_query($con, $delete_sql);
	}
}
/*$sql = "SELECT * FROM `categories` ORDER BY categories DESC";*/
$sql = "select products.*,categories.categories from products,categories where products.categories_id=categories.id order by name asc";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);
if ($num==0) {
	echo "Data not found";
}else{
?>
		<h4 class="page-title">Product Page</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                        	<a href="http://localhost/my_shop/admin/categories.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                        	<a href="manage_product.php">Add Product</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
	<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
	                <div class="table-stats order-table ov-h">
	                    <table class="table ">
	                        <thead>
	                            <tr>
	                                <th class="serial">S.No.</th>
	                                <th>ID</th>
	                                <th>Category</th>
	                                <th>Name</th>
	                                <th>Image</th>
	                                <th>MRP</th>
	                                <th>Price</th>
	                                <th>Qty</th>
	                                <th>Status</th>
	                                <th>Action</th>
	                            </tr>
	                        </thead>
	                      	<tbody class="table-striped">
	                      		<?php 
	                      		$i = 1;
	                      		while ($rows = mysqli_fetch_assoc($res)) {
	                      		?>
	                            <tr>
	                                <td class="serial"><?php echo $i; ?></td>
	                                <td><?php echo $rows['id']; ?></td>
	                                <td><?php echo $rows['categories']; ?></td>
	                                <td><?php echo $rows['name']; ?></td>
	                                <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$rows['image']; ?>" width='80' height='80' ></td>
	                                <td><?php echo $rows['mrp']; ?></td>
	                                <td><?php echo $rows['price']; ?></td>
	                                <td><?php echo $rows['qty']; ?></td>
	                                <td> 
	                                	<?php 
	                                	if ($rows['status']==1) {
	                                		echo "<a href='?type=status&operation=deactive&id=".$rows['id']."'><button class='btn btn-outline-success'>Active</button></a>";
	                                	}else{
	                                		echo "<a href='?type=status&operation=active&id=".$rows['id']."'><button class='btn btn-outline-warning'>Deactive</button></a>";
	                                		} 
	                                	?>
	                                </td>	 
	                                <td>
	                                	<?php 
	                                	echo "&nbsp<a href='/my_shop/admin/manage_product.php?id=".$rows['id']."'><button class='btn btn-outline-info'>Edit</button></a>"; 
	                                	echo "&nbsp<a href='?type=delete&id=".$rows['id']."'><button class='btn btn-outline-danger'>Delete</button></a>";
	                                	 ?>
	                                </td>                                   
	                           </tr>
	                       <?php $i++; } ?>
	                        </tbody>
	                    </table>
	                </div> <!-- /.table-stats -->
	            </div>
            </div>
        </div>
   </div>

<?php
}
include("footer.inc.php");
?> 