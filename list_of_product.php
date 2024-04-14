<?php
    include('connection.php');
    error_reporting(0);

    session_start();
    $user_first_name= $_SESSION['user_first_name']; //session er moddhe ei first and last name save ache
    $user_last_name= $_SESSION['user_last_name'];
    
    if(!empty($user_first_name)&&!empty($user_last_name)){

    $sql1="SELECT * FROM category";
    $query1=$connection->query($sql1);
    $data_list=array();
    while($data1=mysqli_fetch_assoc($query1))
    {

        $category_id=$data1['category_id'];
        $category_name=$data1['category_name'];
        $data_list[$category_id]=$category_name;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list_of_product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .container1{
            margin-top:8px;
            margin-left:700px;
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
                        <!-- start of searchbar -->
                        <div class="container1">
                            <form action="list_of_product.php" method="GET" >
                                <input type="text" name="search_text" placeholder="Search Here">
                                <input type="submit" value="Search" class='btn btn-success'>
                            </form>
                        </div>
                        <?php
                            if(isset($_GET['search_text'])){
                            $search_text=$_GET['search_text'];
                            $sql2="SELECT * FROM product WHERE product_name LIKE '$search_text' ";
                            $query2=mysqli_query($connection,$sql2);
                            if(mysqli_num_rows($query2)>0)
                            {
                                echo "<h3 class='text-center mt-5'>product</h3>";
                                echo "<table class='table table-success table-striped table-hover'>                         
                                            <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Date</th>
                                            <th>Operation</th>
                                            </tr>";
                                // echo "<table border=1>";
                                while($data2=mysqli_fetch_assoc($query2))
                                {
                                $product_id=$data2['product_id'];
                                $product_name=$data2['product_name'];
                                $product_category= $data2['product_category'];
                                $product_code=$data2['product_code'];
                                $product_entry_date=$data2['product_entry_date'];
                                
                                echo "
                                        <tr>
                                        <td>$product_name</td>
                                        <td>$product_code</td>
                                        <td>$product_entry_date</td>
                                        <td>
                                        <a href='edit_product.php?id=$product_id & name=$product_name & category=$product_category & code=$product_code' class='btn btn-success' onclick='return checkupdate()'>Edit</a>
                                        <a href='delete_product.php?id=$product_id & name=$product_name' class='btn btn-danger' onclick='return checkdelete()'>Delete</a>
                                        </td>
                                        </tr>";
                                }
                                echo "</table>";
                            }
                            else{
                                echo "<script>alert(' $search_text Record is not available!')</script>";
                                ?>
                                    <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/list_of_product.php"/><!-- content means time koto secend e refresh hobe-->
                                <?php
                            }
                            }
                            else{
                        ?><!-- end of searchbar -->
                        
                    <div class="container p-4 m-4">
                        <h2 class="text-center">Product List</h2>
                    <?php
                        $sql1="SELECT * FROM product";
                        $query1=mysqli_query($connection,$sql1);
                        $num_rows=mysqli_num_rows($query1);
                        $divided_num_rows=($num_rows/5)+1;
                       if(isset($_GET['pageno']))
                       {
                         $pagenumber=$_GET['pageno'];
                         $offset= ($pagenumber -1)*5;
                         $pagenumber_increment=$pagenumber+1;
                         $pagenumber_decrement=$pagenumber-1;
                       }
                       else
                       {
                         $offset=0;
                         $pagenumber_increment=2;
                         $pagenumber_decrement=0;
                       }

                        $sql="SELECT * FROM product LIMIT 5 OFFSET $offset";
                        $query=$connection->query($sql);
                        echo "<table class='table table-success table-striped table-hover'>
                        <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Operation</th>
                        </tr>";
                        while($data=mysqli_fetch_assoc($query))
                        {
                            $product_id=$data['product_id'];
                            $product_name= $data['product_name'];
                            $product_category= $data['product_category'];
                            $product_code= $data['product_code'];
                            $product_entry_date= $data['product_entry_date'];
                            echo "<tr>
                            <td>$product_name</td>
                            <td>$data_list[$product_category]</td>
                            <td>$product_code</td>
                            <td>$product_entry_date</td>
                            <td>
                            <a href='edit_product.php?id=$product_id & name=$product_name & category=$product_category & code=$product_code' class='btn btn-success' onclick='return checkupdate()'>Edit</a>
                            <a href='delete_product.php?id=$product_id & name=$product_name' class='btn btn-danger' onclick='return checkdelete()'>Delete</a>
                            </td>
                            </tr>";
                        }
                            echo "</table>";
                    ?>
                    <?php
                    if($pagenumber_decrement==0)
                    {
                        echo "<span class='bg-success border round py-2 px-3 m-2'><</span>";
                    }
                    else
                    {
                       echo "<span class='bg-success border round py-2 px-3 m-2'>
                       <a href='list_of_product.php?pageno=$pagenumber_decrement' class='text-white'><</a>
                       </span> ";
                    }
                    ?>
                    
                    <?php
                    if($pagenumber_increment>$divided_num_rows)
                    {
                        echo "<span class='bg-success border round py-2 px-3 m-2'>></span>";
                    }
                    else
                    {
                       echo"<span class='bg-success border round py-2 px-3 m-2'> 
                       <a href='list_of_product.php?pageno= $pagenumber_increment' class='text-white'>></a>
                       </span>";
                    }
                }
                    ?>
                    </div><!--end of container-->
                    <div class="print text-center">
                        <a href="list_of_product_print.php" ><button class='btn btn-success' onclick='return checkprint()'>
                                    Print
                            </button></a>
                    </div>
                </div><!--end of right bar-->                
            </div>
        </div>
        <div class="container-foulid border-top border-success"><!--bottombar-->
            <?php include("bottombar.php");?>
        </div><!--end of bottombar-->
    </div>

</body>
<script>
    function checkdelete()
    {
        return confirm('Are you sure your want to delete this record?');
    }
    function checkupdate()
    {
        return confirm('Are you sure your want to update this record?');
    }
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