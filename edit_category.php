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
    <title>edit_category</title>
    <style>
       .container{
        width: 30%;
        border-radius: 20px;
        margin-top:230px;
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
            $sql="SELECT * FROM category WHERE category_id=$getid";
            $query= $connection->query($sql);
            $data=mysqli_fetch_assoc($query);
            $category_id=$data['category_id'];
            $category_name=$data['category_name'];
            $category_entrydate=$data['category_entrydate'];
        }

        if(isset($_GET['category_name']))
        {
            $new_category_name=$_GET['category_name'];
            $new_category_entrydate=$_GET['category_entrydate'];
            $new_category_id=$_GET['category_id'];
            
            $sql1="UPDATE category SET category_name='$new_category_name',
                    category_entrydate='$new_category_entrydate'
                     WHERE category_id=$new_category_id";
            if($connection->query($sql1))
            {
                echo "<script>alert('Record Update successfully!')</script>";
                ?>
                    <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/list_of_category.php"/><!-- content means time koto secend e refresh hobe-->
                <?php
            }
            else{
                echo "<script>alert('Record not Update!')</script>";
            }
        }
    ?>
    <!-- class="container min-vh-100 d-flex justify-context-center align-items-center" -->
    <div class="container">
        <form action="edit_category.php" method="GET" class="form-control bg-secondary text-white" >
            <h3 class='text-center'>Edit Category</h3>
            <input type="text" name="category_id" class="form-control" value="<?php echo $getid?>" hidden>

            Categroy :<br/>
            <input type="text" name="category_name"  class="form-control" placeholder="Category Name" value="<?php echo $category_name?>"><br><br>
            Category Entry Date :<br>
            <input type="date" name="category_entrydate"  class="form-control" placeholder="Entry Date" value="<?php echo $category_entrydate?>"><br><br>
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