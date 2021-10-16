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
                        <div class="container mt-5">
                            <div class="d-flex justify-content-center row">
                                <div class="d-flex flex-column col-md-12">
                                    <div class="coment-bottom bg-light p-2 px-4">
                                    <?php
                                        if(isset($_SESSION['u_id']) ){
                                            $logged_in_id = $_SESSION['u_id'];
                                            ?>  
                                                <form method="post">
                                                    <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                                                        <img class="img-fluid img-responsive rounded-circle mr-2" src="admin/assets/images/users/<?php echo $_SESSION['u_photo']; ?>" width="38">
                                                        <input type="text" class="form-control mr-3" placeholder="Add comment" name="comment">
                                                        <button class="btn btn-primary" type="submit" name="com_submit">Comment</button>
                                                    </div>
                                                </form>
                                            <?php
                                                $currentUser = $_SESSION['u_id'];
                                                $currentDate = date("Y-m-d");
                                                if(isset($_POST['com_submit'])){
                                                    $comment = $_POST['comment'];

                                                    $com_query = "INSERT INTO comments (post_id,user_id,comment,com_date) VALUES ('$p_id','$user_id','$comment','$currentDate')";
                                                    $com_result = mysqli_query($db,$com_query);
                                                    if($com_result){
                                                        $location = "/blogbuddy/singlepage.php?post_id=$post_id";
                                                        header("Location:$location");

                                                    }else{
                                                        die('Comment Add Error'.mysqli_error($db));
                                                    }
                                                }

                                                
                                        }else{
                                            ?>
                                                <div>
                                                    <p>Please <a href="admin/index.php">log in</a> to comment</p>
                                                </div>
                                            <?php
                                        }
                                        $com_read = "SELECT * FROM comments WHERE post_id='$p_id' Order by com_id ASC";
                                        $com_read_res = mysqli_query($db, $com_read);
                                        while($row = mysqli_fetch_assoc($com_read_res)){
                                            $com_id = $row['com_id'];
                                            $post_id = $row['post_id'];
                                            $user_id = $row['user_id'];
                                            $comment = $row['comment'];
                                            $com_date = $row['com_date'];
                                            ?>
                                                <div class="commented-section mt-2">
                                                    <div class="d-flex flex-row align-items-center commented-user">
                                                        <h5 class="mr-2">
                                                        <?php
                                                            $userQuery = "SELECT * FROM users WHERE u_id='$user_id'";
                                                            $userRes = mysqli_query($db, $userQuery);
                                                            while($row = mysqli_fetch_assoc($userRes)){
                                                                $u_name = $row['u_name'];
                                                                echo $u_name;
                                                            }
                                                        ?>
                                                        </h5>
                                                        <span class="dot mb-1"></span><span class="mb-1 ml-2">
                                                            <?php 
                                                                echo $com_date;
                                                            ?>    
                                                        </span>
                                                    </div>
                                                    <div class="comment-text-sm">
                                                        <span>
                                                            <?php 
                                                                echo $comment;
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="reply-section">
                                                        <div class="d-flex flex-row align-items-center voting-icons"><i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span class="ml-2">10</span><span class="dot ml-2"></span>
                                                            <h6 class="ml-2 mt-1">Reply</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    ?>
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
    <style>
        .bdge {
            height: 21px;
            background-color: orange;
            color: #fff;
            font-size: 11px;
            padding: 8px;
            border-radius: 4px;
            line-height: 3px
        }

        .comments {
            text-decoration: underline;
            text-underline-position: under;
            cursor: pointer
        }

        .dot {
            height: 7px;
            width: 7px;
            margin-top: 3px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block
        }

        .hit-voting:hover {
            color: blue
        }

        .hit-voting {
            cursor: pointer
        }
    </style>
</html>
