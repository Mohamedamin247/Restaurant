<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
           
           // Get the id of selected Admin
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_admin WHERE id = $id";

            $res = mysqli_query($conn, $sql);

            if($res == TRUE){
               $count = mysqli_num_rows($res);
                 if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $fullname = $row['full_name'];
                    $username = $row['username'];
                 }else{
                    header('location: '.SITEURL.'admin/manage-admin.php');
                 }
            }else{

            }
          
        ?>
         
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="fullname" value="<?php echo $fullname ?>">
                    </td>
                </tr>

                <tr>
                    <td>User Name: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php  

 // Check whether the submit button is clicked or not 
   
   if(isset($_POST['submit'])){
     $id = $_POST['id'];
     $fullname = $_POST['fullname'];
     $username = $_POST['username'];


     $sql = "UPDATE tbl_admin SET full_name = '$fullname', username = '$username' WHERE id = $id";

     $res = mysqli_query($conn, $sql);
      if($res == TRUE){
        $_SESSION['update'] = "<div class='success'>Updated successfully</div>";
        header('location: '.SITEURL.'admin/manage-admin.php');
      }else{
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
        header('location: '.SITEURL.'admin/manage-admin.php');
      }
   }




?>



<?php include('partials/footer.php') ?>