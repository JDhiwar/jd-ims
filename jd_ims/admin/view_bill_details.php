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
$id=$_GET["id"];
$full_name="";
$bill_type="";
$date="";
$bill_no="";
$res=mysqli_query($link,"select * from billing_header where id=$id");
while($row=mysqli_fetch_array($res))
{
    $full_name=$row["full_name"];
    $bill_type=$row["bill_type"];
    $date=$row["date"];
    $bill_no=$row["bill_no"];
}
?>

<!-- Container -->
<div class="container">
        <div id="content">
            
            <div id="content_header">
                <h3>Detailed Bills</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                <center>
                <h4>Detailed Bills</h4>
                </center>

                <table>
                <tr>
                    <td>Bill No:</td>
                    <td><?php echo $bill_no; ?></td>
                </tr>
                <tr>
                    <td>Full Name:</td>
                    <td><?php echo $full_name; ?></td>
                </tr>
                <tr>
                    <td>Bill Type:</td>
                    <td><?php echo $bill_type; ?></td>
                </tr>
                <tr>
                    <td>Bill Date:</td>
                    <td><?php echo $date; ?></td>
                </tr>
            </table>

        <div class="widget-content">

          <table>
                <tr>
                    <th>Product Company</th>
                    <th>Product Name</th>
                    <th>Product Unit</th>
                    <th>Packing Size</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
                <?php
                $total=0;
                $res=mysqli_query($link,"select * from billing_details where bill_id=$id");
                while($row=mysqli_fetch_array($res))
                {
                    echo "<tr>";
                    echo "<td>"; echo $row["product_company"]; echo "</td>";
                    echo "<td>"; echo $row["product_name"]; echo "</td>";
                    echo "<td>"; echo $row["product_unit"]; echo "</td>";
                    echo "<td>"; echo $row["packing_size"]; echo "</td>";
                    echo "<td>"; echo $row["price"]; echo "</td>";
                    echo "<td>"; echo $row["qty"]; echo "</td>";
                    echo "<td>"; echo ($row["price"]*$row["qty"]); echo "</td>";
                    echo "</tr>";
                    $total=$total+($row["price"]*$row["qty"]);
                }
                ?>
                
          </table>
            <div align="right" style="font-weight: bold">
                Grand Total: &#8377; <?php echo $total; ?>
            </div>
        </div>


    </div>

   
<?php
include "footer.php";
?>
