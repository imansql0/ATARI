<?php
include("config/config.php");
session_start();
$_SESSION['navId'] = "category";
include("navbar.php");


$categories = array();
$sql = "SELECT * FROM category";
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
	<h1>All Categories</h1>
	<span class="clearfix"></span>
	<hr>


    <!--alert-->
    <?php
    
    if(isset($_SESSION['category_alert']) && isset($_SESSION['category_action_status'])){
        if($_SESSION['category_action_status'] == "Success"){
            ?>
            <div class="alert alert-success alert-dismissable" ng-if="messageInfo">
                Message
            </div>
            <?php
        }else{
            ?>
            <div class="alert alert-danger alert-dismissable" ng-if="messageInfo">
                Message
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
					<th>Name</th>
					<th>Description</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>

                <?php
                foreach ($categories as $index => $category) {
                    ?>
                    
                    <tr ng-repeat="user in users">
                        <td><?php echo $category['id'];?></td>
                        <td><?php echo $category['name'];?></td>
                        <td><?php echo $category['description'];?></td>
                        <td><button type="button" class=" btn btn-info" data-toggle="modal" data-target="#modaledit" ng-click="selectUser(user)">Edit</button></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaldelete" ng-click="selectUser(user)">Delete</button></td>
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
						<label class="control-label col-md-2">Category Name</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="categoryName">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Category Description</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="categoryDescription">
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
				<h4 class="modal-title">Edit Record</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-md-2">Username</label>
						<div class="col-md-10">
							<input type="text" class="form-control" ng-model="clickedUser.username">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Full Name</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" ng-model="clickedUser.fullname">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Email</label>
						<div class="col-md-10">
							<input type="email" class=" form-control"  ng-model="clickedUser.email">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2 col-md-offset-2">
							<button type="submit" class="btn btn-info " ng-click="updateUser()" data-dismiss="modal">Update</button>
						</div>
					</div>
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
				<strong style="color:red;">You are going to delete {{clickedUser.username}}</strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info " data-dismiss="modal" ng-click="deleteUser()">Yes</button> 
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
    $name = $_POST['categoryName'];
    $description = $_POST['categoryDescription'];

    $sql = "INSERT INTO category (name, description) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $name, $description);

    if($stmt->execute()){
        //success
        $_SESSION['category_alert'] = "Category Added Successfully!";
        $_SESSION['category_action_status'] = "Success";
    } else {
        //failed
        $_SESSION['category_alert'] = "Failed to add the Category!";
        $_SESSION['category_action_status'] = "Failed";
    }
    $stmt->close();
    $con->close();

        ?>
    <script>
    window.location.replace("category.php");
    </script>
    <?php
}

?>