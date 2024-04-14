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
    <title>List of Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="container bg-light">
            <div class="container p-4 m-4">
                        <h2 class='text-center'>Users List</h2>
                    <?php
                        
                        $sql="SELECT * FROM users";
                        $query=$connection->query($sql);
                        echo "<table class='table table-success table-striped table-hover'>
                                    <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    </tr>";
                        while($data=mysqli_fetch_assoc($query))
                        {
                            $user_first_name=$data['user_first_name'];
                            $user_last_name= $data['user_last_name'];
                            $user_email= $data['user_email'];
                            $user_id= $data['user_id'];
                            echo "<tr>
                                    <td>$user_first_name</td>
                                    <td>$user_last_name</td>
                                    <td>$user_email</td>
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
        <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/list_of_users.php"/>
</html>

<?php
} else{
    header('location:login.php');
}
?>