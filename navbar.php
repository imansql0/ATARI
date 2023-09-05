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
        if($usertype != "admin"){
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
    <link rel="stylesheet" href="css/style.css?v=2">
    <script src="js/script.js?v=2"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	
    <script src="app.js"></script>
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
    $username = $user['username'];
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
        
        <?php
            if($selectedNav == "product"){?>
                <div class="navEle selected" onclick="systemadminnavclick('product')">Product</div>
            <?php }else{ ?>
                <div class="navEle" onclick="systemadminnavclick('product')">Product</div>
            <?php }
        ?>
         <?php
            if($selectedNav == "category"){?>
                <div class="navEle selected" onclick="systemadminnavclick('category')">Category</div>
            <?php }else{ ?>
                <div class="navEle" onclick="systemadminnavclick('category')">Category</div>
            <?php }
        ?>

        <?php
            if($selectedNav == "history"){?>
                <div class="navEle selected" onclick="systemadminnavclick('history')">History</div>
            <?php }else{ ?>
                <div class="navEle" onclick="systemadminnavclick('history')">History</div>
            <?php }
        ?>
         <?php
            if($selectedNav == ""){?>
                <div class="navEle selected" onclick="systemadminnavclick('')">Dashboard</div>
            <?php }else{ ?>
                <div class="navEle" onclick="systemadminnavclick('')">Dashboard</div>
            <?php }
        ?>
          
    </div>
    <?php
    
     if(isset($_POST['logoutButton'])){
       
        session_destroy();
        ?>
        <script>
            window.location.replace("login.php");
        </script>
        <?php
        
    }
    ?>

    <div class="cnp01">
        <div class="cnp_sub">
            <div class="profileimgcon">
                <img src="../images/admin.png" alt="">
            </div>
            <div class="cnp_txt_cn">
               
                <h6><?php echo $username; ?></h6>
                
                <div class="formElement formButton">
           <form method="post">
                    <button type="button" onclick="userLogout()">Logout</button>
                    <input type="submit" hidden id="logoutButton" name="logoutButton">
            </form>
                </div>
            </div>
        </div>
    </div>
   

</nav>



    </div>

    <div class="contentContainer" id="contentContainer">
