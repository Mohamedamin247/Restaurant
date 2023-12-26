<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /> <br />

        <!-- Button to Add Admin -->
        <a href="add-food.php" class="btn-primary">Add Food</a>

        <br /> <br /> <br />

        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];       // Displaying the Session
            unset($_SESSION['add']);     // Removing the Session
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];       // Displaying the Session
            unset($_SESSION['delete']);     // Removing the Session
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];       // Displaying the Session
            unset($_SESSION['upload']);     // Removing the Session
        }

        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];       // Displaying the Session
            unset($_SESSION['unauthorize']);     // Removing the Session
        }

        if (isset($_SESSION['remove-failed'])) {
            echo $_SESSION['remove-failed'];       // Displaying the Session
            unset($_SESSION['remove-failed']);     // Removing the Session
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];       // Displaying the Session
            unset($_SESSION['update']);     // Removing the Session
        }




        ?>

        <table class="tbl-full">
            <tr>
                <th>Serial Number</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM tbl_food";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $id       = $row['id'];
                    $title    = $row['title'];
                    $price    = $row['price'];
                    $img      = $row['img_name'];
                    $featured = $row['featured'];
                    $active   = $row['active'];

            ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title ?></td>
                        <td><?php echo $price ?></td>
                        <td>
                            <?php 
                              
                              if($img == ""){
                                echo "<div class='error'>There is No Image</div>";
                              }else{
                                ?>

                                <img src="<?php echo SITEURL ?>images/foods/<?php echo $img ?>" width="100px">

                                <?php
                              }
                            
                            ?>
                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="update-food.php?id=<?php echo $id ?>" class="btn-secondary">Update Food</a>
                            <a href="delete-food.php?id=<?php echo $id ?>&img=<?php echo $img ?>" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>

            <?php
                }
            } else {

                echo "<tr><td colspan='7' class='error'>Food Not Added Yet</td></tr>";
            }

            ?>
        </table>
    </div>
</div>


<?php include('partials/footer.php') ?>