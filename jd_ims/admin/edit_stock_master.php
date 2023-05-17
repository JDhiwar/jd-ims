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
$product_company="";
$product_name="";
$product_unit="";
$product_qty="";
$product_selling_price="";

$res=mysqli_query($link, "select * from stock_master where id=$id");
while($row=mysqli_fetch_array($res))
{
    $product_company=$row["product_company"];
    $product_name=$row["product_name"];
    $product_unit=$row["product_unit"];
    $product_qty=$row["product_qty"];
    $product_selling_price=$row["product_selling_price"];
}

?>

<!-- Container -->
<div class="container">
        <div id="content">
            
            <div id="content_header">
                <h3>Update Stocks Price</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                <div class="widget-box">
                <div class="widget-title">
                  <h5>Edit Stocks Price</h5>
                </div>
                <div class="widget-content">
                  <form name="form1" action="" method="post" class="form-horizontal">

                    <div class="control-group">
                      <div class="col-25">
                        <label class="control-label">Product Company :</label>
                      </div>
                        
                      <div class="controls col-75">
                      <input type="text" name="product_company" class="span12" value="<?php echo $product_company; ?>" readonly/>
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Product Name :</label>
                        </div>
                      
                      <div class="controls col-75" id="product_name_div">
                        <input type="text" name="product_name" class="span12" placeholder="Enter Product Name" value="<?php echo $product_name; ?>" readonly/>
                      </div>
                    </div>
        
                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Product Unit :</label>
                        </div>

                      <div class="controls col-75" id="unit_div">
                        <input type="text" name="product_unit" class="span12" placeholder="Enter Packing Size" value="<?php echo $product_unit; ?>" readonly/>
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Product Qty :</label>
                        </div>

                      <div class="controls col-75" id="packing_size_div">
                        <input type="text" name="product_qty" class="span12" placeholder="Enter Packing Size" value="<?php echo $product_qty; ?>" readonly/>
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                        <label class="control-label">Product Selling Price :</label>
                          </div>

                      <div class="controls col-75">
                      <input type="text" name="product_selling_price" class="span11" placeholder="Enter Packing Size" value="<?php echo $product_selling_price; ?>" />
                      </div>
                    </div>

                    <hr>
        
                    <div class="form-actions">
                      <button type="submit" name="submit1" class="btn">Update</button>
                    </div>
        
        
                    <div class="alert_success" id="success" style="display:none">
                        Record Updated Successfully!
                    </div>
        
        
                  </form>
                </div> 
        </div> 

    </div>

  
<?php
if(isset($_POST["submit1"]))
{
    mysqli_query($link, "update stock_master set product_selling_price='$_POST[product_selling_price]' where id=$id") or die(mysqli_error($link));
    
    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
        setTimeout(function(){
            window.location="stock_master.php";
        },2000);
    </script>
    <?php
    
}
?>


<?php
include "footer.php";
?>
