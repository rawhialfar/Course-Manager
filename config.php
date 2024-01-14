<?php
$host = "localhost";
$username = "cis3760";
$password = "pass1234";
$dbname = "DB_schema";
    
$connection = mysqli_connect($host, $username, $password, $dbname);
if (!$connection)
{
    die("Database failed to connect: ".mysqli_connect_error());
}
?>