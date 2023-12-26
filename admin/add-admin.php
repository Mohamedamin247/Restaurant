<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br /> <br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];       // Displaying the Session
            unset($_SESSION['add']);     // Removing the Session
        }
        ?>
        
        <br />

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="fullname" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>User Name: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your UserName">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="pass" placeholder="Enter Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php') ?>

<?php

// Process the value from the form and save it in the Database
// Check whether the submit button is clicked or not 

if (isset($_POST['submit'])) {
    // Button Clicked

    // Get the data from the form
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $pass     = sha1($_POST['pass']);      // Password Encryption With SHA1

    // SQL Query to save the data into database
    $sql = "INSERT INTO tbl_admin 
                  SET full_name = '$fullname',
                      username  = '$username',
                      password  = '$pass'
                ";

    // Execute Query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Check whether the (Query is executed) data inserted or not and display appropriate message
    if ($res == TRUE) {

        // Data Inserted 

        // Create a session variable to display message 

        $_SESSION['add'] = "Admin Added Successfully";

        // redirect Page to Manage Admin

        header("location: " . SITEURL . 'admin/manage-admin.php');
    } else {

        // Failed to insert data

        // Create a session variable to display message 

        $_SESSION['add'] = "Failed to add Admin";

        // redirect Page to Add Admin

        header("location: " . SITEURL . 'admin/add-admin.php');
    }
}


?>