<?php
    include "inc/header.php";
    include "inc/connection.php";
?>
            
<div class="page-heading">
    <h3>Profile Statistics</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Profile Views</h6>
                                    <h6 class="font-extrabold mb-0">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Followers</h6>
                                    <h6 class="font-extrabold mb-0">183.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Following</h6>
                                    <h6 class="font-extrabold mb-0">80.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Saved Post</h6>
                                    <h6 class="font-extrabold mb-0">112</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-4">
                <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add New Category</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" method = "POST">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Category Name</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Input with icon left" id="first-name-icon" name = "cat_name">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">

                                                <div class="form-group has-icon-left">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Category Description</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Category Description" name = "cat_desc"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1" name= "cat_submit">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <?php 
                                    if(isset($_POST['cat_submit'])){
                                        $cat_name=$_POST['cat_name'];
                                        $cat_desc=$_POST['cat_desc'];

                                        $query2="INSERT INTO category (c_name, c_desc) VALUES ('$cat_name', '$cat_desc')";
                                        $result2=mysqli_query($db, $query2);
                                        if($result2){
                                            header('Location: category.php');
                                        }else{
                                            echo "Category Add Error";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        if(isset($_GET['edit_id'])){
                            $edit_id = $_GET['edit_id'];

                            $query4 = "SELECT * FROM category WHERE c_id = '$edit_id' ";
                            $result4 = mysqli_query($db,$query4);
                            while($row = mysqli_fetch_assoc($result4)){
                                $c_id = $row["c_id"];
                                $c_name = $row["c_name"];
                                $c_desc = $row["c_desc"];
                            }
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Update Category</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical" method = "POST">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="first-name-icon">Category Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Input with icon left" id="first-name-icon" name = "cat_name" value= "<?php echo $c_name ?>">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">

                                                        <div class="form-group has-icon-left">
                                                            <label for="exampleFormControlTextarea1" class="form-label">Category Description</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Category Description" name = "cat_desc" value= "<?php echo $c_desc ?>"><?php echo $c_desc ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary me-1 mb-1" name= "cat_update">Update</button>
                                                        <button type="reset"
                                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                            if(isset($_POST['cat_update'])){
                                                $cat_name = $_POST['cat_name'];
                                                $cat_desc = $_POST['cat_desc'];

                                                $query5 = "UPDATE category SET c_name='$cat_name', c_desc= '$cat_desc' WHERE c_id='$c_id'";
                                                $result5 = mysqli_query($db,$query5);

                                                if($result5){
                                                    echo "Updated successfully";
                                                    header('Location: category.php');
                                                }else{
                                                    echo "Deleting error";
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <div class="col-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Category List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Category Name</th>
                                            <th>Description</th>
                                            <th>Total Posts</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Read post count -->
                                        <?php 
                                            // $query6 = "SELECT * FROM category ORDER BY c_name ASC";
                                            // $result = mysqli_query($db,$query6);
                                            // while($row = mysqli_fetch_assoc($result)){
                                            //     $c_id = $row["c_id"];
                                            //     $c_name = $row["c_name"];
                                            //     $c_desc = $row["c_desc"];

                                            //     $pquery = "SELECT * FROM posts WHERE cat_id='$c_id'";
                                            //     $view_result = mysqli_query($db, $pquery);
                                            //     $postCount = mysqli_num_rows($view_result);

                                            //     $p_count_update = "UPDATE category SET p_count='$postCount' WHERE c_id='$c_id'";
                                            //     $result5 = mysqli_query($db,$p_count_update);
                                            // }
                                        ?>
                                        
                                        <!-- Read Category info from database -->
                                        <?php
                                            $query = "SELECT * FROM category";
                                            $result = mysqli_query($db,$query);
                                            $count = 0;
                                            while($row = mysqli_fetch_assoc($result)){
                                                $c_id = $row["c_id"];
                                                $c_name = $row["c_name"];
                                                $c_desc = $row["c_desc"];
                                                $p_count= $row["p_count"];
                                                $count++;
                                                ?>
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <img src="assets/images/faces/5.jpg">
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0"><?php echo $count ?></p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0"><?php echo $c_name ?></p>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0"><?php echo $c_desc ?></p>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0"><?php echo $p_count ?></p>
                                                    </td>
                                                    <td class='col-auto'>
                                                        <a type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" href= "category.php?delete_id=<?php echo $c_id ?>"><i class='fa fa-trash text-danger'></i></a>
                                                        <a type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href= "category.php?edit_id=<?php echo $c_id ?>"><i class="far fa-edit text-success ms-2"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="assets/images/faces/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">John Duck</h5>
                            <h6 class="text-muted mb-0">@johnducky</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
            </div>
        </div>
    </section>
    <?php 
        if(isset($_GET['delete_id'])){
            $delete_id = $_GET['delete_id'];

            delete('category', 'c_id', $delete_id, 'category.php');
        }
    ?>
</div>

            <?php
                include "inc/footer.php";
            ?>


