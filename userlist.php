<?php
include("config/config.php");
session_start();
$_SESSION['navId'] = "userlist";
include("navbar.php");


$categories = array();
$sql = "SELECT * FROM users";
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
	<h1>All Users</h1>
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
					<th>UserType</th>
					<th>Username</th>
					<th>Password</th>
					<th>Userkey</th>
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
                        <td><?php echo $category['usertype'];?></td>
                        <td><?php echo $category['username'];?></td>
						<td><?php echo $category['password'];?></td>
                        <td><?php echo $category['user_key'];?></td>
                        <td><button type="button" class=" btn btn-info" data-toggle="modal" data-target="#modaledit" onclick="userEdit('<?php echo $category['id'];?>','<?php echo $category['usertype'];?>','<?php echo $category['username'];?>','<?php echo $category['password'];?>','<?php echo $category['user_key'];?>')">Edit</button></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaldelete" onclick="userDelete('<?php echo $category['id'];?>','<?php echo $category['usertype'];?>','<?php echo $category['username'];?>','<?php echo $category['password'];?>','<?php echo $category['user_key'];?>')">Delete</button></td>
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
						<label class="control-label col-md-2">User type</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="usertype">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Username</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="username">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Password</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="password">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">User key</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="userkey">
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
						<label class="control-label col-md-2">User type</label>
						<div class="col-md-10">
							<input type="text" class="form-control" required name="usertypeedit" id="usertypeedit">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Username</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="usernameedit" id="usernameedit">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Password</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="passwordedit" id="passwordedit">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">User key</label>
						<div class="col-md-10">
							<input type="text" class=" form-control" required name="userkeyedit" id="userkeyedit">
						</div>
					</div>
				

					<div class="form-group">
						<div class="col-md-2 col-md-offset-2">
							<button type="button" class="btn btn-info " onclick="updateuser()">Update</button>
						</div>
					</div>

                    <!-- hidden input field for saving the selected category ID -->
                    <input type="text"   hidden name="selected_category_id_update" required id="selected_category_id_update">
                    <input type="submit"   hidden name="editCategorySubmit" id="editCategorySubmit">

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
    
    $usertype = $_POST['usertype'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$userkey = $_POST['userkey'];


    $sql = "INSERT INTO users (usertype, username, password, user_key) VALUES ( ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss",$usertype, $username, $password, $userkey);

    if($stmt->execute()){
        //success
        $_SESSION['category_alert'] = "User {".$username."} Added Successfully!";
        $_SESSION['category_action_status'] = "Success";
    } else {
        //failed
        $_SESSION['category_alert'] = "Failed to add the User!";
        $_SESSION['category_action_status'] = "Failed";
    }
    $stmt->close();
    $con->close();

        ?>
    <script>
    window.location.replace("userlist.php");
    </script>
    <?php
}



if(isset($_POST['editCategorySubmit'])){
    $usertype = $_POST['usertypeedit'];
	$username = $_POST['usernameedit'];
	$password = $_POST['passwordedit'];
	$userkey = $_POST['userkeyedit'];
    $id = $_POST['selected_category_id_update'];

    $sql = "UPDATE users SET usertype = ?, username = ?, password = ? , user_key = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssi",$usertype, $username, $password, $userkey,$id);

    if($stmt->execute()){
        //success
        $_SESSION['category_alert'] = "User {".$username."} Updated Successfully!";
        $_SESSION['category_action_status'] = "Success";
    } else {
        //failed
        $_SESSION['category_alert'] = "Failed to Update the User!";
        $_SESSION['category_action_status'] = "Failed";
    }
    $stmt->close();
    $con->close();

        ?>
    <script>
        window.location.replace("userlist.php");
    </script>
    <?php
}


if(isset($_POST['deleteCategorySubmit'])){
    $id = $_POST['deleteCategory_Id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        //success
        $_SESSION['category_alert'] = "User Deleted Successfully!";
        $_SESSION['category_action_status'] = "Success";
    } else {
        //failed
        $_SESSION['category_alert'] = "Failed to Delete the User!";
        $_SESSION['category_action_status'] = "Failed";
    }
    $stmt->close();
    $con->close();

        ?>
    <script>
        window.location.replace("userlist.php");
    </script>
    <?php
}

?>