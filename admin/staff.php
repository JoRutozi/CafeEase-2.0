<?php include('partials/menu.php'); ?>
    <!-- Main content section starts -->
    <div class="main-content">
        <div class="wrapper">
           <h1>Manage staff</h1>
           <br>
           <br>
           <?php 
           if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//display session message
            unset($_SESSION['add']);//remove session message
           }
           if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];//display session message
            unset($_SESSION['delete']);//remove session message
           }

           if(isset($_SESSION['update'])){
            echo $_SESSION['update'];//display session message
            unset($_SESSION['update']);//remove session message
           }
           if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];//display session message
            unset($_SESSION['user-not-found']);//remove session message
           }
           if(isset($_SESSION['password-not-match'])){
            echo $_SESSION['password-not-match'];//display session message
            unset($_SESSION['password-not-match']);//remove session message
           }
           if(isset($_SESSION['change-password'])){
            echo $_SESSION['change-password'];//display session message
            unset($_SESSION['change-password']);//remove session message
           }
           if(isset($_SESSION['login'])){
            echo $_SESSION['login'];//display session message
            unset($_SESSION['login']);//remove session message
           }
           ?>
           <br>
           <br><br>

           <!-- Button to add staff -->
            <a href="add_staff.php" class="btn-primary">Add staff</a>
           <br>
           <br>
           <br>

           <table class="tbl-full">
            <tr>
                <th>staff ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php 
            $sql= "SELECT * FROM staff";

            $res = mysqli_query($conn, $sql);
            if($res==TRUE){
                $rows = mysqli_num_rows($res);
                if($rows>0){
                    while($rows=mysqli_fetch_assoc($res)){
                        $staff_ID = $rows['staff_ID'];
                        $staff_fname = $rows['staff_fname'];
                        $staff_lname = $rows['staff_lname'];
                        $contactNumber = $rows['contactNumber'];
                        $staff_email = $rows['staff_email'];
                        $staff_position = $rows['staff_position'];
                        

                        ?>

                        <tr>
                          <td><?php echo $staff_ID; ?></td>
                          <td><?php echo $staff_fname; ?></td>
                          <td><?php echo $staff_lname; ?></td>
                          <td><?php echo $contactNumber; ?></td>
                          <td><?php echo $staff_email; ?></td>
                          <td><?php echo $staff_position; ?></td>
                          <td>
                            <a href="<?php echo SITEURL ?>admin/update_password_staff.php?staff_ID= <?php echo $staff_ID; ?>" class="btn-primary">Change password</a>
                            <a href="<?php echo SITEURL ?>admin/update_staff.php?staff_ID= <?php echo $staff_ID; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL ?>admin/delete_staff.php?staff_ID= <?php echo $staff_ID; ?>" class="btn-danger">Delete</a>
                          </td>
                        </tr>


                        <?php
                    }

                }
                else{

                }

            }
            
            ?>

            
           </table>
        </div>
        

    </div>
    <!-- main content end -->
    <?php include('partials/footer.php'); ?>