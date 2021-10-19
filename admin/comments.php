<?php
    include "inc/header.php";
?>
<?php 
    if(isset($_GET['do'])){
        $do = $_GET['do'];
    }else{
        $do == 'manage';
    }

    if($do == 'manage'){
        //manage
        ?>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Comments</h3>
                        <p class="text-subtitle text-muted">For user to check they list</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Comments</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Comments Datatable
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Comments</th>
                                    <th>Author</th>
                                    <th>Post</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <!--insert data from database-->
                                <?php 
                                    $query = "SELECT * FROM comments Order by com_id Desc";
                                    $view_result = mysqli_query($db, $query);
                                    $count = 0;
                                    while($row = mysqli_fetch_assoc($view_result)){
                                        $com_id          = $row['com_id'];
                                        $post_id         = $row['post_id'];
                                        $user_id         = $row['user_id'];
                                        $comment         = $row['comment'];
                                        $com_date        = $row['com_date'];
                                        $count++;

                                        ?>
                                            <tr>
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $com_date ?></td>
                                                <td>
                                                    <?php
                                                        echo $comment;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $userQuery = "SELECT * FROM users WHERE u_id='$user_id'";
                                                        $userRes = mysqli_query($db, $userQuery);
                                                        while($row = mysqli_fetch_assoc($userRes)){
                                                            $u_name = $row['u_name'];
                                                            echo $u_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $userQuery = "SELECT * FROM posts WHERE p_id='$post_id'";
                                                        $userRes = mysqli_query($db, $userQuery);
                                                        while($row = mysqli_fetch_assoc($userRes)){
                                                            $p_title = $row['p_title'];
                                                            echo $p_title;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Profile" href= ""><i class='fa fa-eye text-primary'></i></a>
                                                    <a type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" href= "comments.php?do=delete&d_id=<?php echo $com_id; ?>"><i class='fa fa-trash text-danger'></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
        </div>
        <?php
    }
    if($do == 'delete'){
        //delete

        if(isset($_GET['d_id'])){
            $delete_id = $_GET['d_id'];
            delete('comments', 'com_id', $delete_id, 'comments.php?do=manage');
        }
    }
?>
    

    <section class="row">
        <div class="col-12 col-lg-12">
        </div>
    </section>

</div>

<?php
    include "inc/footer.php";
?>


