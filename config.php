<?php
    $dbname="rinika";
    $username="root";
    $servername="localhost";
    $password="";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
    echo "not connected";
    }
?>