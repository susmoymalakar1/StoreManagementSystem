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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>edit_product</title>
    <style>
       .container{
        width: 30%;
        border-radius: 20px;
        margin-top:100px;
        }
        body{
        background: chocolate;
        }
    </style>
</head>
<body>
    <?php
        if(isset($_GET['id']))
        {
            $getid=$_GET['id'];

            $sql="SELECT * FROM product WHERE product_id=$getid";
            $query= $connection->query($sql);
            $data=mysqli_fetch_assoc($query);

            $product_id=$data['product_id'];
            $product_name=$data['product_name'];
            $product_category=$data['product_category'];
            $product_code=$data['product_code'];
            $product_entry_date=$data['product_entry_date'];
        }
        if(isset($_GET['product_name']))
        {
            $new_product_name=$_GET['product_name'];
            $new_product_category=$_GET['product_category'];
            $new_product_code=$_GET['product_code'];
            $new_product_entry_date=$_GET['product_entry_date'];
            $new_product_id=$_GET['product_id'];

            $sql1="UPDATE product SET product_name='$new_product_name',
                product_category='$new_product_category',
                product_code='$new_product_code',
                product_entry_date='$new_product_entry_date' WHERE product_id=$new_product_id";

            if($connection->query($sql1)==TRUE)
            {
                echo "<script>alert('Record Update successfully!')</script>";
                ?>
                     <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/list_of_product.php"/><!-- content means time koto secend e refresh hobe-->
                <?php
            }
            else{
                echo "<script>alert('Record not Update!')</script>";
            }
        }
    ?>

    <?php
        $sql="SELECT * FROM category";
        $query=$connection->query($sql);
    ?>
    <div class="container">
        <form action="edit_product.php" method="GET" class="form-control bg-secondary text-white">
            <h3 class='text-center'>Edit Product</h3>
                Product :<br/>
                <input type="text" name="product_name" class="form-control" value="<?php echo $product_name?>"><br><br>
                Product Category :<br/>
                <select name="product_category" class="form-control">
                <?php
                    while($data=mysqli_fetch_assoc($query))
                    {
                        $category_id=$data['category_id'];
                        $category_name=$data['category_name'];
                    ?>
                        <option value='<?php echo $category_id?>' <?php if($category_id==$product_category){echo 'selected';}?>>
                        <?php echo $category_name ?></option>;
                    <?php
                    }
                    ?>
                ?> 
                </select><br><br>

                Product Code :<br/>
                <input type="text" name="product_code" class="form-control" value="<?php echo $product_code?>"><br><br>
                Category Entry Date :<br>
                <input type="date" name="product_entry_date" class="form-control" value="<?php echo $product_entry_date?>"><br><br>
                <input type="text" name="product_id" class="form-control" value="<?php echo $product_id?>" hidden><br><br>
                <input type="Submit" name="submit" value="update" class=" btn btn-success form-control mb-2">
            </form>
    </div>
    
</body>
</html>

<?php
} else{
    header('location:login.php');
}
?>