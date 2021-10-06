<?php
    $db = mysqli_connect('localhost', 'root', '', 'blogbuddy');

    if($db){
        //echo "Connection Established";
    }else{
        echo "Database Connection Error";
    }
?>