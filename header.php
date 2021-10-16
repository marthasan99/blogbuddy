<?php 
    include "admin/inc/connection.php"; 
    session_start();
    ob_start();
    date_default_timezone_set('Asia/Dhaka');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Buddy</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="page/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Blog Buddy</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php 
                            $query = "SELECT * FROM category ORDER BY p_count DESC";
                            $result = mysqli_query($db,$query);
                            while($row = mysqli_fetch_assoc($result)){
                                $c_id = $row["c_id"];
                                $c_name = $row["c_name"];
                                $c_desc = $row["c_desc"];
                                ?>
                                    <li class="nav-item"><a class="nav-link" href="category-page.php?cat_id=<?php echo $c_id; ?>"><?php echo $c_name;?></a></li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>