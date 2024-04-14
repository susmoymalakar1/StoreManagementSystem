<?php
    include('connection.php');
    error_reporting(0);

    session_start();
    $user_first_name= $_SESSION['user_first_name']; //session er moddhe ei first and last name save ache
    $user_last_name= $_SESSION['user_last_name'];
    
    if(!empty($user_first_name)&&!empty($user_last_name)){

    $sql1="SELECT * FROM product";
    $query1=$connection->query($sql1);

    $data_list=array();
    while($data1=mysqli_fetch_assoc($query1))
    {

        $product_id=$data1['product_id'];
        $product_name=$data1['product_name'];
        $data_list[$product_id]=$product_name;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Spend Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="container bg-light">
        
                <div class="container p-4 m-4">
                        <h2 class='text-center'>Spend Product List</h2>
                    <?php
                        $sql="SELECT * FROM spend_product";
                        $query=$connection->query($sql);
                        echo "<table class='table table-success table-striped table-hover'>
                        <tr>
                            <th>Product Name</th>
                            <th>Quentity</th>
                            <th>Date</th>
                        </tr>";
                        while($data=mysqli_fetch_assoc($query))
                        {
                            $spend_product_id=$data['spend_product_id'];
                            $spend_product_name= $data['spend_product_name'];
                            $spend_product_quentity= $data['spend_product_quentity'];
                            $spend_product_entry_date= $data['spend_product_entry_date'];
                            echo "<tr>
                            <td>$data_list[$spend_product_name]</td>
                            <td>$spend_product_quentity</td>
                            <td>$spend_product_entry_date</td>
                            </tr>";
                        }
                            echo "</table>";
                    ?>
                    </div><!--end of container-->               
                </div><!--end of right bar-->                

</body>
<script>
        window.addEventLister('load',window.print());
</script>
        <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/list_of_spend_product.php"/>
</html>

<?php
} else{
    header('location:login.php');
}
?>