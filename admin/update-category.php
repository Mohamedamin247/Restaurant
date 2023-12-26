<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_category WHERE id = $id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            if ($count == 1) {

                $row = mysqli_fetch_assoc($res);
                $title    = $row['title'];
                $curr_img = $row['image_name'];
                $featured = $row['featured'];
                $active   = $row['active'];
            } else {
                $_SESSION['noCategory'] = "<div class='error'>Category Not found</div>";
                header('location: ' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            header('location: ' . SITEURL . 'admin/manage-category.php');
        }


        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php

                        if ($curr_img != "") {

                        ?>
                            <img src="<?php echo SITEURL ?>images/categories/<?php echo $curr_img ?>" width="150px">
                        <?php
                        } else {
                            echo "<div class='error'>Image Not Added</div>";
                        }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="NO"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes

                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="curr_img" value="<?php echo $curr_img ?>">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $curr_img = $_POST['curr_img'];
            $featured = $_POST['featured'];
            $active   = $_POST['active'];


            if (isset($_FILES['image']['name'])) {

                $img_name = $_FILES['image']['name'];

                if ($img_name != "") {

                    // Get Extentions of the image || Auto Rename our images

                    $ext = end(explode('.', $img_name));

                    $img_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                    $source      = $_FILES['image']['tmp_name'];
                    $destination = "../images/categories/" . $img_name;

                    $upload = move_uploaded_file($source, $destination);
                    if ($upload == FALSE) {
                        $_SESSION['add_img'] = "<div class='error'>Failed To Upload Image</div>";
                        header('location: ' . SITEURL . 'admin/manage-category.php');

                        die();
                    }

                    // Remove Current Image
                    if ($curr_img != "") {
                        $remove_path = "../images/categories/" . $curr_img;
                        $remove = unlink($remove_path);

                        if ($remove == False) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image</div>";
                            header('location: ' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $img_name = $curr_img;
                }
            } else {
                $img_name = $curr_img;
            }

            $sql2 = "UPDATE tbl_category
                           SET title = '$title',
                               image_name = '$img_name',
                               featured = '$featured',
                               active = '$active'
                            WHERE id = $id   
                            ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {

                $_SESSION['update'] = "<div class=success>Category updated successfully</div>";
                header('location: ' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "<div class=error>Failed to Update Category</div>";
                header('location: ' . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>
    </div>
</div>







<?php include('partials/footer.php') ?>