<?php include('partials/menu.php') ?>

<!-- Menu Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <br /> <br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];       // Displaying the Session
            unset($_SESSION['add']);     // Removing the Session
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];       
            unset($_SESSION['delete']);     
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];       
            unset($_SESSION['update']);     
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];       
            unset($_SESSION['user-not-found']);     
        }

        if (isset($_SESSION['Notmatch'])) {
            echo $_SESSION['Notmatch'];       
            unset($_SESSION['Notmatch']);     
        }

        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];       
            unset($_SESSION['change-pwd']);     
        }
        ?>

        <br /> <br /> <br />

        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br /> <br /> <br />

        <table class="tbl-full">
            <tr>
                <th>Serial Number</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            // Query to Get all Admins from the database
            $sql = "SELECT * FROM tbl_admin";

            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // Check Whether the query is executed or not
            if ($res == TRUE) {
                // count Rows 
                $count = mysqli_num_rows($res);   // function to get all the rows in the database 

                $serialNum = 1;
                // Check the num of rows
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id       = $rows['id'];
                        $fullname = $rows['full_name'];
                        $username = $rows['username'];

            ?>
                        <tr>
                            <td><?php echo $serialNum++ ?>.</td>
                            <td><?php echo $fullname ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-pass.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }

            ?>
        </table>
    </div>
</div>
</div>
<!-- Menu Content Section Ends -->

<?php include('partials/footer.php') ?>