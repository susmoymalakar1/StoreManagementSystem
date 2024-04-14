<?php
function data_list($tablename,$column1,$column2){
    include('connection.php');
   $sql="SELECT * FROM $tablename";
        $query=$connection->query($sql);

    while($data=mysqli_fetch_assoc($query))
        {
            $data_id=$data[$column1];
            $data_name=$data[$column2];
            echo "<option value='$data_id'>$data_name</option>";
        }
    }
?>