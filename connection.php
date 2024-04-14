<?php
    $hostname='localhost';
    $username='root';
    $password='';
    $dbname='store_db';
    $connection=new mysqli($hostname,$username,$password,$dbname);
    if($connection->connect_error)
    {
        die("Connection failed:" .$connection->connect_error);
    }
    ?>