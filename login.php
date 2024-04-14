<?php
   include('connection.php');
   error_reporting(0);
   session_start();//kichu data save kore rakhar jonno eta use kora hoy
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="login-style.css">
    <style>
    .container{
        background: azure;
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
        if(isset($_POST['user_email']))
        {
            $user_email    =$_POST['user_email'];
            $user_password =$_POST['user_password'];

            $sql="SELECT * FROM users WHERE user_email='$user_email' AND user_password='$user_password'";
            $query=$connection->query($sql);
            if(mysqli_num_rows($query)>0 )
            {
                $data=mysqli_fetch_array($query);//array theke information nibo
                $user_first_name=$data['user_first_name'];
                $user_last_name=$data['user_last_name'];
                $_SESSION['user_first_name']=$user_first_name;
                $_SESSION['user_last_name']=$user_last_name;

                header('location:index.php');
            }
            else{
                echo "<script>alert('ERROR! Please Enter Correct Password or Email')</script>";
            }
        }
    ?>
    <div class="container">
        <h1 class="text-center">Login</h1>
        <form action="login.php" method="POST" class="login_form">
            Email :<br>
            <input type="email" name="user_email" required><br><br>
            Password :<br>
            <input type="password" name="user_password" required><br><br>
            <input type="submit"  value="Login" class="btn btn-success mb-3">
        </form>
    </div>
    
</body>
</html>