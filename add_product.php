<?php
   include('connection.php');
   error_reporting(0);

   session_start();
    $user_first_name= $_SESSION['user_first_name']; //session er moddhe ei first and last name save ache
    $user_last_name= $_SESSION['user_last_name'];
    
    if(!empty($user_first_name)&&!empty($user_last_name)){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add_product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .container1{
            margin-left:250px;
            margin-top:0px;
        }
    </style>
</head>
<body>

<div class="container bg-light">
        <div class="container-foulid border-bottom border-success"><!--topbar er jonno-->
        <?php include("topbar.php"); ?>
        </div><!--end topbar-->
        <div class="container-foulid">
            <div class="row">
                <div class="col-sm-3 bg-light p-0 m-0"><!--left bar-->
                    <?php include("leftbar.php"); ?>
                </div><!-- end of left bar-->

                <div class="col-sm-9 border-start border-success"><!--right bar-->
                    <div class="container p-4 m-4">
                    <?php
        if(isset($_GET['product_name']))
        {
            $product_name=$_GET['product_name'];
            $product_category=$_GET['product_category'];
            $product_code=$_GET['product_code'];
            $product_entry_date=$_GET['product_entry_date'];

            $sql="INSERT INTO product (product_name,product_category,product_code,product_entry_date) 
                    VALUES ('$product_name','$product_category','$product_code','$product_entry_date')";
            if($connection->query($sql)==TRUE){
                echo "<script>alert('Record insert successfully')</script>";
                        ?>
                        <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/add_product.php"/><!-- content means time koto secend e refresh hobe-->
                        <?php
            }
            else{
                echo "<script>alert('Record not insert')</script>";
            }
        }
    ?>

    <?php
        $sql="SELECT * FROM category";
        $query=$connection->query($sql);
    ?>
    <div class="container1">
        
        <form action="add_product.php" method="GET" class="form-control w-50 bg-secondary text-white">
        <h3 class='text-center'>Add Product</h3>
                Product :<br/>
                <input type="text" name="product_name" class="form-control"><br><br>
                Product Category :<br/>
                <select name="product_category" class="form-control">
                <?php
                    while($data=mysqli_fetch_assoc($query))
                    {
                        $category_id=$data['category_id'];
                        $category_name=$data['category_name'];
                        echo "<option value='$category_id'>$category_name</option>";
                    }
                ?> 
                </select><br><br>

                Product Code :<br/>
                <input type="text" name="product_code" class="form-control"><br><br>
                Category Entry Date :<br>
                <input type="date" name="product_entry_date" class="form-control"><br><br>
                <input type="Submit" name="submit" value="submit" class=" btn btn-success form-control mb-2">
            </form>
    </div>
    
                    </div><!--end of container-->
                
                </div><!--end of right bar-->                
            </div>
        </div>
        <div class="container-foulid border-top border-success"><!--bottombar-->
            <?php include("bottombar.php");?>
        </div><!--end of bottombar-->
    </div>

</body>
</html>

<?php
} else{
    header('location:login.php');
}
?>