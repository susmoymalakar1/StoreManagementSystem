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
    <title>list_of_category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <div class="container bg-light">
                       
                    <div class="container p-4 m-4">
                        <h2 class='text-center'>Category List</h2>
                    <?php

                        $sql="SELECT * FROM category";
                        $query=$connection->query($sql);
                        echo "<table class='table table-success table-striped table-hover'>
                        <tr>
                            <th>Category</th>
                            <th>Date</th>
                        </tr>";
                        while($data=mysqli_fetch_assoc($query))
                        {
                            $category_id=$data['category_id'];
                            $category_name= $data['category_name'];
                            $category_entrydate= $data['category_entrydate'];
                            echo "<tr>
                            <td>$category_name</td>
                            <td>$category_entrydate</td>
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
        <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/list_of_category.php"/>
</html>

<?php
} else{
    header('location:login.php');
}
?>
