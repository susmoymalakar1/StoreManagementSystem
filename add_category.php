<?php
    $hostname='localhost';
    $username='root';
    $password='';
    $dbname='store_db';
    $connection=new mysqli($hostname,$username,$password,$dbname);
    if($connection->connect_error)
    {
        die("Connection failed:" .$connection->connect_error);
    }

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
    <title>add_category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="add_category.css">
    <style>
        .container1{
            margin-left:250px;
            margin-top:50px;
        }
    </style>
</head>
<body>
      <!-- topbar ,menu item, bottombar -->

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
                            if(isset($_GET['category_name']))
                                {
                                    $category_name=$_GET['category_name'];
                                    $category_entrydate=$_GET['category_entrydate'];
                                     $sql="INSERT INTO category (category_name,category_entrydate) VALUES ('$category_name','$category_entrydate')";
                                    if($connection->query($sql)==TRUE){
                                        echo "<script>alert('Record insert successfully')</script>";
                                        ?>
                                        <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/add_category.php"/><!-- content means time koto secend e refresh hobe-->
                                        <?php
                                }
                                else{
                                    echo "<script>alert('Record not insert')</script>";
                                }
                            }
                        ?>
                        <div class="container1">
                            <form action="add_category.php" method="GET" class="form-control w-50 bg-secondary text-white">
                        <h3 class='text-center'>Add Category</h3>

                            Categroy :<br/>
                            <input type="text" name="category_name" placeholder="Category Name" class="form-control mb-3"><br><br>
                            Category Entry Date :<br>
                            <input type="date" name="category_entrydate" placeholder="Entry Date" class="form-control mb-3"><br><br>
                            <input type="Submit" name="submit" value="submit" class="btn btn-success mb-2 w-100">
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