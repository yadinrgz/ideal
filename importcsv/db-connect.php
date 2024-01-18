<?php
// DB Host
$host = "localhost";
// DB Username
$uname = "root";
// DB Password
$password = "root";
// DB Name
$dbname = "csvimport";


$conn = new mysqli($host, $uname, $password, $dbname);
if(!$conn){
    die("Database Connection Failed.");
}
?>