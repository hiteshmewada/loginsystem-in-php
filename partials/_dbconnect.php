<?php
    $username="root";
    $pass="";
    $db="hSecure";
    $server="localhost";
    $con=mysqli_connect($server,$username,$pass,$db);
    if(!$con){
        die ("Error-> ". mysqli_connect_error());
    }
?>
