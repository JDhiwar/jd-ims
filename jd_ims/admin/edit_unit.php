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
$unit="";

$res=mysqli_query($link, "select * from units where id=$id");
while($row=mysqli_fetch_array($res))
{
    $unit=$row["unit"];
}
?>



    <!-- Container -->
    <div class="container">
        <div id="content">
            
            <div id="content_header">
                <h3>Unit Form</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                <div class="widget-box">
                <div class="widget-title">
                  <h5>Edit Unit</h5>
                </div>
                <div class="widget-content">
                  <form name="form1" action="" method="post" class="form-horizontal">

                    <div class="control-group">
                      <div class="col-25">
                        <label class="control-label">Unit Name :</label>
                      </div>
                        
                      <div class="controls col-75">
                        <input type="text" class="span11" placeholder="Unit name" name="unitname" value="<?php echo $unit; ?>"/>
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
    mysqli_query($link,"update units set unit='$_POST[unitname]' where id=$id") or die(mysqli_error($link));

    ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="block";

                // for same page fresh
                setTimeout(function() {
                    window.location="add_new_unit.php";
                }, 3000);
            </script>

    <?php
}

?>


<?php
include "footer.php";
?>