<?php 

include('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['img'])){
    $id = $_GET['id'];
    $img = $_GET['img'];

    if($img != ""){
        $path = "../images/foods/".$img;
        $remove = unlink($path);

        if($remove == FALSE){
            $_SESSION['upload'] = "<div class='error'>Failed to remove the image</div>";
            header('location: '.SITEURL.'admin/manage-food.php');
            die();
        }
    }


    $sql = "DELETE FROM tbl_food WHERE id = $id";

    $res = mysqli_query($conn, $sql);
      if($res == TRUE){
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
        header('location: '.SITEURL.'admin/manage-food.php');
      }else{
        $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
        header('location: '.SITEURL.'admin/manage-food.php');
      }

}else{
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
    header('location: '.SITEURL.'admin/manage-food.php');
}







?>