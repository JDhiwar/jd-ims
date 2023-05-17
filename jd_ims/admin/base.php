<?php
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active';
  } 
}
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
        <h1>JD - IMS</h1>
    </nav>
    <br>
    <!-- Left Navigation -->
    <nav class="leftNav v-res-nav" id="rightNav">
        <li>
            <a href="dashboard.php" class="<?php active('dashboard.php');?>"><img src="img/dashboard.png" alt="" class="nav-logo"><span>Dashboard</span></a>
        </li>

        <li>
            <a href="add_new_user.php" class="<?php active('add_new_user.php');?>"><img src="img/add_user.png" alt="" class="nav-logo"><span>Add New User</span></a>
        </li>
        
        <li>
            <a href="add_new_unit.php" class="<?php active('add_new_unit.php');?>"><img src="img/unit.png" alt="" class="nav-logo"><span>Add Units</span></a>
        </li>

        <li>
            <a href="add_company.php" class="<?php active('add_company.php');?>"><img src="img/add_company.png" alt="" class="nav-logo"><span>Add Company</span></a>
        </li>

        <li>
            <a href="add_new_party.php" class="<?php active('add_new_party.php');?>"><img src="img/party.png" alt="" class="nav-logo"><span>Add Party</span></a>
        </li>

        <li>
            <a href="add_products.php" class="<?php active('add_products.php');?>"><img src="img/add_product.png" alt="" class="nav-logo"><span>Add Product</span></a>
        </li>

        <li>
            <a href="purchase_master.php" class="<?php active('purchase_master.php');?>"><img src="img/purchase.png" alt="" class="nav-logo"><span>Purchase</span></a>
        </li>

        <li>
            <a href="sales_master.php" class="<?php active('sales_master.php');?>"><img src="img/sales.png" alt="" class="nav-logo"><span>Sales</span></a>
        </li>

        <li>
            <a href="stock_master.php" class="<?php active('stock_master.php');?>"><img src="img/stock.png" alt="" class="nav-logo"><span>View Stocks</span></a>
        </li>

        <li>
            <a href="view_bills.php" class="<?php active('view_bills.php');?>"><img src="img/bills.png" alt="" class="nav-logo"><span>View Bills</span></a>
        </li>

        

        

        <li>
            <a href="logout.php"><img src="img/logout.png" alt="" class="nav-logo"><span>Logout</span></a>
        </li>
        

    </nav>

    <div id="burgerBtn" class="burger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>