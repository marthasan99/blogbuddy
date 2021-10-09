<!-- Side widgets-->
<div class="col-lg-4">
                    <!-- Search widget-->
                    <form action="search.php" method="POST">
                        <div class="card mb-4">
                            <div class="card-header">Search</div>
                            <div class="card-body">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" name="search_text" />
                                    <button class="btn btn-primary" id="button-search" type="submit" name="search">Go!</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Popular Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="list-unstyled mb-0">
                                            <?php
                                                $query3 = "SELECT * FROM category ORDER BY p_count DESC LIMIT 3";
                                                $result = mysqli_query($db,$query3);
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $c_id = $row["c_id"];
                                                    $c_name = $row["c_name"];
                                                    $c_desc = $row["c_desc"];
                                                    $p_count = $row["p_count"];
                                                    ?>
                                                    <li><a href="#!">
                                                    <?php
                                                    echo $c_name;
                                                    ?>
                                                    <span>  (<?php echo $p_count; ?>)</span></a></li>
                                                    <?php
                                                }
                                                

                                            ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Recent Posts</div>
                        <div class="card-body">
                            <?php 
                                $query4 = "SELECT * FROM posts ORDER BY p_id DESC LIMIT 3";
                                $view_result2 = mysqli_query($db, $query4);
                                while($row = mysqli_fetch_assoc($view_result2)){
                                    $p_id          = $row['p_id'];
                                    $p_title       = $row['p_title'];
                                    $p_desc        = $row['p_desc'];
                                    $p_thumbnail   = $row['p_thumbnail'];
                                    $cat_id        = $row['cat_id'];
                                    $user_id       = $row['user_id'];
                                    $p_date        = $row['p_date'];
                                    $p_status      = $row['p_status'];
                                    ?>
                                        <div class="row">
                                            <div class="col-md-4" style="height:100px">
                                                <img class="img-fluid align-middle" href="singlepage.php?post_id=<?php echo $p_id; ?>" src="admin/assets/images/posts/<?php echo $p_thumbnail; ?>">
                                            </div>
                                            <div class="col-md-8" >
                                                <h4>
                                                    <a href="singlepage.php?post_id=<?php echo $p_id; ?>">
                                                        <?php 
                                                            if(strlen($p_title<= 30)){
                                                                echo $p_title;
                                                            }else{
                                                                echo substr($p_title,0,30)."...";
                                                            }
                                                        ?>
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>