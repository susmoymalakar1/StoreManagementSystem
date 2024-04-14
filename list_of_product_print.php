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
        
            <div class="container p-4 m-4">
                    <h2 class="text-center">Product List</h2>
                    <?php
                        $sql="SELECT * FROM product";
                        $query=$connection->query($sql);
                        echo "<table class='table table-success table-striped table-hover'>
                        <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Code</th>
                        <th>Date</th>
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
                            </tr>";
                        }
                            echo "</table>";
                    ?>               
                    </div><!--end of container-->
            </div>

</body>
<script>
        window.addEventLister('load',window.print());
</script>
        <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/list_of_product.php"/>
</html>

<?php
} else{
    header('location:login.php');
}
?>