<?php
session_start();
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>IMS</title>
</head>
<body>
    <!-- Navigation  -->
    <nav class="nav-bar">
        <h1>JD-IMS</h1>
    </nav>
    <br>
    <!-- Left Navigation -->
    <nav class="leftNav v-res-nav" id="rightNav">
        <li>
            <a href="../admin/index.php"><img src="img/admin.png" alt="" class="nav-logo"><span>Admin</span></a>
        </li>
        <li>
            <a href="index.php" class="active"><img src="img/person.png" alt="" class="nav-logo"><span>User</span></a>
        </li>
        

    </nav>

    <div id="burgerBtn" class="burger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>



    <!-- Container -->
    <div class="container">
        <div class="container-box">
            <div class="login-page">
                
                <!-- <p>Log in with your Inventory Management System account to continue.</p> -->
                <form name="form1" action="" method="post">
                    <h2>User Login</h2>
                    <div class="login-container">
                        
                        <label><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="username" required/>
                  
                        <label><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required/>
                          
                        <button type="submit" name="submit1">Login</button>

                        

                        
                    </div>
                </form>
                

        <?php
        if(isset($_POST["submit1"]))
        {
            $username=mysqli_real_escape_string($link,$_POST["username"]);
            $password=mysqli_real_escape_string($link,$_POST["password"]);

            $count=0;
            $res=mysqli_query($link, "select * from user_registration where username='$username' && password='$password' && role='user' && status='active'");

            $count=mysqli_num_rows($res);

            if($count>0)
            {
                $_SESSION["user"]=$username;
                ?>
                <script type="text/javascript">
                    window.location="dashboard.php";
                </script>
                <?php
            }
            else{
                ?>
                <div class="alert_danger">
                    <p>Invalid username or password<br>
                    or <br>
                    Account blocked by admin.</p>
                </div>
                <?php
            }

            // echo $count;
        }
        ?>


            </div>
            
        </div>  
    </div>


    


    <script>
        burger = document.querySelector('.burger')
        leftNav = document.querySelector('.leftNav')

        burger.addEventListener('click', ()=>{
            leftNav.classList.toggle('v-res-nav');
        })
    </script>


</body>
</html>