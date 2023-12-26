<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category

            <br><br>


            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];       // Displaying the Session
                unset($_SESSION['add']);     // Removing the Session
            }

            if (isset($_SESSION['add_img'])) {
                echo $_SESSION['add_img'];       // Displaying the Session
                unset($_SESSION['add_img']);     // Removing the Session
            }
            ?>

            <br><br>

            <!-- Add Category form Starts -->

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="yes"> Yes
                            <input type="radio" name="featured" value="no"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="yes"> Yes
                            <input type="radio" name="active" value="no"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <!-- Add Category form Ends -->


            <?php

            if (isset($_POST['submit'])) {

                $title = $_POST['title'];

                if (isset($_POST['featured'])) {

                    $featured = $_POST['featured'];
                } else {

                    $featured = "No";
                }

                if (isset($_POST['active'])) {

                    $active = $_POST['active'];
                } else {

                    $active = "No";
                }

                if (isset($_FILES['image']['name'])) {

                    $img_name    = $_FILES['image']['name'];

                    if ($img_name != "") {

                        // Get Extentions of the image || Auto Rename our images

                        $ext = end(explode('.', $img_name));

                        $img_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                        $source      = $_FILES['image']['tmp_name'];
                        $destination = "../images/categories/" . $img_name;

                        $upload = move_uploaded_file($source, $destination);
                        if ($upload == FALSE) {
                            $_SESSION['add_img'] = "<div class='error'>Failed To Upload Image</div>";
                            header('location: ' . SITEURL . 'admin/add-category.php');

                            die();
                        }
                    }
                } else {
                    $img_name = "";
                }

                $sql = "INSERT INTO tbl_category
                    SET title = '$title',
                        image_name = '$img_name',
                        featured = '$featured',
                        active = '$active'
                    ";

                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {

                    $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                    header('location: ' . SITEURL . 'admin/manage-category.php');
                } else {

                    $_SESSION['add'] = "<div class='error'>Failed to add Category</div>";
                    header('location: ' . SITEURL . 'admin/add-category.php');
                }
            }

            ?>

        </h1>
    </div>
</div>



<?php include('partials/footer.php') ?>