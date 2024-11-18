<?php include('partials/menu.php'); ?>
    <!-- Main content section starts -->
    <section class="food-search text-center">
        <div class="container">
            
        <form action="order-search.php" method="POST">
            <input type="search" name="search" placeholder="Enter keywords..." required>
            <button type="submit" name="submit" class="btn btn-primary">Search</button>
        </form>

        </div>
    </section>
    <div class="main-content">
        <div class="wrapper">
           <h1>Manage order</h1>
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
           
           <table class="tbl-full">
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Phone Number</th>
                <th>Order Date</th>
                <th>Total amount</th>
                <th>balance</th>
                <th>Action</th>
            </tr>
            <?php 
            // SQL query modified to order by order_date DESC
            $sql= "SELECT * FROM `order` ORDER BY order_date DESC";

            $res = mysqli_query($conn, $sql);
            if($res==TRUE){
                $rows = mysqli_num_rows($res);
                if($rows>0){
                    while($rows=mysqli_fetch_assoc($res)){
                        $order_id= $rows['order_id'];
                        $product_name = $rows['product_name'];
                        $price = $rows['price'];
                        $quantity = $rows['quantity'];
                        $customer_ID = $rows['customer_ID'];
                        $customer_name = $rows['customer_name'];                        
                        $customer_phone_number = $rows['customer_phone_number'];
                        $order_date = $rows['order_date'];
                        $total_amount = $rows['total_amount'];
                        $balance = $rows['balance'];
                        
                        ?>

                        <tr>
                          <td><?php echo $order_id; ?></td>
                          <td><?php echo $product_name; ?></td>
                          <td><?php echo $price; ?></td>
                          <td><?php echo $quantity; ?></td>
                          <td><?php echo $customer_ID; ?></td>
                          <td><?php echo $customer_name; ?></td>
                          <td><?php echo $customer_phone_number; ?></td>
                          <td><?php echo $order_date; ?></td>
                          <td><?php echo $total_amount; ?></td>
                          <td><?php echo $balance; ?></td>
                          <td>
                            <a href="<?php echo SITEURL ?>admin/delete_order.php?order_id=<?php echo $order_id; ?>" class="btn-danger">Delete</a>
                          </td>
                        </tr>

                        <?php
                    }

                }
                else{
                    // Handle case where no orders are found
                    echo "<tr><td colspan='10'>No orders found</td></tr>";
                }
            }
            else {
                // Handle case where query execution fails
                echo "Failed to fetch orders. Please try again later.";
            }
            ?>
            
           </table>
        </div>
    </div>
    <!-- main content end -->
    <?php include('partials/footer.php'); ?>
