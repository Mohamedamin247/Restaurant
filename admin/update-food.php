<?php include('partials/menu.php') ?>


<?php

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql2 = "SELECT * FROM tbl_food WHERE id = $id";

    $res2 = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_assoc($res2);

    $title            = $row2['title'];
    $desc             = $row2['description'];
    $price            = $row2['price'];
    $current_img      = $row2['img_name'];
    $current_category = $row2['category_id'];
    $featured         = $row2['featured'];
    $active           = $row2['active'];
} else {
    header('location: ' . SITEURL . 'admin/manage-food.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="desc" cols="30" rows="5"><?php echo $desc ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php

                        if ($current_img != "") {

                        ?>
                            <img src="<?php echo SITEURL ?>images/foods/<?php echo $current_img ?>" width="150px">
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
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php

                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {
                                    $cat_title = $row['title'];
                                    $cat_id    = $row['id'];

                                    // echo "<option value='$cat_id'>$cat_title</option>";
                            ?>
                                    <option <?php if($current_category == $cat_id){
                                        echo "selected";
                                    } ?> value="<?php echo $cat_id ?>"><?php echo $cat_title ?></option>
                            <?php

                                }
                            } else {
                                echo "<option value='0'>Category Not Available</option>";
                            }

                            ?>
                            <option value=""></option>
                        </select>
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
                        <input type="hidden" name="curr_img" value="<?php echo $current_img ?>">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        
         if(isset($_POST['submit'])){
            
            $id       = $_POST['id'];
            $title    = $_POST['title'];
            $desc     = $_POST['desc'];
            $price    = $_POST['price'];
            $current_img = $_POST['curr_img'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active   = $_POST['active'];

            if(isset($_FILES['image']['name'])){
                $img_name = $_FILES['image']['name'];    // New Image 
                 
                if($img_name != ""){
                    $ext = end(explode('.', $img_name));
                    $img_name = "Food-Name-".rand(0000,9999).'.'.$ext;
                    
                    $src_path = $_FILES['image']['tmp_name'];
                    $destination = "../images/foods/".$img_name;

                    $upload = move_uploaded_file($src_path, $destination);

                    if($upload == FALSE){
                        $_SESSION['upload'] = "<div class='error'>Failed to upload new Image</div>";
                        header('location: '.SITEURL.'admin/manage-food.php');
                        die();
                    }

                    // Remove current Image

                     if($current_img != ""){
                        $remove_path = "../images/foods/".$current_img;
                        $remove = unlink($remove_path);
                         
                         if($remove == FALSE){
                            $_SESSION['remove-failed'] = "<div class='error'>Failed to remove Current Image</div>";
                            header('location: '.SITEURL.'admin/manage-food.php');
                            die();
                         }
                     }
                }else{
                    
                    $img_name = $current_img;
                }
            }else{
                $img_name = $current_img;
            }


            $sql3 = "UPDATE tbl_food
                     SET title = '$title',
                         description = '$desc',
                         price = $price,
                         img_name = '$img_name',
                         category_id = '$category',
                         featured = '$featured',
                         active = '$active'
                         WHERE id = $id";

            $res3 = mysqli_query($conn, $sql3);
              if($res3 == TRUE){

                $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
                header('location: '.SITEURL.'admin/manage-food.php');

              }else{

                $_SESSION['update'] = "<div class='error'>Failed to update Food</div>";
                header('location: '.SITEURL.'admin/manage-food.php');
              }             

         }
        
        ?>

    </div>
</div>



<?php include('partials/footer.php') ?>