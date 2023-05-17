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
                <h3>Add Products</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                <div class="widget-box">
                <div class="widget-title">
                  <h5>Add New Products</h5>
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
                        <input type="text" name="product_name" class="span11" placeholder="Enter Product Name">
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
                      <input type="text" name="packing_size" class="span11" placeholder="Enter Packing Size">
                      </div>
                    </div>

                    <div class="alert_danger" id="error" style="display:none">
                        This Products is Already Exist! Please Try Another.
                    </div>

                    <hr>
        
                    <div class="form-actions">
                      <button type="submit" name="submit1" class="btn">Save</button>
                    </div>
        
        
                    <div class="alert_success" id="success" style="display:none">
                        Record Inserted Successfully!
                    </div>
        
        
                  </form>
                </div> 
        </div> 

        <div class="widget-content">
          <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Company Name</th>
                    <th>Product Name</th>
                    <th>Unit</th>
                    <th>Packing Size</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $res=mysqli_query($link, "select * from products");
                while($row=mysqli_fetch_array($res))
                {
                    ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["company_name"]; ?></td>
                        <td><?php echo $row["product_name"]; ?></td>
                        <td><?php echo $row["unit"]; ?></td>
                        <td><?php echo $row["packing_size"]; ?></td>
                        <td><a href="edit_products.php?id=<?php echo $row["id"]; ?>" class="td-edit">Edit</a></td>
                        <td><a href="delete_products.php?id=<?php echo $row["id"]; ?>" class="td-delete">Delete</a></td>
                    </tr>

                    <?php
                }
                ?>

            </tbody>
          </table>
        </div>
    </div>

<?php
if(isset($_POST["submit1"]))
{
    $count=0;
    $res=mysqli_query($link, "select * from products where company_name='$_POST[company_name]' && product_name='$_POST[product_name]' && unit='$_POST[unit]' && packing_size='$_POST[packing_size]'") or die(mysqli_error($link));
    $count=mysqli_num_rows($res); 
    if($count>0)
    {
        ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="none";
                document.getElementById("error").style.display="block";
            </script>
        <?php
    }
    else{
        mysqli_query($link,"insert into products values(NULL,'$_POST[company_name]','$_POST[product_name]','$_POST[unit]','$_POST[packing_size]')") or die(mysqli_error($link));

        ?>
            <script type="text/javascript">
                document.getElementById("error").style.display="none";
                document.getElementById("success").style.display="block";

                // for same page fresh
                setTimeout(function() {
                    window.location.href=window.location.href;
                }, 3000);
            </script>
        <?php
    }
}
?>  


<?php
include "footer.php";
?>
