<?php include "header.php"; ?>
        <!-- Page header with logo and tagline-->
        <header class="py-5 border-bottom mb-4 header">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Seach Result</h1>
                    <p class="lead mb-0"></p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <?php 
                        if(isset($_POST["search"])){
                            $search_text = mysqli_real_escape_string($db, $_POST["search_text"]);
                            
                            $query = "SELECT * FROM posts WHERE p_title LIKE '%$search_text%' OR p_desc LIKE '%$search_text%'";
                            $view_result = mysqli_query($db, $query);
                            $search_result_count = mysqli_num_rows($view_result);
                            if($search_result_count == 0){
                                echo "No post found. <a href='index.php'>Back to Home</a>";
                            }
                            while($row = mysqli_fetch_assoc($view_result)){
                                $p_id          = $row['p_id'];
                                $p_title       = $row['p_title'];
                                $p_desc        = $row['p_desc'];
                                $p_thumbnail   = $row['p_thumbnail'];
                                $cat_id        = $row['cat_id'];
                                $user_id       = $row['user_id'];
                                $p_date        = $row['p_date'];
                                $p_status      = $row['p_status'];

                                ?>
                                <div class="card mb-4">
                                    <a href="#!"><img class="card-img-top" src="admin/assets/images/posts/<?php echo $p_thumbnail; ?>" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted"><?php echo $p_date; ?></div>
                                        <a class="p_title" href="singlepage.php?post_id=<?php echo $p_id; ?>"><h2 class="card-title"><?php echo $p_title; ?></h2></a>
                                        <a href="#" style = "color:#000;font-weight:bold;text-decoration:none;margin-bottom=10px;">By 
                                        <?php 
                                            $query2 = "SELECT * FROM users WHERE u_id='$user_id'";
                                            $view_result2 = mysqli_query($db, $query2);
                                            while($row = mysqli_fetch_assoc($view_result2)){
                                                $u_id      = $row['u_id'];
                                                $u_name    = $row['u_name'];
                                                $u_photo   = $row['u_photo'];
                                                $u_email   = $row['u_email'];
                                                $u_pass    = $row['u_pass'];
                                                $u_phone   = $row['u_phone'];
                                                $u_address = $row['u_address'];
                                                $u_gender  = $row['u_gender'];
                                                $u_dob     = $row['u_dob'];
                                                $u_biodata = $row['u_biodata'];
                                                $u_role    = $row['u_role'];
                                                $u_status  = $row['u_status'];

                                                echo $u_name;
                                            }
                                        ?>
                                        </a>
                                        <p class="card-text"><?php echo substr($p_desc,0,250)." ..."; ?></p>
                                        <a class="btn btn-primary" href="singlepage.php?post_id=<?php echo $p_id; ?>">Read more →</a>
                                    </div>
                                </div>
                            <?php
                        }
                        
                            
                        }

                            
                    ?>
                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="#!">15</a></li>
                            <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                        </ul>
                    </nav>
                </div>
                <?php include "sidebar.php"; ?>
                </div>
        <?php include "footer.php"; ?>

<style>
    .p_title{
        color:#000!important;
    }
    .p_title:hover{
        text-decoration:none!important;
    }
</style>
