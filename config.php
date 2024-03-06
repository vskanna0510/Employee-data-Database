<?php

$dbhost = "localhost:3307"; 
$dbuser = "root";      
$dbpass = "Kanna0510$";   
$dbname = "Empd";  

$con = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
