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
                        $query = "SELECT * FROM posts ORDER BY p_id Desc";
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
                                    <a href="#!"><img class="card-img-top" src="admin/assets/images/posts/<?php echo $p_thumbnail; ?>" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted"><?php echo $p_date; ?></div>
                                        <h2 class="card-title"><?php echo $p_title; ?></h2>
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
                                        <a class="btn btn-primary" href="#!">Read more →</a>
                                    </div>
                                </div>
                            <?php
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
