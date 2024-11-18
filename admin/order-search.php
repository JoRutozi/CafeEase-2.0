<?php
include('partials/menu.php');
?>
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
                <th>balance</th>F
                <th>Action</th>
            </tr>
            <?php

// Check if form submitted and search term provided
if (isset($_POST['submit']) && isset($_POST['search'])) {
    // Retrieve and sanitize search term
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    // Display the search term
    echo "<section class='food-search text-center'>
              <div class='container'>
                  <h2>Order on Your Search <span class='text-white'>\"$search\"</span></h2>
              </div>
          </section>";

    // Query to search for products
    $sql = "SELECT * FROM `order` WHERE customer_name LIKE '%$search%' ";
    $res = mysqli_query($conn, $sql);

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
        }
            ?>
            
           </table>
        </div>
    </div>
    <!-- main content end -->
    <?php include('partials/footer.php'); ?>