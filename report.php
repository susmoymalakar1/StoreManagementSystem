<?php
   include('connection.php');
   error_reporting(0);
   
    session_start();
    $user_first_name= $_SESSION['user_first_name']; //session er moddhe ei first and last name save ache
    $user_last_name= $_SESSION['user_last_name'];
    
    if(!empty($user_first_name)&&!empty($user_last_name)){

        $sql2="SELECT * FROM product";
    $query2=$connection->query($sql2);

    $data_list=array();
    while($data2=mysqli_fetch_assoc($query2))
    {

        $product_id=$data2['product_id'];
        $product_name=$data2['product_name'];
        $data_list[$product_id]=$product_name;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .container1{
            margin-left:250px;
            margin-top:100px;
        }
    </style>
</head>
<body>
   
<div class="container bg-light">
        <div class="container-foulid border-bottom border-success"><!--topbar er jonno-->
        <?php include("topbar.php"); ?>
        </div><!--end topbar-->
        <div class="container-foulid">
            <!--ei part ke dui vage vag korbo-->
            <div class="row">
                <div class="col-sm-3 bg-light p-0 m-0"><!--left bar-->
                    <?php include("leftbar.php"); ?>
                </div><!-- end of left bar-->

                <div class="col-sm-9 border-start border-success"><!--right bar-->
                    <div class="container p-4 m-4">
                        
                        
                        <?php
                        if(isset($_GET['submit'])){
                            //report store data
                            if(isset($_GET['product_name'])){
                                $product_name=$_GET['product_name'];

                                $sql1= "SELECT * FROM store_product WHERE store_product_name=$product_name";
                                $query1=$connection->query($sql1);
                                
                                echo "<h1 class='text-center'>Store Product</h1>";
                                
                                while($data1=mysqli_fetch_array($query1)){
                                
                                $store_product_quentity=$data1['store_product_quentity'];
                                $store_product_entry_date=$data1['store_product_entry_date'];
                                $store_product_name=$data1['store_product_name'];
                                echo "<h5 >$data_list[$store_product_name]</h5>";
                            
                                echo "<table class='table table-success table-striped table-hover'><tr><td>Store Date</td><td>Amount</td></tr>";
                                echo "<tr><td>$store_product_entry_date</td><td>$store_product_quentity</td></tr>";
                                echo "</table>"; 
                                }
                            }
                        ?>

                        <?php
                        //report store data
                        if(isset($_GET['product_name'])){
                            $product_name=$_GET['product_name'];

                            $sql3= "SELECT * FROM spend_product WHERE spend_product_name=$product_name";
                            $query3=$connection->query($sql3);
                            echo "<h1 class='text-center'>Store Product</h1>";
                            while($data3=mysqli_fetch_array($query3)){
                            $spend_product_quentity=$data3['spend_product_quentity'];
                            $spend_product_entry_date=$data3['spend_product_entry_date'];
                            $spend_product_name=$data3['spend_product_name'];

                            echo "<h5 >$data_list[$spend_product_name]</h5>";
                            echo "<table class='table table-success table-striped table-hover'><tr><td>Store Date</td><td>Amount</td></tr>";
                            echo "<tr><td>$spend_product_entry_date</td><td>$spend_product_quentity</td></tr>";
                            echo "</table>"; 
                            }
                        } 
                         
                    }
                    
                    else {                   
                    ?>  
                     
                    <div class="container1">
                            
                            <form action="report.php" method="GET" class="form-control w-50 bg-secondary text-white">
                                <h3 class='text-center'>Report</h3>
                            Select Product Name :<br>
                            <Select name="product_name" class="form-control mb-3" >
                            <?php
                                $sql="SELECT * FROM product";
                                $query=$connection->query($sql);
                                
                                while($data=mysqli_fetch_assoc($query))
                                {
                                $product_id=$data['product_id'];
                                $product_name= $data['product_name'];
                            ?>
                                <option value="<?php echo $product_id?>"><?php echo $product_name?></option>
                                <?php } ?>
                                </Select>
                                <a href="add_users.php"><input type="Submit" name="submit" value="Generate Report" class="btn btn-success mb-2 w-100"></a>
                                </form>
                        </div>
                                <?php } ?>


                    </div><!--end of container-->
                
                </div><!--end of right bar-->                
            </div>
        </div>
        <div class="container-foulid border-top border-success"><!--bottombar-->
            <?php include("bottombar.php");?>
        </div><!--end of bottombar-->
    </div>

</body>
<script>
    function checkprint()
    {
        return confirm('Are you sure your want to print this list');
    }
</script>

</html>

<?php
} else{
    header('location:login.php');
}
?>