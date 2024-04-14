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
    <title>delete_category</title>
</head>
<body>
    <?php
        if(isset($_GET['id']))
        {
            $getid=$_GET['id'];
            $sql="DELETE FROM users WHERE user_id=$getid";
            $query= $connection->query($sql);
            if($query)
            {
                echo "<script>alert('Record Deleted')</script>";
                ?>
                <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/list_of_users.php"/><!-- content means time koto secend e refresh hobe-->
                <?php
            }
            else
            {
                echo "<script>alert('Sorry!Record not Deleted')</script>";
            }
        }
  
    ?>
    
</body>
</html>

<?php
} else{
    header('location:login.php');
}
?>