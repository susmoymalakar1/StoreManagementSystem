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
    <title>Edit Users</title>
    <style>
       .container{
        width: 30%;
        border-radius: 20px;
        margin-top:90px;
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

           $sql="SELECT * FROM users WHERE user_id=$getid";
           $query= $connection->query($sql);
           $data=mysqli_fetch_assoc($query);

           $user_id=$data['user_id'];
           $user_first_name=$data['user_first_name'];
           $user_last_name=$data['user_last_name'];
           $user_email=$data['user_email'];
           $user_password=$data['user_password'];
       } 

       if(isset($_GET['user_first_name']))
        {
            $new_user_first_name=$_GET['user_first_name'];
            $new_user_last_name=$_GET['user_last_name'];
            $new_user_email=$_GET['user_email'];
            $new_user_password=$_GET['user_password'];
            $new_user_id=$_GET['user_id'];

            $sql1="UPDATE users SET user_first_name='$new_user_first_name',
                user_last_name='$new_user_last_name',
                user_email='$new_user_email',
                user_password='$new_user_password'
                 WHERE user_id=$new_user_id";

            if($connection->query($sql1)== TRUE)
            {
                echo "<script>alert('Record Update successfully!')</script>";
                ?>
                     <meta http-equiv="refresh" content="0; url=http://localhost/storeMS/list_of_users.php"/><!-- content means time koto secend e refresh hobe-->
                <?php
            }
            else{
                echo "<script>alert('Record not Update!')</script>";
            }
        }
    ?>
    <div class="container">
        <form action="edit_users.php" method="GET" class="form-control bg-secondary text-white">
            <h3 class='text-center'>Edit Users</h3>
            First Name :<br/>
            <input type="text" name="user_first_name" class="form-control" value="<?php echo $user_first_name ?>"><br><br>
            Last Name :<br>
            <input type="text" name="user_last_name" class="form-control" value="<?php echo $user_last_name ?>"><br><br>
            Email :<br>
            <input type="email" name="user_email" class="form-control" value="<?php echo $user_email ?>"><br><br>
            Password :<br>
            <input type="password" name="user_password" class="form-control" value="<?php echo $user_password ?>"><br><br>
            <input type="text" name="user_id" class="form-control" value="<?php echo $user_id ?>" hidden><br><br>
            <input type="Submit" name="submit" value="submit" class=" btn btn-success form-control mb-2"> 
        </form>
    </div>
    
</body>
</html>

<?php
} else{
    header('location:login.php');
}
?>