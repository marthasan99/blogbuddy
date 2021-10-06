<?php
    include "inc/header.php";

    if($_SESSION['u_role'] != 2){
        header('Location: dashboard.php');
    }
?>
            

<div class="page-content">

    <!-- Structure -->
    
    <?php 
        if(isset($_GET['do'])){
            $do = $_GET['do'];
        }else{
            $do = 'manage';
        }

        if($do == 'manage'){
            //manage
            ?>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>All Posts Infomation</h3>
                            <p class="text-subtitle text-muted">For user to check they list</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Posts Datatable
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Photo</th>
                                        <th>Title</th>
                                        <th>Desc</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <!--insert data from database-->
                                    <?php 
                                        $query = "SELECT * FROM posts";
                                        $view_result = mysqli_query($db, $query);
                                        $count = 0;
                                        while($row = mysqli_fetch_assoc($view_result)){
                                            $p_id          = $row['p_id'];
                                            $p_title       = $row['p_title'];
                                            $p_desc        = $row['p_desc'];
                                            $p_thumbnail   = $row['p_thumbnail'];
                                            $cat_id        = $row['cat_id'];
                                            $user_id       = $row['user_id'];
                                            $p_date        = $row['p_date'];
                                            $p_status      = $row['p_status'];
                                            $count++;

                                            ?>
                                                <tr>
                                                    <td><?php echo $count ?></td>
                                                    <td><?php echo $p_date ?></td>   
                                                    <td>
                                                        <img src="assets/images/posts/<?php echo $p_thumbnail ?>" style="border-radius:6px;" width="60">
                                                    </td>                                              
                                                    <td><?php echo $p_title ?></td>
                                                    <td><?php echo substr($p_desc, 0, 150) ?></td>
                                                    <td>
                                                        <?php
                                                            $catQuery = "SELECT * FROM category WHERE c_id= '$cat_id'";
                                                            $catRes = mysqli_query($db, $catQuery);
                                                            while($row = mysqli_fetch_assoc($catRes)){
                                                                $c_name = $row['c_name'];
                                                                $c_desc = $row['c_desc'];
                                                                $c_id = $row['c_id'];
                                                            }
                                                            echo $c_name;
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
                                                    <!-- <td class="form-group">
                                                        <label for="userrole" class="form-label">User Role</label>
                                                        <fieldset class="form-group">
                                                            <select class="form-select" id="userrole" name="userrole">
                                                                <option value="0" selected>Active</option>
                                                                <option value="1">Inactive</option>
                                                            </select>
                                                        </fieldset>
                                                    </td> -->
                                                    <td>
                                                        <?php
                                                            if($p_status == 0){
                                                                echo '<span class="badge bg-danger" >Inactive</span>';
                                                            }
                                                            if($p_status == 1){
                                                                echo '<span class="badge bg-success">Active</span>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Profile" href= ""><i class='fa fa-eye text-primary'></i></a>
                                                        <a type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" href= "posts.php?do=delete&d_id=<?php echo $p_id; ?>"><i class='fa fa-trash text-danger'></i></a>
                                                        <a type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href= "posts.php?do=edit&edit_id=<?php echo $p_id;?>"><i class='fa fa-edit text-success'></i></a>
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
        if($do == 'add'){
            //add
            ?>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add A New Post</h4>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Post Title*</label> 
                                            <input type="text" id="title" class="form-control" placeholder="Title" name="postTitle">
                                            <p><small class="text-muted" required="required">.Please enter post title</small></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="desc" class="form-label">Description*</label>
                                            <textarea class="form-control" id="desc" rows="10" placeholder="Description" name = "postDesc" value= ""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category" class="form-label"> SelectCategory</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="category" name="postCategory">
                                                    <?php 
                                                        $catQuery2 = "SELECT * FROM category";
                                                        $catRes2 = mysqli_query($db, $catQuery2);
                                                        while($row = mysqli_fetch_assoc($catRes2)){
                                                            $c_name = $row['c_name'];
                                                            $c_desc = $row['c_desc'];
                                                            $c_id = $row['c_id'];
                                                            ?>
                                                            <option value="<?php echo $c_id ?>"><?php echo $c_name ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="form-group">
                                            <label for="formFile" class="form-label">Select a Thumbnail</label>
                                            <input class="form-control" type="file" id="formFile" name="image">
                                            <p><small class="text-muted">Please use a square photo (JPG, JPEG, PNG)</small></p>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="add_post">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php 
                            $currentUser = $_SESSION['u_id'];
                            $currentDate = date("Y-m-d");
                            if(isset($_POST['add_post'])){
                                $postTitle = mysqli_real_escape_string($db, $_POST['postTitle']);
                                $postDesc = mysqli_real_escape_string($db, $_POST['postDesc']);
                                $postCategory = $_POST['postCategory'];
                                $file_name = $_FILES['image']['name'];
                                $tmp_name = $_FILES['image']['tmp_name'];
                                //$file_size = $_FILES['image']['size'];
                                
                                $extn_array = explode('.',$_FILES['image']['name']);
                                $extn = strtolower(end($extn_array));
                                $extentions = array("png", "jpg", "jpeg");

                                

                                if(in_array($extn,$extentions) === false){
                                    echo "Please insert PNG, JPG, JPEG format file!";
                                }else{
                                    $rand = rand();
                                    $updatedname = $rand.$file_name;
                                    //transfer image to a folder 
                                    move_uploaded_file($tmp_name, 'assets/images/posts/'.$updatedname);
                                    $postAddQuery = "INSERT INTO posts (p_title, p_desc, p_thumbnail, cat_id, user_id, p_date, p_status) 
                                    VALUES ('$postTitle','$postDesc', '$updatedname', '$postCategory', '$currentUser','$currentDate', '1')";
                                    $postAdd = mysqli_query($db,$postAddQuery);
                                    if($postAdd){
                                        header('Location:posts.php?do=manage');
                                    }else{
                                        die('Post Add Error'.mysqli_error($db));
                                    }
                                }
                            }
                        ?>
                    </div>
                    <?php echo $currentDate;?>
                </section>
            <?php
        }
        if($do == 'edit'){
            //edit
            if(isset($_GET['edit_id'])){
                $edit_id = $_GET['edit_id'];
                $query = "SELECT * FROM posts WHERE p_id='$edit_id'";
                
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
                }
                ?>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Post Information</h4>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="posts.php?do=update">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="p_title">Post Title*</label> 
                                            <input type="text" id="p_title" class="form-control" placeholder="Post title" name="p_title" value="<?php echo $p_title;?>">
                                            <p><small class="text-muted">.Please enter post title</small></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_desc" class="form-label">Address</label>
                                            <textarea class="form-control" id="p_desc" rows="10" placeholder="Address" name = "p_desc" value="<?php echo $p_desc;?>"><?php echo $p_desc;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="p_cat" class="form-label">Select Category</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="p_cat" name="p_cat">
                                                    <?php 
                                                        $query = "SELECT * FROM category";
                                                        $result = mysqli_query($db,$query);
                                                        $count = 0;
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            $c_id = $row["c_id"];
                                                            $c_name = $row["c_name"];
                                                            $c_desc = $row["c_desc"];
                                                            ?>
                                                            <option value="<?php echo $c_id; ?>" 
                                                            <?php 
                                                                if($cat_id == $c_id){
                                                                    echo "Selected";
                                                                }
                                                            ?>
                                                            >
                                                            <?php echo $c_name; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_status" class="form-label">Post Status</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="p_status" name="p_status">
                                                    <option value="0" <?php if($p_status == 0){echo "selected";} ?>>Inactive</option>
                                                    <option value="1" <?php if($p_status == 1){echo "selected";} ?>>Active</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="form-group">
                                            <img src='assets/images/posts/<?php echo $p_thumbnail; ?>' style = "width:350px;height:150px;">
                                            <label for="formFile" class="form-label" style="display:block;">Select Photo</label>
                                            <input class="form-control" type="file" id="formFile" name="image">
                                            <p><small class="text-muted">Please use a square photo (JPG, JPEG, PNG)</small></p>
                                        </div>
                                        <input type="hidden" class="form-controll" name="edit_post_id" value="<?php echo $edit_id; ?>">
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="update_post">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <?php
            }
        }
        if($do == 'update'){
            //update
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $edit_id = $_POST['edit_post_id'];
                $p_title = $_POST['p_title'];
                $p_desc  = mysqli_real_escape_string($db, $_POST['p_desc']);
                $p_cat = $_POST['p_cat'];
                $p_status = $_POST['p_status'];
                $file_name = $_FILES['image']['name'];
                $file_temp_name = $_FILES['image']['tmp_name'];
                
                
                if(empty($password) && !empty($file_name)){
                    $extn_array = explode('.',$_FILES['image']['name']);
                    $extn = strtolower(end($extn_array));
                    $extentions = array("png", "jpg", "jpeg", "webp");

                    if(in_array($extn,$extentions) === true){
                        $rand = rand();
                        $updatedname = $rand.$file_name;
                        //transfer image to a folder 
                        move_uploaded_file($file_temp_name, 'assets/images/posts/'.$updatedname);
                    }else{
                        echo '<span class="alert alert-danger">Please select png, jpg or jpeg image</span>';
                    }

                    $p_updateQuery = "UPDATE posts SET p_title='$p_title', p_desc='$p_desc', cat_id='$p_cat',
                     p_thumbnail='$updatedname', p_status='$p_status' WHERE p_id='$edit_id' ";
                     $p_updateRes = mysqli_query($db, $p_updateQuery);
                     if($p_updateRes){
                         header('Location: posts.php');
                     }else{
                         die("Post Update Error (1)".mysqli_error($db));
                     }
                     
                }else{
                    $p_updateQuery = "UPDATE posts SET p_title='$p_title', p_desc='$p_desc', cat_id='$p_cat',
                     p_status='$p_status' WHERE p_id='$edit_id' ";
                     $p_updateRes = mysqli_query($db, $p_updateQuery);
                     if($p_updateRes){
                         header ('Location: posts.php');
                     }else{
                         die("User Update Error (1)".mysqli_error($db));
                     }
                }

            }
        }
        if($do == 'delete'){
            //delete
            if(isset($_GET['d_id'])){
                $delete_id = $_GET['d_id'];
                filedelete('u_photo','users','u_id',$delete_id);
                delete('posts', 'p_id', $delete_id, 'posts.php');
            }
        }

        $do = 'manage'; //manage userS
        $do = 'add'; //add user
        $do = 'edit'; //edit user
        $do = 'update'; //update user
        $do = 'delete'; //delete user

        //default
        $do = 'manage'
    ?>

    <section class="row">
        <div class="col-12 col-lg-12">
        </div>
    </section>

</div>

<?php
    include "inc/footer.php";
?>


