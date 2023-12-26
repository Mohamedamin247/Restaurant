<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /> <br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];       // Displaying the Session
            unset($_SESSION['add']);     // Removing the Session
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];       // Displaying the Session
            unset($_SESSION['remove']);     // Removing the Session
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];       // Displaying the Session
            unset($_SESSION['delete']);     // Removing the Session
        }

        if (isset($_SESSION['noCategory'])) {
            echo $_SESSION['noCategory'];       // Displaying the Session
            unset($_SESSION['noCategory']);     // Removing the Session
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];       // Displaying the Session
            unset($_SESSION['update']);     // Removing the Session
        }

        if (isset($_SESSION['add_img'])) {
            echo $_SESSION['add_img'];       // Displaying the Session
            unset($_SESSION['add_img']);     // Removing the Session
        }

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];       // Displaying the Session
            unset($_SESSION['failed-remove']);     // Removing the Session
        }

        
        ?>

        <br><br>

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br /> <br /> <br />

        <table class="tbl-full">
            <tr>
                <th>Serial Number</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Action</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM tbl_category";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $id       = $row['id'];
                    $title    = $row['title'];
                    $img_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active   = $row['active'];

            ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title ?></td>
                        <td>
                            <?php 

                              if($img_name != ""){
                                  ?>
                                     <img src="<?php echo SITEURL; ?>images/categories/<?php echo $img_name?>" width="100px">
                                  <?php
                              }else{
                                echo "<div class='error'>There is No Image</div>";
                              }
                            ?>
                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id ?>&img_name=<?php echo $img_name ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>

                <?php
                }
            } else {

                ?>

                <tr>
                    <td colspan="6">
                        <div class="error">No Category Added</div>
                    </td>
                </tr>
            <?php
            }


            ?>
        </table>
    </div>
</div>


<?php include('partials/footer.php') ?>