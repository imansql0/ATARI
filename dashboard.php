<?php
include("config/config.php");
session_start();
$_SESSION['navId'] = "dashboard";
include("navbar.php");

?>

<div class="wrapper">
        <!-- PRICING-TABLE CONTAINER -->
        <div class="pricing-table group">
            <h1 class="heading">
                Pricing overview
            </h1>
            <!-- PERSONAL -->
            <div class="block personal fl">
                <h2 class="title">Online orders</h2>
                <!-- CONTENT -->
                <div class="content">
                    <p class="price">
                      
                        <span>100</span>
                      
                    </p>
                    <p class="hint">Undelivered</p>
                </div>
                <!-- /CONTENT -->
                <!-- FEATURES -->
                <!-- <ul class="features">
                    <li><span class="fontawesome-cog"></span>1 WordPress Install</li>
                  
                </ul> -->
                <!-- /FEATURES -->
                <!-- PT-FOOTER -->
                <div class="pt-footer">
                    <p>Wizard Chamber</p>
                </div>
                <!-- /PT-FOOTER -->
            </div>
            <!-- /PERSONAL -->
            <!-- PROFESSIONAL -->
            <div class="block professional fl">
                <h2 class="title">Undelivered Orders</h2>
                <!-- CONTENT -->
                <div class="content">
                    <p class="price">
                    
                        <span>10</span>
                      
                    </p>
                    <p class="hint">Suitable for startups</p>
                </div>
                <!-- /CONTENT -->
                <!-- FEATURES -->
                <!-- <ul class="features">
                    <li><span class="fontawesome-cog"></span>10 WordPress Install</li>
                 
                </ul> -->
                <!-- /FEATURES -->
                <!-- PT-FOOTER -->
                <div class="pt-footer">
                    <p>Wizard Chamber</p>
                </div>
                <!-- /PT-FOOTER -->
            </div>
            <!-- /PROFESSIONAL -->
            <!-- BUSINESS -->
            <div class="block business fl">
                <h2 class="title">Total earning</h2>
                <!-- CONTENT -->
                <div class="content">
                    <p class="price">
                       
                        <span>Rs:100000</span>
                       
                    </p>
                    <p class="hint">For established business</p>
                </div>
                <!-- /CONTENT -->

                <!-- FEATURES -->
                <!-- <ul class="features">
                    <li><span class="fontawesome-cog"></span>25 WordPress Install</li>
                   
                </ul> -->
                <!-- /FEATURES -->

                <!-- PT-FOOTER -->
                <div class="pt-footer">
                    <p>Wizard Chamber</p>
                </div>
                <!-- /PT-FOOTER -->
            </div>
            <!-- /BUSINESS -->
        </div>
        <!-- /PRICING-TABLE -->
    </div>
    
<?php
include("footer.php");
?>