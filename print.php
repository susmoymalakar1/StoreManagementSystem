<?php
    include('connection.php');
    error_reporting(0);
    $sql="SELECT * FROM product";
    $query=$connection->query($sql);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">
                <h3>Data List</h3>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product code</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row=$query->fetch_assoc()){
                        ?>
                        <tr>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['product_code']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
            <div class="col">
                
            </div>
        </div>
    </div>
    <script>
        window.addEventLister('load',window.print());
    </script>
</body>
</html>