<?php include('partials/menu.php'); ?>
    <!-- Main content section starts -->
    <div class="main-content">
        <div class="wrapper">
           <h1>Dashboard</h1><br><br>
           <?php
           if(isset($_SESSION['login'])){
            echo $_SESSION['login'];//display session message
            unset($_SESSION['login']);//remove session message
           }
           ?>
           <br><br>

           <div class="col-4 text-center">
           <?php 
            $sql = "SELECT * FROM product";
            $res= mysqli_query($conn, $sql);
            $count= mysqli_num_rows($res)
            ?>
            <h1><?php echo $count; ?></h1></br>
            Foods

           </div>
           <div class="col-4 text-center">
            <?php 
            $sql1 = "SELECT * FROM category";
            $res1= mysqli_query($conn, $sql1);
            $count1= mysqli_num_rows($res1)
            ?>

            <h1><?php echo $count1; ?></h1></br>
            Categories

           </div>
           <div class="col-4 text-center">
            <?php
           $sql2 = "SELECT * FROM `order`";
            $res2= mysqli_query($conn, $sql2);
            $count2= mysqli_num_rows($res2)
            ?>

            <h1><?php echo $count2; ?></h1></br>
            Total Orders

           </div>
           <div class="col-4 text-center">
           <?php
           $sql3 = "SELECT SUM(Amount) AS Amount FROM payments";
            $res3= mysqli_query($conn, $sql3);
            $count3= mysqli_fetch_assoc($res3);
            $total_revenue = $count3['Amount']
            ?>

            <h1><?php echo $total_revenue; ?></h1></br>
            Revenue Generated

           </div>
           
           <div class="clearfix"></div>
        </div>
        

    </div>
    <!-- main content end -->
    <?php include('partials/footer.php'); ?>