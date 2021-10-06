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
                            <h3>All Users Infomation</h3>
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
                            Users Datatable
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>User Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!--insert data from database-->
                                    <?php 
                                        $query = "SELECT * FROM users";
                                        $view_result = mysqli_query($db, $query);
                                        $count = 0;
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
                                            $count++;

                                            ?>
                                                <tr>
                                                    <td><?php echo $count ?></td>
                                                    <td>
                                                        <img src="assets/images/users/<?php echo $u_photo ?>" style="border-radius:100%;" width="60">
                                                     </td>
                                                    <td><?php echo $u_name ?></td>
                                                    <td><?php echo $u_email ?></td>
                                                    <td><?php echo $u_phone ?></td>
                                                    <td><?php
                                                            if($u_role == 0){
                                                                echo '<span class="badge bg-success" >Subscriber</span>';
                                                            }
                                                            if($u_role == 1){
                                                                echo '<span class="badge bg-warning">Editor</span>';
                                                            }
                                                            if($u_role == 2){
                                                                echo '<span class="badge bg-danger">Admin</span>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if($u_status == 0){
                                                                echo '<span class="badge bg-danger" >Inactive</span>';
                                                            }
                                                            if($u_status == 1){
                                                                echo '<span class="badge bg-success">Active</span>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Profile" href= ""><i class='fa fa-eye text-primary'></i></a>
                                                        <a type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" href= "users.php?do=delete&d_id=<?php echo $u_id; ?>"><i class='fa fa-trash text-danger'></i></a>
                                                        <a type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href= "users.php?do=edit&edit_id=<?php echo $u_id;?>"><i class='fa fa-edit text-success'></i></a>
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
                            <h4 class="card-title">Add A New User</h4>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">User Name*</label> 
                                            <input type="text" id="username" class="form-control" placeholder="User Name" name="username">
                                            <p><small class="text-muted" required="required">.Please enter user name</small></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="useremail">User Email*</label> 
                                            <input type="email" id="useremail" class="form-control" placeholder="someone@example.com" name="useremail">
                                            <p><small class="text-muted" required="required">.Please enter user name</small></p>
                                        </div>
                                        <!--<div class="form-group">
                                            <label for="basicInput">Basic Input</label>
                                            <input type="text" class="form-control" id="basicInput" placeholder="Enter email">
                                        </div>

                                        <div class="form-group">
                                            <label for="helpInputTop">Input text with help</label>
                                            <small class="text-muted">eg.<i>someone@example.com</i></small>
                                            <input type="text" class="form-control" id="helpInputTop">
                                        </div>-->

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" class="form-control" placeholder="********" name="password">
                                            <p><small class="text-muted">Use alphabetic and numeric to make it stronger.</small></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" id="phone" class="form-control" placeholder="Phone Number" name="phone">
                                            <p><small class="text-muted"></small></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" rows="3" placeholder="Address" name = "address" value= ""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender" class="form-label">Select Gender</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="gender" name="gender">
                                                    <option value="">Choose your gender</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="3">Others</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="form-group">
                                            <label for="birthday" class="form-label">Select Your Birthday</label>
                                            <input type="date" id="birthday" name="birthday" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="userrole" class="form-label">User Role</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="userrole" name="userrole">
                                                    <option value="0" selected>Subscriber</option>
                                                    <option value="1">Editor</option>
                                                    <option value="2">Admin</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="form-group">
                                            <label for="biodata" class="form-label">Biodata</label>
                                            <textarea class="form-control" id="biodata" rows="6" placeholder="Bio..." name = "biodata" value= ""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="formFile" class="form-label">Select Your Profile Photo</label>
                                            <input class="form-control" type="file" id="formFile" name="image">
                                            <p><small class="text-muted">Please use a square photo (JPG, JPEG, PNG)</small></p>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="add_user">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                        <!--<div class="form-group">
                                            <label for="disabledInput">Disabled Input</label>
                                            <input type="text" class="form-control" id="disabledInput" placeholder="Disabled Text"
                                                disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="disabledInput">Readonly Input</label>
                                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                                                value="You can't update me :P">
                                        </div>

                                        <div class="form-group">
                                            <label for="disabledInput">Static Text</label>
                                            <p class="form-control-static" id="staticInput">email@mazer.com</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="valid-state">Valid State</label>
                                        <input type="text" class="form-control is-valid" id="valid-state" placeholder="Valid"
                                            value="Valid" required>
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            This is valid state.
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="invalid-state">Invalid State</label>
                                        <input type="text" class="form-control is-invalid" id="invalid-state"
                                            placeholder="Invalid" value="Invalid" required>
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            This is invalid state.
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php 
                            if(isset($_POST['add_user'])){
                                $username = $_POST['username'];
                                $useremail = $_POST['useremail'];
                                $password = $_POST['password'];
                                $phone = $_POST['phone'];
                                $address = $_POST['address'];
                                $gender = $_POST['gender'];
                                $birthday = $_POST['birthday'];
                                $userrole = $_POST['userrole'];
                                $biodata = $_POST['biodata'];
                                $file_name = $_FILES['image']['name'];
                                $tmp_name = $_FILES['image']['tmp_name'];
                                //$file_size = $_FILES['image']['size'];
                                
                                $extn_array = explode('.',$_FILES['image']['name']);
                                $extn = strtolower(end($extn_array));
                                $extentions = array("png", "jpg", "jpeg");

                                

                                if(empty($username) || empty($useremail) || empty($password) || empty($_FILES['image']['name'])){
                                    echo '<span>Username, Email, Password, Profile Picture are required.</span>';
                                }else{
                                    if(in_array($extn,$extentions) === false){
                                        echo "Please insert PNG, JPG, JPEG format file!";
                                    }else{
                                        $rand = rand();
                                        $updatedname = $rand.$file_name;
                                        //transfer image to a folder 
                                        move_uploaded_file($tmp_name, 'assets/images/users/'.$updatedname);
                                        //password hass
                                        $hasspassword = SHA1($password);
                                        $userAddQuery = "INSERT INTO users (u_name, u_photo, u_email, u_pass, u_phone, u_address, u_gender, u_dob, u_biodata, u_role, u_status) 
                                        VALUES ('$username','$updatedname', '$useremail', '$hasspassword', '$phone', '$address', '$gender', '$birthday', '$biodata', '$userrole', '1')";
                                        $userAdd = mysqli_query($db,$userAddQuery);
                                        if($userAdd){
                                            header('Location:users.php?do=manage');
                                        }else{
                                            die('User Add Error'.mysqli_error($db));
                                        }
                                    }

                                    
                                }
                            }
                        ?>
                    </div>
                </section>
            <?php
        }
        if($do == 'edit'){
            //edit
            if(isset($_GET['edit_id'])){
                $edit_id = $_GET['edit_id'];
                $query = "SELECT * FROM users WHERE u_id='$edit_id'";
                
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
                }
                ?>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Profile</h4>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="users.php?do=update">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">User Name*</label> 
                                            <input type="text" id="username" class="form-control" placeholder="User Name" name="username" value="<?php echo $u_name;?>">
                                            <p><small class="text-muted">.Please enter user name</small></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="useremail">User Email*</label> 
                                            <input type="email" id="useremail" class="form-control" placeholder="someone@example.com" name="useremail" value="<?php echo $u_email;?>">
                                            <p><small class="text-muted" >.Please enter user name</small></p>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" class="form-control" placeholder="********" name="password">
                                            <p><small class="text-muted">Use alphabetic and numeric to make it stronger.</small></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" id="phone" class="form-control" placeholder="Phone Number" name="phone" value="<?php echo $u_phone;?>">
                                            <p><small class="text-muted"></small></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" rows="3" placeholder="Address" name = "address" value="<?php echo $u_address;?>"><?php echo $u_address;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender" class="form-label">Select Gender</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="gender" name="gender">
                                                    <option value="">Choose your gender</option>
                                                    <option value="1" <?php if($u_gender == 1){echo "selected";} ?>>Male</option>
                                                    <option value="2" <?php if($u_gender == 2){echo "selected";} ?>>Female</option>
                                                    <option value="3" <?php if($u_gender == 3){echo "selected";} ?>>Others</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="form-group">
                                            <label for="birthday" class="form-label">Select Your Birthday</label>
                                            <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo $u_dob;?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="userrole" class="form-label">User Role</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="userrole" name="userrole">
                                                    <option value="0" <?php if($u_role == 0){echo "selected";} ?>>Subscriber</option>
                                                    <option value="1" <?php if($u_role == 1){echo "selected";} ?>>Editor</option>
                                                    <option value="2" <?php if($u_role == 2){echo "selected";} ?>>Admin</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="form-group">
                                            <label for="userstatus" class="form-label">User Status</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="userstatus" name="userstatus">
                                                    <option value="0" <?php if($u_status == 0){echo "selected";} ?>>Inactive</option>
                                                    <option value="1" <?php if($u_status == 1){echo "selected";} ?>>Active</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="form-group">
                                            <label for="biodata" class="form-label">Biodata</label>
                                            <textarea class="form-control" id="biodata" rows="6" placeholder="Bio..." name = "biodata" value="<?php echo $u_biodata;?>"><?php echo $_SESSION['u_biodata'];?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <img src='assets/images/users/<?php echo $u_photo; ?>' style = "width:100px;height:150px;">
                                            <label for="formFile" class="form-label" style="display:block;">Select Photo</label>
                                            <input class="form-control" type="file" id="formFile" name="image">
                                            <p><small class="text-muted">Please use a square photo (JPG, JPEG, PNG)</small></p>
                                        </div>
                                        <input type="hidden" class="form-controll" name="edit_user_id" value="<?php echo $edit_id; ?>">
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="add_user">Submit</button>
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
                $edit_id = $_POST['edit_user_id'];
                $username = $_POST['username'];
                $useremail = $_POST['useremail'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $gender = $_POST['gender'];
                $birthday = $_POST['birthday'];
                $userrole = $_POST['userrole'];
                $userstatus = $_POST['userstatus'];
                $biodata = mysqli_real_escape_string($db,$_POST['biodata']);
                $file_name = $_FILES['image']['name'];
                $file_temp_name = $_FILES['image']['tmp_name'];
                
                
                if(!empty($password) && !empty($file_name)){
                    $hasspassword = sha1($password);

                    $extn_array = explode('.',$_FILES['image']['name']);
                    $extn = strtolower(end($extn_array));
                    $extentions = array("png", "jpg", "jpeg");

                    if(in_array($extn,$extentions) === true){
                        $rand = rand();
                        $updatedname = $rand.$file_name;
                        //transfer image to a folder 
                        move_uploaded_file($file_temp_name, 'assets/images/users/'.$updatedname);
                    }else{
                        echo '<span class="alert alert-danger">Please select png, jpg or jpeg image</span>';
                    }

                    $updateQuery = "UPDATE users SET u_name='$username', u_photo='$updatedname', u_email='$useremail', u_pass='$hasspassword',
                     u_phone='$phone', u_address='$address', u_gender='$gender', u_dob='$birthday', u_biodata='$biodata', u_role='$userrole',
                     u_status='$userstatus' WHERE u_id='$edit_id' ";
                     $updateRes = mysqli_query($db, $updateQuery);
                     if($updateRes){
                         header('Location: users.php');
                     }else{
                         die("User Update Error (1)".mysqli_error($db));
                     }
                     
                }else if(empty($password) && !empty($file_name)){
                    $extn_array = explode('.',$_FILES['image']['name']);
                    $extn = strtolower(end($extn_array));
                    $extentions = array("png", "jpg", "jpeg");

                    if(in_array($extn,$extentions) === true){
                        $rand = rand();
                        $updatedname = $rand.$file_name;
                        //transfer image to a folder 
                        move_uploaded_file($file_temp_name, 'assets/images/users/'.$updatedname);
                    }else{
                        echo '<span class="alert alert-danger">Please select png, jpg or jpeg image</span>';
                    }

                    $updateQuery = "UPDATE users SET u_name='$username', u_photo='$updatedname', u_email='$useremail',
                     u_phone='$phone', u_address='$address', u_gender='$gender', u_dob='$birthday', u_biodata='$biodata', 
                     u_role='$userrole', u_status='$userstatus' WHERE u_id='$edit_id' ";
                     $updateRes = mysqli_query($db, $updateQuery);
                     if($updateRes){
                         header('Location: users.php');
                     }else{
                         die("User Update Error (1)".mysqli_error($db));
                     }
                     
                }else if(!empty($password) && empty($file_name)){
                    $hasspassword = sha1($password);

                    $updateQuery = "UPDATE users SET u_name='$username', u_email='$useremail', u_pass='$hasspassword',
                     u_phone='$phone', u_address='$address', u_gender='$gender', u_dob='$birthday', u_biodata='$biodata', u_role='$userrole',
                     u_status='$userstatus' WHERE u_id='$edit_id' ";
                     $updateRes = mysqli_query($db, $updateQuery);
                     if($updateRes){
                         header('Location: users.php');
                     }else{
                         die("User Update Error (1)".mysqli_error($db));
                     }
                     
                }else{
                    $updateQuery = "UPDATE users SET u_name='$username', u_email='$useremail',
                     u_phone='$phone', u_address='$address', u_gender='$gender', u_dob='$birthday', u_biodata='$biodata', u_role='$userrole',
                     u_status='$userstatus' WHERE u_id='$edit_id' ";
                     $updateRes = mysqli_query($db, $updateQuery);
                     if($updateRes){
                         header ('Location: users.php');
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
                delete('users', 'u_id', $delete_id, 'users.php');
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


