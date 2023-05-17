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
                <h3>Unit Form</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                <div class="widget-box">
                <div class="widget-title">
                  <h5>Add New Unit</h5>
                </div>
                <div class="widget-content">
                  <form name="form1" action="" method="post" class="form-horizontal">

                    <div class="control-group">
                      <div class="col-25">
                        <label class="control-label">Unit Name :</label>
                      </div>
                        
                      <div class="controls col-75">
                        <input type="text" class="span11" placeholder="Unit name" name="unitname" />
                      </div>
                    </div>
        
        
                    <div class="alert_danger" id="error" style="display:none">
                        This Unit Already Exist! Please Try Another.
                    </div>

                    <hr>
        
                    <div class="form-actions">
                      <button type="submit" name="submit1" class="btn">Add</button>
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
                <th>Unit Name</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
                <?php
                $res=mysqli_query($link, "select * from units");
                while($row=mysqli_fetch_array($res))
                {
                    ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["unit"]; ?></td>
                        <td><center><a class="td-edit" href="edit_unit.php?id=<?php echo $row["id"]; ?>" style="color: green">Edit</a></center></td>
                        <td><center><a class="td-delete" href="delete_unit.php?id=<?php echo $row["id"]; ?>" style="color:red">Delete</a></center></td>
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
    $res=mysqli_query($link, "select * from units where unit='$_POST[unitname]'");
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
        mysqli_query($link,"insert into units values(NULL,'$_POST[unitname]')") or die(mysqli_error($link));

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