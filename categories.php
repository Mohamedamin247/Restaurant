<?php include('partials-frontEnd/menu.php') ?>


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php

        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {

            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $img_name = $row['image_name'];

        ?>

                <a href="<?php echo SITEURL ?>category-foods.php?category_id=<?php echo $id ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($img_name == "") {

                            echo "<div class='error'>Image Not Found</div>";
                        } else {

                        ?>
                            <img src="<?php echo SITEURL ?>/images/categories/<?php echo $img_name ?>" 
                                 alt="Pizza" 
                                 class="img-responsive img-curve">
                        <?php

                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title ?></h3>
                    </div>
                </a>

        <?php
            }
        } else {
            echo "<div class='error'>Category Not Added</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-frontEnd/footer.php') ?>