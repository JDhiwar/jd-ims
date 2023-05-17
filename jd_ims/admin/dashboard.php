<?php
session_start();
if(!isset($_SESSION["admin"]))
{
  ?>
  <script type="text/javascript">
    window.location="index.php";
  </script>
  <?php
}
?>


<?php
include "base.php";
include "../user/connection.php";
?>



    <!-- Container -->
    <div class="container">
        <div id="content">
            
            <div id="content_header">
                <h3>Dashboard</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    <h2 class="jd">JD - Inventory Management System</h2>
                    <br>
                    <div class="card-group">
                    <div class="card col-40">
                        <div class="card-container">
                          <h2><b>Number of Products</b></h2>
                          <img src="img/products.png" alt="" style="width:40px; margin: 20px;">
                          <h2><b><?php
                        $count=0;
                        $res=mysqli_query($link,"select * from products");
                        $count=mysqli_num_rows($res);
                        echo $count;
                        ?></b></h2>
                        </div>
                    </div>

                    <div class="card col-40">
                        <div class="card-container">
                          <h2><b>Total Orders</b></h2>
                          <img src="img/order.png" alt="" style="width:40px; margin: 20px;">
                          <h2><b>
                          <?php
                        $count=0;
                        $res=mysqli_query($link,"select * from billing_header");
                        $count=mysqli_num_rows($res);
                        echo $count;
                        ?>
                          </b></h2>
                        </div>
                    </div>

                    <div class="card col-40">
                        <div class="card-container">
                          <h2><b>Number of Company</b></h2>
                          <img src="img/company.png" alt="" style="width:40px; margin: 20px;">
                          <h2><b>
                          <?php
                        $count=0;
                        $res=mysqli_query($link,"select * from company_name");
                        $count=mysqli_num_rows($res);
                        echo $count;
                        ?>
                          </b></h2>
                        </div>
                    </div>

                    <div class="card col-40">
                        <div class="card-container">
                          <h2><b>Total Users</b></h2>
                          <img src="img/groups.png" alt="" style="width:40px; margin: 20px;">
                          <h2><b>
                            <?php
                            $count=0;
                            $res=mysqli_query($link,"select * from user_registration");
                            $count=mysqli_num_rows($res);
                            echo $count;
                            ?>
                          </b></h2>
                        </div>
                    </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


<?php
include "footer.php";
?>
