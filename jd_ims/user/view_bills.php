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
                <h3>View Bills</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                 

        <div class="widget-content">
          <table>
            
                <tr>
                    <th>Bill No</th>
                    <th>Full Name</th>
                    <th>Bill Type</th>
                    <th>Bill Date</th>
                    <th>Bill Total</th>
                    <th>View Details</th>
                </tr>
            
                <?php
                    $res=mysqli_query($link,"select * from billing_header order by id desc");
                    while($row=mysqli_fetch_array($res))
                    {
                        echo "<tr>";
                        echo "<td>"; echo $row["bill_no"]; echo "</td>";
                        echo "<td>"; echo $row["full_name"]; echo "</td>";
                        echo "<td>"; echo $row["bill_type"]; echo "</td>";
                        echo "<td>"; echo $row["date"]; echo "</td>";
                        echo "<td>"; echo get_total($row["id"],$link); echo "</td>";
                        echo "<td>"; ?><a href="view_bill_details.php?id=<?php echo $row["id"]; ?>" class="td-edit">View Details</a><?php echo "</td>";
                        echo "</tr>";
                    }


                ?>
          </table>
        </div>


    </div>


<?php
function get_total($bill_id,$link)
{
    $total=0;
    $res2=mysqli_query($link,"select * from billing_details where bill_id=$bill_id");
    while($row2=mysqli_fetch_array($res2))
    {
        $total=$total+($row2["price"]*$row2["qty"]);
    }

    return $total;


}

?>
   
<?php
include "footer.php";
?>
