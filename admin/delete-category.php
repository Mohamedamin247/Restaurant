<?php 

include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['img_name'])){

    $id = $_GET['id'];
    $img_name = $_GET['img_name'];

    if($img_name != ""){
        $path = "../images/categories/".$img_name;
        $remove = unlink($path);

        if($remove == FALSE){
            $_SESSION['remove'] = "<div class='error'>Failed to remove category Image</div>";
            header('location: '.SITEURL.'admin/manage-category.php');

            die();
        }
    }

    $sql = "DELETE FROM tbl_category WHERE id = $id";
     $res = mysqli_query($conn, $sql);
      if($res == TRUE){
        $_SESSION['delete'] = "<div class='success'>Category deleted Successfully</div>";
        header('location: '.SITEURL.'admin/manage-category.php');
      }else{
        $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
        header('location: '.SITEURL.'admin/manage-category.php');
      }
}else{

    header('location: '.SITEURL.'admin/manage-category.php');
}



?>