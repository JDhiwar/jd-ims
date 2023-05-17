<?php
session_start();
if(!isset($_SESSION["user"]))
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
                <h3>Stocks</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                 

        <div class="widget-content">
          <table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Product Company</th>
                    <th>Product Name</th>
                    <th>Product Unit</th>
                    <th>Product Qty</th>
                    <th>Product Selling Price</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $count=0;
                $res=mysqli_query($link, "select * from stock_master");
                while($row=mysqli_fetch_array($res))
                {
                    $count=$count+1;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row["product_company"]; ?></td>
                        <td><?php echo $row["product_name"]; ?></td>
                        <td><?php echo $row["product_unit"]; ?></td>
                        <td><?php echo $row["product_qty"]; ?></td>
                        <td><?php echo $row["product_selling_price"]; ?></td>
                        
                    </tr>

                    <?php
                }
                ?>

            </tbody>
          </table>
        </div>


    </div>

   
<?php
include "footer.php";
?>
