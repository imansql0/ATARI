<?php


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
        if($usertype != "user"){
            //navigate to admin
            session_destroy();
            ?>
            <script>
                window.location.replace("login.php");
            </script>
            <?php
        }
    }else{
        session_destroy();
            ?>
            <script>
                window.location.replace("login.php");
            </script>
            <?php
    }
}else{
    session_destroy();
        ?>
        <script>
            window.location.replace("login.php");
        </script>
        <?php
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css?v=1.4">
    <script src="js/script.js?v=1.2"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
</head>
<body>

<div class="webMainCon">
<div class="dashboardContainer">
    <div class="navbarContainer">
        

    
    <nav class="navContainer">
    <?php  
    
    $selectedNav = $_SESSION['navId'];  

    $firstname = "Iman";
    $lastname = "Weerasekara";
    $username = "ïmantha";
    ?>

    <div class="navelcon">
        <div class="logoContainer">
            <img src="img/img1.jpg" alt="">
        </div>
        <?php
            if($selectedNav == "dashboard"){?>
                <div class="navEle selected" onclick="systemadminnavclick('dashboard')">Dashboard</div>
            <?php }else{ ?>
                <div class="navEle" onclick="systemadminnavclick('dashboard')">Dashboard</div>
            <?php }
        ?>
        
    </div>

    <div class="cnp01">
        <div class="cnp_sub">
            <div class="profileimgcon">
                <img src="../images/admin.png" alt="">
            </div>
            <div class="cnp_txt_cn">
                <h5><?php echo $firstname," ",$lastname; ?></h5>
                <h6><?php echo $username; ?></h6>
                <h6>System Admin</h6>
            </div>
        </div>
    </div>

</nav>



    </div>

    <div class="contentContainer" id="contentContainer">
