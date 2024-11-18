<?php include('partials/menu.php'); ?>
    <!-- Main content section starts -->
    <div class="main-content">
        <div class="wrapper">
           <h1>Manage customer</h1>
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

           <!-- Button to add customer -->
            <a href="add_customer.php" class="btn-primary">Add customer</a>
           <br>
           <br>
           <br>

           <table class="tbl-full">
            <tr>
                <th>customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php 
            $sql= "SELECT * FROM customer";

            $res = mysqli_query($conn, $sql);
            if($res==TRUE){
                $rows = mysqli_num_rows($res);
                if($rows>0){
                    while($rows=mysqli_fetch_assoc($res)){
                        $customer_ID = $rows['customer_ID'];
                        $customer_fname = $rows['customer_fname'];
                        $customer_lname = $rows['customer_lname'];
                        $contactNumber = $rows['contactNumber'];
                        $EmailAddress = $rows['EmailAddress'];
                        $status = $rows['status'];
                        

                        ?>

                        <tr>
                          <td><?php echo $customer_ID; ?></td>
                          <td><?php echo $customer_fname; ?></td>
                          <td><?php echo $customer_lname; ?></td>
                          <td><?php echo $contactNumber; ?></td>
                          <td><?php echo $EmailAddress; ?></td>
                          <td><?php echo $status; ?></td>
                          <td>
                            <a href="<?php echo SITEURL ?>admin/update_password_customer.php?customer_ID= <?php echo $customer_ID; ?>" class="btn-primary">Change password</a>
                            <a href="<?php echo SITEURL ?>admin/update_customer.php?customer_ID= <?php echo $customer_ID; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL ?>admin/delete_customer.php?customer_ID= <?php echo $customer_ID; ?>" class="btn-danger">Delete</a>
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