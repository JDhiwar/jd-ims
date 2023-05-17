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
$company_name="";
$product_name="";
$unit="";
$packing_size="";

$res=mysqli_query($link, "select * from products where id=$id");
while($row=mysqli_fetch_array($res))
{
    $company_name=$row["company_name"];
    $product_name=$row["product_name"];
    $unit=$row["unit"];
    $packing_size=$row["packing_size"];
}
?>

<!-- Container -->
<div class="container">
        <div id="content">
            
            <div id="content_header">
                <h3>Update Products</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                <div class="widget-box">
                <div class="widget-title">
                  <h5>Edit Products</h5>
                </div>
                <div class="widget-content">
                  <form name="form1" action="" method="post" class="form-horizontal">

                    <div class="control-group">
                      <div class="col-25">
                        <label class="control-label">Select Company :</label>
                      </div>
                        
                      <div class="controls col-75">
                        <select class="span11" name="company_name">
                        <?php
                        $res=mysqli_query($link,"select * from company_name");
                        while($row=mysqli_fetch_array($res))
                        {
                            echo "<option>";
                            echo $row["companyname"];
                            echo "</option>";
                        }

                        ?>
                        </select>
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Enter Product Name :</label>
                        </div>
                      
                      <div class="controls col-75">
                        <input type="text" name="product_name" class="span11" placeholder="Enter Product Name" value="<?php echo $product_name; ?>">
                      </div>
                    </div>
        
                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Select Unit :</label>
                          </div>

                      <div class="controls col-75">
                      <select class="span11" name="unit">
                        <?php
                        $res=mysqli_query($link,"select * from units");
                        while($row=mysqli_fetch_array($res))
                        {
                            echo "<option>";
                            echo $row["unit"];
                            echo "</option>";
                        }

                        ?>
                        </select>
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Enter Packing Size :</label>
                          </div>

                      <div class="controls col-75">
                      <input type="text" name="packing_size" class="span11" placeholder="Enter Packing Size" value="<?php echo $packing_size; ?>">
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
    $count=0;
    $res=mysqli_query($link, "update products set product_name='$_POST[product_name]' where id=$id") or die(mysqli_error($link));
    

        ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="block";

                // for same page fresh
                setTimeout(function() {
                    window.location="add_products.php";
                }, 3000);
            </script>
        <?php
    
}
?> 


<?php
include "footer.php";
?>
