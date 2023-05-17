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
$firstname="";
$lastname="";
$username="";
$password="";
$status="";
$role="";
$res=mysqli_query($link, "select * from user_registration where id=$id");
while($row=mysqli_fetch_array($res))
{
    $firstname=$row["firstname"];
    $lastname=$row["lastname"];
    $username=$row["username"];
    $password=$row["password"];
    $status=$row["status"];
    $role=$row["role"];
}
?>

<!-- Container -->
<div class="container">
        <div id="content">
            
            <div id="content_header">
                <h3>Edit User Form</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                <div class="widget-box">
                <div class="widget-title">
                  <h5>Update User</h5>
                </div>
                <div class="widget-content">
                  <form name="form1" action="" method="post" class="form-horizontal">

                    <div class="control-group">
                      <div class="col-25">
                        <label class="control-label">First Name :</label>
                      </div>
                        
                      <div class="controls col-75">
                        <input type="text" class="span11" placeholder="First name" name="firstname" value="<?php echo $firstname; ?>"/>
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Last Name :</label>
                          </div>
                      
                      <div class="controls col-75">
                        <input type="text" class="span11" placeholder="Last name" name="lastname" value="<?php echo $lastname; ?>"/>
                      </div>
                    </div>
        
                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">User Name :</label>
                          </div>

                      <div class="controls col-75">
                        <input type="text" class="span11" placeholder="User Name" name="username" readonly value="<?php echo $username; ?>"/>
                      </div>
                    </div>
        
                    <div class="control-group">
                        <div class="col-25">
                        <label class="control-label">Password :</label>
                        </div>
                      <div class="controls col-75">
                        <input type="password"  class="span11" placeholder="Enter Password" name="password" value="<?php echo $password; ?>"/>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <div class="col-25">
                        <label class="control-label">Select Role :</label></div>
                      <div class="controls col-75">
                        <select name="role" class="span11">
                            <option <?php if($role=="user") {echo "selected";} ?>>user</option>
                            <option <?php if($role=="admin") {echo "selected";} ?>>admin</option>
                        </select>
                      </div>
                    </div>

                    <div class="control-group">
                      <div class="col-25">
                        <label class="control-label">Select Role :</label></div>
                      <div class="controls col-75">
                        <select name="status" class="span11">
                            <option <?php if($status=="active") {echo "selected";} ?>>active</option>
                            <option <?php if($status=="inactive") {echo "selected";} ?>>inactive</option>
                        </select>
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
    mysqli_query($link,"update user_registration set firstname='$_POST[firstname]',lastname='$_POST[lastname]',password='$_POST[password]',role='$_POST[role]',status='$_POST[status]' where id=$id") or die(mysqli_error($link));

    ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="block";

                // for same page fresh
                setTimeout(function() {
                    window.location="add_new_user.php";
                }, 3000);
            </script>

    <?php
}

?>  


<?php
include "footer.php";
?>
