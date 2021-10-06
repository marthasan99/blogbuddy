
<?php
    include "connection.php";

    if($db){
        echo "connection done.";
    }else{
        echo "connection failed";
    }

    function delete($table, $key, $d_id, $url){
        include "connection.php";
        // Table Name
        // Primary Key
        // Delete ID
        // Redirect url
        $query3 = "DELETE FROM $table WHERE $key = '$d_id'";
        $result3 = mysqli_query ($db ,$query3);

        if($result3){
            echo "deleted successfully";
            header('Location:'.$url);
        }else{
            echo "Deleting error".mysqli_error($db);
        }
    }
    function filedelete($photoTable,$table,$key,$d_id){
        global $db;
        $photoQuery = "SELECT $photoTable FROM $table WHERE $key='$d_id'";
        $photoRes = mysqli_query($db,$photoQuery);
        while($row = mysqli_fetch_assoc($photoRes)){
            $photoName = $row['u_photo'];
            unlink('assets/images/users/'.$photoName);
        }
        
    }
?>