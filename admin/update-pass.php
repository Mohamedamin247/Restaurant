<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }


        ?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="oldpass" placeholder="Current Password">
                    </td>
                </tr>


                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="newpass" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirmpass" placeholder="Confirm New Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $oldPass = sha1($_POST['oldpass']);
    $newPass = sha1($_POST['newpass']);
    $confirmPass = sha1($_POST['confirmpass']);


    $sql = "SELECT * FROM tbl_admin 
            WHERE id = $id AND password = '$oldPass'";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            if ($newPass == $confirmPass) {

                $sql2 = "UPDATE tbl_admin 
                         SET password = '$newpass'
                         WHERE id = $id";

                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == TRUE) {

                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully</div>";
                    header('location: ' . SITEURL . 'admin/manage-admin.php');
                } else {

                    $_SESSION['change-pwd'] = "<div class='success'>Failed to Change Password</div>";
                    header('location: ' . SITEURL . 'admin/manage-admin.php');
                }
            } else {

                $_SESSION['Notmatch'] = "<div class='error'>Passwords Not Match</div>";
                header('location: ' . SITEURL . 'admin/manage-admin.php');
            }
        } else {

            $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
            header('location: ' . SITEURL . 'admin/manage-admin.php');
        }
    }
}




?>

<?php include('partials/footer.php') ?>