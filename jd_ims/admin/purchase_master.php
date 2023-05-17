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
                <h3>Purchase Form</h3>
            </div>
        

            <div class="container-fluid">
        
                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                    
                <div class="widget-box">
                <div class="widget-title">
                  <h5>Purchase Entry</h5>
                </div>
                <div class="widget-content">
                  <form name="form1" action="" method="post" class="form-horizontal">

                    <div class="control-group">
                      <div class="col-25">
                        <label class="control-label">Select Company :</label>
                      </div>
                        
                      <div class="controls col-75">
                      <select class="span11" name="company_name" id="company_name" onchange="select_company(this.value)">
                      <option>Select</option>
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
                          <label class="control-label">Select Product Name :</label>
                        </div>
                      
                      <div class="controls col-75" id="product_name_div">
                      <select class="span11">
                        <option>Select</option>
                      </select>
                      </div>
                    </div>
        
                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Select Unit :</label>
                          </div>

                      <div class="controls col-75" id="unit_div">
                      <select class="span11">
                        <option>Select</option>
                      </select>
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Enter Packing Size :</label>
                          </div>

                      <div class="controls col-75" id="packing_size_div">
                      <select class="span11">
                        <option>Select</option>
                      </select>
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Enter Qty :</label>
                          </div>

                      <div class="controls col-75">
                          <input type="text" name="qty" value="0" class="span11">
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Enter Price :</label>
                        </div>

                      <div class="controls col-75">
                          <input type="text" name="price" value="0" class="span11">
                      </div>
                    </div>

                    <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Select Party Name :</label>
                        </div>

                      <div class="controls col-75">
                      <select class="span11" name="party_name">
                      <?php
                        $res=mysqli_query($link,"select * from party_info");
                        while($row=mysqli_fetch_array($res))
                        {
                          echo "<option>";
                          echo $row["businessname"];
                          echo "</option>";
                        }
                        ?>
                        </select>
                        </div>
                      </div>

                      <div class="control-group">
                        <div class="col-25">
                            <label class="control-label">Select Purchase Type :</label>
                        </div>

                      <div class="controls col-75">
                      <select class="span11" name="purchase_type">
                        <option>Cash</option>
                        <option>Online</option>
                      </select>
                      </div>
                    </div>

                    <hr>
        
                    <div class="form-actions">
                      <button type="submit" name="submit1" class="btn">Purchase Now</button>
                    </div>
        
        
                    <div class="alert_success" id="success" style="display:none">
                        Purchase Inserted Successfully!
                    </div>
        
        
                  </form>
                </div> 
        </div> 

    </div>

  
  <script type="text/javascript">
  function select_company(company_name)
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 || xmlhttp.status == 200){
        document.getElementById("product_name_div").innerHTML=xmlhttp.responseText;
      }
    };
    xmlhttp.open("GET", "psfiles/load_product_using_company.php?company_name="+company_name, true);
    xmlhttp.send();
  }

  function select_product(product_name,company_name)
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 || xmlhttp.status == 200){
        document.getElementById("unit_div").innerHTML=xmlhttp.responseText;
      }
    };
    xmlhttp.open("GET", "psfiles/load_unit_using_products.php?product_name="+product_name+"&company_name="+company_name, true);
    xmlhttp.send();
    
    // alert(product_name + "==" + company_name);

  }

  function select_unit(unit,product_name,company_name)
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
        document.getElementById("packing_size_div").innerHTML=xmlhttp.responseText;
      }
    };
    xmlhttp.open("GET", "psfiles/load_packingsize_using_unit.php?unit="+unit+"&product_name="+product_name+"&company_name="+company_name, true);
    xmlhttp.send();
    // alert(unit+"=="+product_name+"=="+company_name);
  }

</script>

<?php
if(isset($_POST["submit1"]))
{
    mysqli_query($link,"insert into purchase_master values(NULL,'$_POST[company_name]','$_POST[product_name]','$_POST[unit]','$_POST[packing_size]','$_POST[qty]','$_POST[price]','$_POST[party_name]','$_POST[purchase_type]')") or die(mysqli_error($link));
    

    $res=mysqli_query($link,"select * from stock_master where product_company='$_POST[company_name]' && product_name='$_POST[product_name]' && product_unit='$_POST[unit]'");
    $count=mysqli_num_rows($res);

    if($count==0)
    {
      mysqli_query($link,"insert into stock_master values(NULL,'$_POST[company_name]','$_POST[product_name]','$_POST[unit]','$_POST[qty]','0')") or die(mysqli_error($link));
    }
    else{
      mysqli_query($link,"update stock_master set product_qty=product_qty+$_POST[qty] where product_company='$_POST[company_name]' && product_name='$_POST[product_name]' && product_unit='$_POST[unit]'") or die(mysqli_error($link));
    }

    ?>
    <script type="text/javascript">
      document.getElementById("success").style.display="block";
    </script>
    <?php
}
?>


<?php
include "footer.php";
?>
