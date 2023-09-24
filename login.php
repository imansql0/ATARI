<?php
session_start();
include("config/config.php");
if(isset($_SESSION['user_key'])){
    $userkey = $_SESSION['user_key'];
    $query = "SELECT * FROM users WHERE user_key = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $userkey);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $usertype = $user['usertype'];
        if($usertype == "admin"){
            //navigate to admin
            ?>
            <script>
                window.location.replace("dashboard.php");
            </script>
            <?php
        }else if($usertype == "seller"){
            ?>
            <script>
                window.location.replace("dashboard.php");
            </script>
            <?php
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css?v=1">
    <script src="js/script.js?v=2"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
</head>
<body class="loginMain">

    <div class="mainImageContainer">
        <img src="img/12.jpg" alt="">
    </div>

    <div class="mainlogincontainer">
        <div class="loginTopCon">
            <img src="img/img1.jpg" alt="">
        </div>

        <div class="loginContainer">
            <h1>Login</h1>
            <form method="post">
                
                <div class="formElement">
                    <label for="usertype">Select user type</label>
                    <select name="usertype" id="usertype">
                        <option value="admin">Admin</option>
                        <option value="seller">Seller</option>
                    </select>
                </div>
                <div class="formElement">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter the username" required>
                </div>
                <div class="formElement">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter the password of your account" required>
                </div>
                <div class="formElement formButton">
                    <button type="button" onclick="userLogin()">Login</button>
                    <input type="submit" hidden id="loginButton" name="loginButton">
                </div>
                <div class="formElement">
                    <p>Frogot your password? Please contact the administrators</p>
                </div>

                <?php
                if(isset($_SESSION['userLogin_error'])){
                    ?>
                    <div class="formElement">
                        <p class="text-danger">
                        <?php 
                            echo $_SESSION['userLogin_error']; 
                            if(isset($_SESSION['userLogin_error'])){
                                unset($_SESSION['userLogin_error']);
                            }                        
                        ?></p>
                    </div>
                    <?php
                }
                ?>
            </form>

        </div>
    </div>
</body>
</html>

<?php



if(isset($_POST['loginButton'])){


    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    $query = "SELECT * FROM users WHERE usertype = ? && username = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $username,$usertype);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
       //user not found
       $_SESSION['userLogin_error'] = 'Failed to login. User not found.';
        exit();
    }

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_key'] = $user['user_key'];
        ?>
        <script>
            window.location.replace("index.php")
        </script>
        <?php
    } else {
        $_SESSION['userLogin_error'] = 'Failed to login. Entered password is wrong.';
    }
    ?>
    <script>
        window.location.replace("login.php");
    </script>
    <?php
}


?>