<?php
$host="localhost";
$user="root";
$pass="";
$dbname="workeazy";
$conn= mysqli_connect($host,$user,$pass,$dbname);
if(!$conn)

{
    die("database not connected". mysqli_connect_error());
}
?>