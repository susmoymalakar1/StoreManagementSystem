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
                        <h2 class='text-center'>Users List</h2>
                    <?php
                        $sql1="SELECT * FROM users";
                        $query1=mysqli_query($connection,$sql1);
                        $num_rows=mysqli_num_rows($query1);
                        $divided_num_rows=($num_rows/5)+1;

                        if(isset($_GET['pageno']))
                        {
                            $pagenumber=$_GET['pageno'];
                            $offset=($pagenumber-1)*5;

                            $pagenum_increment=$pagenumber+1;
                            $pagenum_decrement=$pagenumber-1;
                        }
                        else{
                            $offset=0;
                            $pagenumber=0;

                            $pagenum_decrement=0;
                            $pagenum_increment=2;
                        }

       $sql="SELECT * FROM users";
       $query=$connection->query($sql);
       echo "<table class='table table-success table-striped table-hover'>
                <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Operation</th>
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
                <td>
                <a href='edit_users.php?id=$user_id & fname=$user_first_name & lname=$user_last_name' class='btn btn-success' onclick='return checkupdate()'>Edit</a>
                <a href='delete_users.php?id=$user_id & fname=$user_first_name' class='btn btn-danger' onclick='return checkdelete()'>Delete</a>
                </td>
            </tr>";
       }
       echo "</table>";
    ?>
    <?php
                    if($pagenum_decrement<1)
                    {
                        echo " 
                            <span class='bg-success text-white py-2 px-3 m-2'> < </span>";
                    }
                    else
                    {
                        echo " <a href='list_of_users.php?pageno= $pagenum_decrement'>
                            <span class='bg-success text-white py-2 px-3 m-2'> < </span>
                        </a>";
                    }
                         
                    for($x=1;$x<$divided_num_rows;$x++)
                    {
                        if($x==$pagenumber)
                        {
                            echo "<span class='bg-dark text-white py-2 px-3 m-2'> $x </span>";
                        }
                        else
                        {
                            echo "<span class='bg-success text-white py-2 px-3 m-2'>
                            <a href='list_of_users.php?pageno=$x' class='text-white'> $x </a>
                            </span>";
                        }
                    }

                    if($pagenum_increment>$divided_num_rows)
                    {
                        echo " 
                            <span class='bg-success text-white py-2 px-3 m-2'> > </span>";
                    }
                    else
                    {
                        echo "<a href='list_of_users.php?pageno= $pagenum_increment'>
                    <span class='bg-success text-white py-2 px-3 m-2'> > </span>
                    </a>"; 
                    }
                    
                ?>
    </div><!--end of container-->
                    <div class="print text-center">
                        <a href="users_list_print.php" ><button class='btn btn-success' onclick='return checkprint()'>
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