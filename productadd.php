<?php
include("config/config.php");
session_start();
$_SESSION['navId'] = "product";
include("navbar.php");

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post">
            <div class="addContainer">
               
                <div class="addform">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter the name" required>
                </div>
                <div class="addform">
                    <label for="description">Description</label>
                    <input type="description" name="description" id="description" placeholder="Enter the description" required>
                </div>
                <div class="addform">
                    <label for="description">Description</label>
                    <input type="description" name="description" id="description" placeholder="Enter the description" required>
                </div>
                <div class="addform">
                    <label for="description">Description</label>
                    <input type="description" name="description" id="description" placeholder="Enter the description" required>
                </div>
                <div class="addform">
                    <label for="description">Description</label>
                    <input type="description" name="description" id="description" placeholder="Enter the description" required>
                </div>
                <div class="addform">
                    <label for="description">Description</label>
                    <input type="description" name="description" id="description" placeholder="Enter the description" required>
                </div>
                <div class="addformbutton">
                    <button type="button" onclick="submitCategory()">Submit</button>
                    <input type="submit" hidden id="submit" name="submit">
                </div>
            </div>  
               

</form>
<?php
if(isset($_POST['submit'])){
$name=$_POST['name'];
$description=$_POST['description'];
$sql = "INSERT INTO category (name,description) VALUES (?, ?)";
$stmt = $con->prepare($sql);
if ($stmt === false) {
    die("Error in SQL statement: " . $conn->error);
}
$stmt->bind_param("ss", $name, $description);
if ($stmt->execute() === true) {
    echo "Record inserted successfully.";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$con->close();
}
?>   

</body>
</html>




<?php
include("footer.php");
?>