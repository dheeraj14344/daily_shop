<?php 
require("top.inc.php");
if (isset($_GET['type']) && $_GET['type']!="") {
	$type = get_safe_value($con, $_GET['type']);
	
	if ($type=='delete') {
		$id = get_safe_value($con, $_GET['id']);
		$delete_sql = "delete from contact_us where id='$id'";
		mysqli_query($con, $delete_sql);
	}
}
/*$sql = "SELECT * FROM `categories` ORDER BY categories DESC";*/
$sql = "select * from contact_us order by id desc";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);
if ($num==0) {
	echo "Data not found";
}else{
?>
		<h4 class="page-title">Contact Us</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                        	<a href="http://localhost/my_shop/admin/categories.php">Home</a>
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
	                                <th class="serial">#</th>
	                                <th>ID</th>
	                                <th>Name</th>
	                                <th>Email</th>
	                                <th>Mobile</th>
	                                <th>Query</th>
	                                <th>Date</th>
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
	                                <td><?php echo $rows['name']; ?></td>
	                                <td><?php echo $rows['email']; ?></td>
	                                <td><?php echo $rows['mobile']; ?></td>
	                                <td><?php echo $rows['comment']; ?></td>
	                                <td><?php echo $rows['added_on']; ?></td>
	                                <td> 
	                                	<?php 
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