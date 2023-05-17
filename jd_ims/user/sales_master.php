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
// session_start();
include "base.php";
include "../user/connection.php";
$bill_id=0;
$res=mysqli_query($link,"select * from billing_header order by id desc limit 1");
while($row=mysqli_fetch_array($res))
{
    $bill_id=$row["id"];
}

?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Container -->
    <div class="container">
        <div id="content">

            <div id="content_header">
                <h3>Sales Form</h3>
            </div>


            <div class="container-fluid">

                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">

                    <div class="widget-box">
                        <div class="widget-title">
                            <h5>Sales a Product</h5>
                        </div>
                        <div class="widget-content">
                            <form name="form1" action="" method="post" class="form-horizontal">

                                <div class="sales-row1">
                                <div class="control-group-sales col-20">
                                
                                        <label>Full Name</label>
                                        <input type="text" class="span11" name="full_name" required>
                                    
                                </div>

                                <div class="control-group-sales col-20">
                                
                                        <label>Bill Type</label>
                                        <select class="span12" name="bill_type_header">
                                            <option>Cash</option>
                                            <option>Debit</option>
                                        </select>
                                    
                                </div>

                                <div class="control-group-sales col-20">
                                
                                        <label>Date</label>
                                        <input type="text" class="span12" name="bill_date"
                                               value="<?php echo date("Y-m-d") ?>"
                                               readonly>
                                    
                                </div>

                                <div class="control-group-sales col-20">
                                
                                        <label>Bill No</label>
                                        <input type="text" class="span12" name="bill_no" value="<?php echo generate_bill_no($bill_id); ?>" readonly>
                                    
                                </div>
                                </div>

                        
                            <center><h4>Select A Product</h4></center>

                            <div class="sales-row1">
                                <div class="control-group-sales col-20">
                                
                                <label>Product Company</label>
                                <select class="span11" name="company_name" id="company_name"
                                        onchange="select_company(this.value)">
                                    <option>Select</option>
                                    <?php
                                    $res = mysqli_query($link, "select * from company_name");
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo "<option>";
                                        echo $row["companyname"];
                                        echo "</option>";
                                    }
                                    ?>
                                </select>
                                    
                                </div>

                                <div class="control-group-sales col-20">
                                
                                <label>Product Name</label>
                                <div id="product_name_div">
                                    <select class="span11">
                                        <option>Select</option>
                                    </select>
                                </div>
                                    
                                </div>

                                <div class="control-group-sales col-20">
                                
                                <label>Unit</label>
                                <div id="unit_div">
                                    <select class="span11">
                                        <option>Select</option>
                                    </select>
                                </div>
        
                                    
                                </div>

                                <div class="control-group-sales col-20">
                                
                                <label>Packing Size</label>
                                <div id="packing_size_div">
                                    <select class="span11">
                                        <option>Select</option>
                                    </select>
                                </div>
                                    
                                </div>

        
                                </div>

                                <div class="sales-row1">
                                  
                                    <div class="control-group-sales col-20">
                                    <label>Price</label>
                                    <input type="text" class="span12" name="price" id="price" readonly value="0"/>
                                        
                                    </div>
    
                                    <div class="control-group-sales col-20">
                                    
                                    <label>Enter Qty</label>
                                    <input type="text" class="span11" name="qty" id="qty" autocomplete="off" onkeyup="generate_total(this.value)">
                                        
                                    </div>
    
                                    <div class="control-group-sales col-20">
                                    
                                    <label>Total</label>
                                    <input type="text" class="span11" name="total" id="total" value="0" readonly>
                                        
                                    </div>
    
                                    <center>
                                        <input type="button" class="btn" value="Add" onclick="add_session();">
                                    </center>
                                    </div>
                                    

                        </div>

                        

                    </div>


                <div class="widget-content">
                    <center><h4>Selected Products</h4></center>

                    <div id="bill_products"></div>

                    <h4>
                        <div style="float: right"><span style="float:left;">Total:&#8377;</span><span style="float: left" id="totalbill">0</span></div>
                    </h4>


                    <br><br><br><br>

                    <center>
                        <input type="submit" name="submit1" value="generate bill" class="btn">
                    </center>
                </div>
            </div>
            </div>
        </form>
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
      if (xmlhttp.readyState == 4 || xmlhttp.status == 200){
        document.getElementById("packing_size_div").innerHTML=xmlhttp.responseText;

        $('#packing_size').on('change',function(){
            // alert("testing");
            load_price(document.getElementById("packing_size").value);
        });

      }
    };
    xmlhttp.open("GET", "psfiles/load_packingsize_using_unit.php?unit="+unit+"&product_name="+product_name+"&company_name="+company_name, true);
    xmlhttp.send();
    // alert(unit+"=="+product_name+"=="+company_name);
  }

  function load_price(packing_size)
  {
    var company_name=document.getElementById("company_name").value;
    var product_name=document.getElementById("product_name").value;
    var unit=document.getElementById("unit").value;
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 || xmlhttp.status == 200){
            document.getElementById("price").value=xmlhttp.responseText;
            // alert(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET", "psfiles/load_price.php?company_name="+company_name+"&product_name="+product_name+"&unit="+unit+"&packing_size="+packing_size, true);
    xmlhttp.send();

  }

  function generate_total(qty)
  {
    document.getElementById("total").value=eval(document.getElementById("price").value) * eval(document.getElementById("qty").value);
  }

  function add_session()
  {
    var product_company=document.getElementById("company_name").value;
    var product_name=document.getElementById("product_name").value;
    var unit=document.getElementById("unit").value;
    var packing_size=document.getElementById("packing_size").value;
    var price=document.getElementById("price").value;
    var qty=document.getElementById("qty").value;
    var total=document.getElementById("total").value;
    // alert("OK Testing");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 || xmlhttp.status == 200){
            // alert(xmlhttp.responseText);
            if(xmlhttp.responseText=="")
            {
                load_billing_products();
                alert("product added successfully");
            }
            else
            {
                load_billing_products();
                alert(xmlhttp.responseText);
            }
        }
    };
    xmlhttp.open("GET", "psfiles/save_in_session.php?company_name="+product_company+"&product_name="+product_name+"&unit="+unit+"&packing_size="+packing_size+"&price="+price+"&qty="+qty+"&total="+total, true);
    xmlhttp.send();

  }

  function load_billing_products()
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 || xmlhttp.status == 200){
            document.getElementById("bill_products").innerHTML=xmlhttp.responseText;
            // alert(xmlhttp.responseText);
            load_total_bill();
        }
    };
    xmlhttp.open("GET", "psfiles/load_billing_products.php", true);
    xmlhttp.send();
  }

  function load_total_bill()
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 || xmlhttp.status == 200){
            document.getElementById("totalbill").innerHTML=xmlhttp.responseText;
            // alert(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET", "psfiles/load_billing_amount.php", true);
    xmlhttp.send();
  }

  load_billing_products();

  function delete_qty(sessionid)
  {
    // alert(sessionid);
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 || xmlhttp.status == 200) {
            if(xmlhttp.responseText=="")
            {
                load_billing_products();
                alert("product Deleted successfully");
            }
            else
            {
                load_billing_products();
                alert(xmlhttp.responseText);
            }
        }
    };
    xmlhttp.open("GET", "psfiles/delete_in_session.php?sessionid="+sessionid, true);
    xmlhttp.send();
  }
  

</script>

<?php
function generate_bill_no($id)
{
    if($id=="")
    {
        $id1=0;
    }
    else{
        $id1=$id;
    }
    $id1=$id1+1;

    $len=strlen($id1);

    if($len=="1")
    {
        $id1="0000".$id1;
    }

    if($len=="2")
    {
        $id1="000".$id1;
    }

    if($len=="3")
    {
        $id1="00".$id1;
    }

    if($len=="4")
    {
        $id1="0".$id1;
    }
    if($len=="5")
    {
        $id1=$id1;
    }

    return $id1;
}

if(isset($_POST["submit1"]))
{
    $lastbillno=0;
    mysqli_query($link,"Insert into billing_header values(NULL,'$_POST[full_name]','$_POST[bill_type_header]','$_POST[bill_date]','$_POST[bill_no]')") or die(mysqli_error($link));

    $res=mysqli_query($link,"select * from billing_header order by id desc limit 1");
    while($row=mysqli_fetch_array($res))
    {
        $lastbillno=$row["id"];
    }

    $max=sizeof($_SESSION['cart']);

    for($i=0;$i<$max;$i++)
    {
        $company_name_session="";
        $product_name_session="";
        $unit_session="";
        $packing_size_session="";
        $price_session="";
    
        if(isset($_SESSION['cart'][$i]))
        {
            foreach($_SESSION['cart'][$i] as $key => $val)
            {
                if($key=="company_name")
                {
                    $company_name_session=$val;
                }
                else if($key=="product_name")
                {
                    $product_name_session=$val;
                }
                else if($key=="unit")
                {
                    $unit_session=$val;
                }
                else if($key=="packing_size")
                {
                    $packing_size_session=$val;
                }
                else if($key=="qty")
                {
                    $qty_session=$val;
                }
                else if($key=="price")
                {
                    $price_session=$val;
                }
            }

            if($company_name_session!=""){
                mysqli_query($link,"insert into billing_details values(NULL,'$lastbillno','$company_name_session','$product_name_session','$unit_session','$packing_size_session','$price_session','$qty_session')") or die(mysqli_error($link));
                mysqli_query($link,"update stock_master set product_qty=product_qty-$qty_session where product_company='$company_name_session' && product_name='$product_name_session' && product_unit='$unit_session'");
            }

        }
    }

    unset($_SESSION['cart']);
    ?>
    <script type="text/javascript">
        alert("bill generated successfully");
        window.location.href=window.location.href;
    </script>
    <?php

}

?>



<?php
include "footer.php";
?>
