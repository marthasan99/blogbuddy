<?php
    include "inc/header.php";
?>
            
<div class="page-heading">
    <h3>Profile Statistics</h3>
</div>
<div class="page-content">

    <!-- Structure -->
    <?php 
        if(isset($_GET['do'])){
            $do = $_GET['do'];
        }else{
            $do == 'manage';
        }

        if($do == 'manage'){
            //manage
        }
        if($do == 'add'){
            //add
        }
        if($do == 'edit'){
            //edit
        }
        if($do == 'update'){
            //update
        }
        if($do == 'delete'){
            //delete
        }

        $do = 'manage'; //manage user
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


