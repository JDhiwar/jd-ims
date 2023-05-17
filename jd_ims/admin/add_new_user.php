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
                <h3>User Form</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                <div class="widget-box">
                <div class="widget-title">
                  <h5>Add New User</h5>
                </div>
                <div class="widget-content">
                  <form name="form1" action="" method="post" class="form-horizontal">

                    <div class="control-group">
                      <div class="col-25">
                        <label class="control-label">First Name :</label>
                      </div>
                        
                      <div class="controls col-75">
                        <input type="text" class="span11" placeholder="First name" name="firstname" />
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Last Name :</label>
                          </div>
                      
                      <div class="controls col-75">
                        <input type="text" class="span11" placeholder="Last name" name="lastname" />
                      </div>
                    </div>
        
                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">User Name :</label>
                          </div>

                      <div class="controls col-75">
                        <input type="text" class="span11" placeholder="User Name" name="username" />
                      </div>
                    </div>
        
                    <div class="control-group">
                        <div class="col-25">
                        <label class="control-label">Password :</label>
                        </div>
                      <div class="controls col-75">
                        <input type="password"  class="span11" placeholder="Enter Password" name="password" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <div class="col-25">
                        <label class="control-label">Select Role :</label></div>
                      <div class="controls col-75">
                        <select name="role" class="span11">
                            <option>user</option>
                            <option>admin</option>
                        </select>
                      </div>
                    </div>
        
        
                    <div class="alert_danger" id="error" style="display:none">
                        This Username Already Exist! Please Try Another.
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>User Name</th>
                <th>Role</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php
                $res=mysqli_query($link, "select * from user_registration");
                while($row=mysqli_fetch_array($res))
                {
                    ?>
                    <tr>
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["role"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>
                        <td><a href="edit_user.php?id=<?php echo $row["id"]; ?>" class="td-edit">Edit</a></td>
                        <td><a href="delete_user.php?id=<?php echo $row["id"]; ?>" class="td-delete">Delete</a></td>
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
    $res=mysqli_query($link, "select * from user_registration where username='$_POST[username]'");
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
        mysqli_query($link,"insert into user_registration values(NULL,'$_POST[firstname]','$_POST[lastname]','$_POST[username]','$_POST[password]','$_POST[role]','active')");

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
