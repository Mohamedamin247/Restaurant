<?php 

include('../config/constants.php');

// Get the id of admin to be deleted
 
 $id = $_GET['id'];

// Create sql query to delete admin
 
 $sql = "DELETE FROM tbl_admin WHERE id = $id";

// Execute the query

 $res = mysqli_query($conn, $sql);

 if($res==TRUE){

    $_SESSION['delete'] = "<div class='success'>Admin Deleted successfully</div>";
    header('location: ' .SITEURL.'admin/manage-admin.php');
}else{

    $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again later.</div>";
    header('location: ' .SITEURL.'admin/manage-admin.php');

}
// redirect to manage admin page with message (success/error)



?>