<?php
include("config/config.php");
session_start();
$_SESSION['navId'] = "product";
include("navbar.php");


$categories = array();
$sql = "SELECT * FROM product";
$result = mysqli_query($con, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
}

?>

<body ng-app="myApp" ng-controller="myController">
<div class="container">
	<hr>
	<button class="btn btn-info btn-lg pull-right" type="button" data-toggle="modal" data-target="#modalAdd">Add New</button>
	<h1>All Products</h1>
	<span class="clearfix"></span>
	<hr>


    <!--alert-->
    <?php
    
    if(isset($_SESSION['category_alert']) && isset($_SESSION['category_action_status'])){
        if($_SESSION['category_action_status'] == "Success"){
            ?>
            <div class="alert alert-success alert-dismissable" ng-if="messageInfo">
                <?php echo $_SESSION['category_alert']; ?>
            </div>
            <?php
        }else{
            ?>
            <div class="alert alert-danger alert-dismissable" ng-if="messageInfo">
                <?php echo $_SESSION['category_alert']; ?>
            </div>
            <?php
        }

        unset($_SESSION['category_alert']);
        unset($_SESSION['category_action_status']);
    }
    
    ?>




	<div class="table-responsive">
		<table class="table table-striped  table-responsive table-hover ">
			<thead>
				<tr class="info">
					<th>ID</th>
					<th>ItemCode</th>
					<th>Name</th>
					<th>Quantity</th>
					<th>Stock</th>
					<th>Price</th>
					<th>Profit</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>

                <?php
                foreach ($categories as $index => $category) {
                    ?>
                    
                    <tr ng-repeat="user in users">
                        <td><?php echo $category['ID'];?></td>
                        <td><?php echo $category['ItemCode'];?></td>
                        <td><?php echo $category['Name'];?></td>
						<td><?php echo $category['Quantity'];?></td>
                        <td><?php echo $category['Stock'];?></td>
                        <td><?php echo $category['Price'];?></td>
						<td><?php echo $category['Profit'];?></td>
                        <td><button type="button" class=" btn btn-info" data-toggle="modal" data-target="#modaledit" onclick="productEdit('<?php echo $category['ID'];?>','<?php echo $category['ItemCode'];?>','<?php echo $category['Name'];?>','<?php echo $category['Quantity'];?>','<?php echo $category['Stock'];?>','<?php echo $category['Price'];?>','<?php echo $category['Profit'];?>')">Edit</button></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaldelete" onclick="ProductDelete('<?php echo $category['ID'];?>','<?php echo $category['ItemCode'];?>','<?php echo $category['Name'];?>','<?php echo $category['Quantity'];?>','<?php echo $category['Stock'];?>','<?php echo $category['Price'];?>','<?php echo $category['Profit'];?>')">Delete</button></td>
                    </tr>
                    <?php
                }
                ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="modalAdd" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add new</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST">
					
					<div class="form-group">
						<label class="control-label col-md-2">Product ItemCode</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="ProductItemCode">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Product Name</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="ProductName">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Product Quantity</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="ProductQuantity">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Product Stock</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="ProductStock">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Product Price</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="ProductPrice">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Product Profit</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="ProductProfit">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2 col-md-offset-2">
							<input type="submit" hidden name="addCategory" id="addCategory">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
                    <button type="button" class="btn btn-success pull-right" onclick="saveCategory()">Save</button>		
					<button type="button" class="btn btn-info pull-right" data-dismiss="modal" >Close</button>		
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modaledit" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Product</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" >
					<div class="form-group">
						<label class="control-label col-md-2">ProductItemCode</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="ProductItemCode_edit" id="ProductItemCode_edit">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">ProductName</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="ProductName_edit" id="ProductName_edit">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">ProductQuantity</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="ProductQuantity" id="ProductQuantity_edit">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">ProductStock</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="ProductStock_edit" id="ProductStock_edit">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">ProductPrice</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="ProductPrice_edit" id="ProductPrice_edit">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">ProductProfit</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="ProductProfit_edit" id="ProductProfit_edit">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2 col-md-offset-2">
							<button type="button" class="btn btn-info " onclick="updateProduct()">Update</button>
						</div>
					</div>

                    <!-- hidden input field for saving the selected category ID -->
                    <input type="text" hidden name="selected_category_id_update" required id="selected_category_id_update">
                    <input type="submit" hidden name="editCategorySubmit" id="editCategorySubmit">

				</form>
			</div>
			<div class="modal-footer">
					<button type="submit" class="btn btn-info pull-right" data-dismiss="modal" >Close</button>		
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modaldelete" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Are you sure?</h4>
			</div>
			<div class="modal-body">
				<strong style="color:red;" id="deleteText"></strong>
			</div>
			<div class="modal-footer">
                <form method="POST">
                    <input type="text" hidden required name="deleteCategory_Id" id="deleteCategory_Id">
                    <input type="submit" hidden name="deleteCategorySubmit" id="deleteCategorySubmit">
                </form>
				<button type="button" class="btn btn-info " onclick="deleteCategorySubmitClick()">Yes</button> 
				<button type="button" class="btn btn-info " data-dismiss="modal" >No</button>		
			</div>
		</div>
	</div>
</div>

</body>

<?php
include("footer.php");
?>



<?php

if(isset($_POST['addCategory'])){
    
    $PItemCode = $_POST['ProductItemCode'];
	$PName = $_POST['ProductName'];
	$PQuantity = $_POST['ProductQuantity'];
	$Pstock = $_POST['ProductStock'];
	$PPrice = $_POST['ProductPrice'];
	$PProfit = $_POST['ProductProfit'];

    $sql = "INSERT INTO product (ItemCode, Name, Quantity, Stock, Price, Profit ) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iiiiii",$PItemCode, $PName, $PQuantity, $Pstock, $PPrice, $PProfit);

    if($stmt->execute()){
        //success
        $_SESSION['category_alert'] = "Product {".$PName."} Added Successfully!";
        $_SESSION['category_action_status'] = "Success";
    } else {
        //failed
        $_SESSION['category_alert'] = "Failed to add the Product!";
        $_SESSION['category_action_status'] = "Failed";
    }
    $stmt->close();
    $con->close();

        ?>
    <script>
    window.location.replace("product.php");
    </script>
    <?php
}



if(isset($_POST['editCategorySubmit'])){
    $PItemCode = $_POST['ProductItemCode_edit'];
	$PName = $_POST['ProductName_edit'];
	$PQuantity = $_POST['ProductQuantity_edit'];
	$Pstock = $_POST['ProductStock_edit'];
	$PPrice = $_POST['ProductPrice_edit'];
	$PProfit = $_POST['ProductProfit_edit'];
    $id = $_POST['selected_category_id_update'];

    $sql = "UPDATE product SET ItemCode = ?, Name = ?, Quantity = ? , Stock = ?, Price = ?, Profit = ? WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iiiiiii", $PItemCode, $PName, $PQuantity, $Pstock, $PPrice, $PProfit, $id);

    if($stmt->execute()){
        //success
        $_SESSION['category_alert'] = "Product {".$PName."} Updated Successfully!";
        $_SESSION['category_action_status'] = "Success";
    } else {
        //failed
        $_SESSION['category_alert'] = "Failed to Update the Product!";
        $_SESSION['category_action_status'] = "Failed";
    }
    $stmt->close();
    $con->close();

        ?>
    <script>
        window.location.replace("product.php");
    </script>
    <?php
}


if(isset($_POST['deleteCategorySubmit'])){
    $id = $_POST['deleteCategory_Id'];

    $sql = "DELETE FROM product WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        //success
        $_SESSION['category_alert'] = "Product Deleted Successfully!";
        $_SESSION['category_action_status'] = "Success";
    } else {
        //failed
        $_SESSION['category_alert'] = "Failed to Delete the Product!";
        $_SESSION['category_action_status'] = "Failed";
    }
    $stmt->close();
    $con->close();

        ?>
    <script>
        window.location.replace("product.php");
    </script>
    <?php
}

?>