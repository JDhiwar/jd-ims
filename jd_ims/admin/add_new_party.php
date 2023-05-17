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
                <h3>Party Form</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                <div class="widget-box">
                <div class="widget-title">
                  <h5>Add New Party</h5>
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
                            <label class="control-label">Business Name :</label>
                          </div>

                      <div class="controls col-75">
                      <input type="text" class="span11" placeholder="Business Name" name="businessname" />
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Contact :</label>
                          </div>

                      <div class="controls col-75">
                      <input type="text"  class="span11" placeholder="Enter Contanct No" name="contact" />
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Address :</label>
                          </div>

                      <div class="controls col-75">
                      <textarea class="span11" name="address"></textarea>
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">City :</label>
                          </div>

                      <div class="controls col-75">
                      <input type="text"  class="span11" placeholder="Enter City" name="city" />
                      </div>
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
                  <th>Business Name</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $res=mysqli_query($link, "select * from party_info");
                while($row=mysqli_fetch_array($res))
                {
                    ?>
                    <tr>
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"]; ?></td>
                        <td><?php echo $row["businessname"]; ?></td>
                        <td><?php echo $row["contact"]; ?></td>
                        <td><?php echo $row["address"]; ?></td>
                        <td><?php echo $row["city"]; ?></td>
                        <td><a href="edit_party.php?id=<?php echo $row["id"]; ?>" class="td-edit">Edit</a></td>
                        <td><a href="delete_party.php?id=<?php echo $row["id"]; ?>" class="td-delete">Delete</a></td>
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
    
        mysqli_query($link,"insert into party_info values(NULL,'$_POST[firstname]','$_POST[lastname]','$_POST[businessname]','$_POST[contact]','$_POST[address]','$_POST[city]')") or die(mysqli_error($link));

        ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="block";

                // for same page fresh
                setTimeout(function() {
                    window.location.href=window.location.href;
                }, 3000);
            </script>
        <?php
    
}
?>   


<?php
include "footer.php";
?>
