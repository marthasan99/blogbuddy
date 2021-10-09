<?php include "header.php"; ?>
    <body>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <?php 
                            if(isset($_GET['post_id'])){

                                $post_id = $_GET["post_id"];
                                $query = "SELECT * FROM posts WHERE p_id='$post_id'";
                                $view_result = mysqli_query($db, $query);
                                if(mysqli_num_rows($view_result)==0){
                                    echo "No post found.";
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
                                        <header class="mb-4">
                                            <!-- Post title-->
                                            <h1 class="fw-bolder mb-1"><?php echo $p_title; ?></h1>
                                            <!-- Post meta content-->
                                            <div class="text-muted fst-italic mb-2">Posted on <?php echo $p_date; ?> by 
                                            <?php 
                                                $query = "SELECT * FROM users WHERE u_id='$user_id'";
                                                $view_result = mysqli_query($db, $query);
                                                while($row = mysqli_fetch_assoc($view_result)){
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
                                            </div>
                                            <!-- Post categories-->
                                            <?php
                                                $query = "SELECT * FROM category WHERE c_id='$cat_id'";
                                                $result = mysqli_query($db,$query);
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $c_id = $row["c_id"];
                                                    $c_name = $row["c_name"];
                                                    $c_desc = $row["c_desc"];
                                                    $p_count= $row["p_count"];
                                                    ?>
                                                        <a class="badge bg-secondary text-decoration-none link-light" href="#!"><?php echo $c_name; ?></a>
                                                    <?php
                                                }
                                            ?>
                                        </header>
                                        <!-- Preview image figure-->
                                        <figure class="mb-4"><img class="img-fluid rounded" src="admin/assets/images/posts/<?php echo $p_thumbnail; ?>" alt="..." /></figure>
                                        <!-- Post content-->
                                        <section class="mb-5">
                                            <p class="fs-5 mb-4"><?php echo $p_desc; ?></p>
                                        </section>
                                    </article>
                                    <?php
                                }
                            }
                        ?>
                        
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                                <!-- Comment with nested comments-->
                                <div class="d-flex mb-4">
                                    <!-- Parent comment-->
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                        <!-- Child comment 1-->
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                            </div>
                                        </div>
                                        <!-- Child comment 2-->
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                When you put money directly to a problem, it makes a good headline.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single comment-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Side widgets-->
                <?php include "sidebar.php"; ?>
            </div>
        </div>
        <!-- Footer-->
        <?php include "footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
