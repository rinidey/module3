<?php
require_once "config.php";
    echo "success";
    $sid=$_GET['id'];
    echo $sid;
    $query= "DELETE FROM usertable WHERE id ='$sid'";
    $query_run=mysqli_query($conn,$query);
    if($query_run){
        header("Location: welcome.php");
    }
    else{
        echo "Not Deleted";
    }
?>