<?php
   include('connection.php');
   include('myfunction.php');
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
    <title>edit_store_product</title>
    <style>
       .container{
        width: 30%;
        border-radius: 20px;
        margin-top:130px;
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

           $sql="SELECT * FROM store_product WHERE store_product_id=$getid";
           $query= $connection->query($sql);
           $data=mysqli_fetch_assoc($query);

           $store_product_id=$data['store_product_id'];
           $store_product_name=$data['store_product_name'];
           $store_product_quentity=$data['store_product_quentity'];
           $store_product_entry_date=$data['store_product_entry_date'];
       } 

       if(isset($_GET['store_product_name']))
        {
            $new_store_product_name=$_GET['store_product_name'];
            $new_store_product_quentity=$_GET['store_product_quentity'];
            $new_store_product_entry_date=$_GET['store_product_entry_date'];
            $new_store_product_id=$_GET['store_product_id'];

            $sql1="UPDATE store_product SET store_product_name='$new_store_product_name',
                store_product_quentity='$new_store_product_quentity',
                store_product_entry_date='$new_store_product_entry_date' WHERE store_product_id=$new_store_product_id";

            if($connection->query($sql1)==TRUE)
            {
                echo "<script>alert('Record Update successfully!')</script>";
                ?>
                     <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/list_of_store_product.php"/><!-- content means time koto secend e refresh hobe-->
                <?php
            }
            else{
                echo "<script>alert('Record not Update!')</script>";
            }
        }
    ?>
    <div class="container">
        <form action="edit_store_product.php" method="GET" class="form-control bg-secondary text-white">
            <h3 class='text-center'>Edit Store Product</h3>
            Product :<br/>
            <select name="store_product_name" class="form-control">
            <?php
                $sql="SELECT * FROM product";
                $query=$connection->query($sql);
        
            while($data=mysqli_fetch_assoc($query))
                {
                    $data_id=$data['product_id'];
                    $data_name=$data['product_name'];
            ?>
                    <option value='<?php echo $data_id?>' <?php if($store_product_name==$data_id) {echo 'selected';}?>><?php echo $data_name ?></option>;
            <?php
                }
            ?>
            ?> 
            </select><br><br>

            Product Quentity :<br/>
            <input type="text" name="store_product_quentity" class="form-control" value="<?php echo $store_product_quentity;?>"><br><br>
            Store Entry Date :<br>
            <input type="date" name="store_product_entry_date" class="form-control" value="<?php echo $store_product_entry_date;?>"><br><br>
            <input type="text" name="store_product_id" class="form-control" value="<?php echo $store_product_id?>" hidden><br><br>
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