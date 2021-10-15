<?php include "header.php"; ?>
        <!-- Page header with logo and tagline-->
        <header class="py-5 border-bottom mb-4 header">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Blog Buddy</h1>
                    <p class="lead mb-0">A Blog Website</p>
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

                        // variable for pagination
                        $total_post_query= "SELECT SUM(p_count) AS totalPost FROM category";
                        $total_post_result = mysqli_query($db, $total_post_query);
                        $row = mysqli_fetch_assoc($total_post_result);
                        $total_post = $row['totalPost'];
                        $post_per_page = 3;
                        if($total_post % $post_per_page == 0){
                            $total_page = $total_post/$post_per_page;
                        }else{
                            $total_page = intval($total_post/$post_per_page)+1;
                        }
                        

                        
                        if(isset($_GET['page_no'])){
                            $page_no = $_GET['page_no'];
                            //starting point
                            $start = ($page_no-1)* $post_per_page;
                        }else{
                            header('Location: index.php?page_no=1');
                        }

                        $query = "SELECT * FROM posts ORDER BY p_id Desc LIMIT $start, $post_per_page";
                        $view_result = mysqli_query($db, $query);
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
                                    <a href="#!"><img class="card-img-top" style="height:400px" src="admin/assets/images/posts/<?php echo $p_thumbnail; ?>" alt="..." /></a>
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

                            
                    ?>
                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            
                            <?php 
                                if(isset($_GET['page_no'])){
                                    $page_no = $_GET['page_no']? $_GET['page_no']:1;
                                    if($page_no>1 && $page_no<=$total_page){
                                        ?>
                                            <li class="page-item"><a class="page-link" href="index.php?page_no=<?php echo $page_no-1; ?>" >Prev</a></li>
                                        <?php
                                    }
                                }

                                for($i=0;$i<$total_page;$i++){
                                    ?>
                                        <li class="page-item"><a class="page-link" href="index.php?page_no=<?php echo $i+1; ?>"><?php echo $i+1 ?></a></li>
                                    <?php
                                }

                                if(isset($_GET['page_no'])){
                                    $page_no = $_GET['page_no'];
                                    if($page_no<$total_page && $page_no>0){
                                        ?>
                                            <li class="page-item"><a class="page-link" href="index.php?page_no=<?php echo $page_no+1; ?>">Next</a></li>
                                        <?php
                                    }
                                }
                            ?>

                            
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
