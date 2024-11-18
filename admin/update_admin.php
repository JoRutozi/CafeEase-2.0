<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>

        <?php 
        //get the Id of the selected admin
        $admin_ID= $_GET['admin_ID'];
        
        //sql query
        $sql="SELECT * FROM admin WHERE admin_ID = $admin_ID";

        $res=mysqli_query($conn, $sql);
        if($res==true){
            $count = mysqli_num_rows($res);

            if($count==1){

                $row= mysqli_fetch_assoc($res);
                $admin_ID = $row['admin_ID'];
                $admin_fname = $row['admin_fname'];
                $admin_lname = $row['admin_lname'];
                $contactNumber = $row['contactNumber'];
                $admin_email = $row['admin_email'];

            }
            // else{
            //     header('location:admin.php');
            // }

        }
        

        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="admin_fname" value="<?php echo $admin_fname; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="admin_lname" value="<?php echo $admin_lname; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="tel" name="contactNumber" value="<?php echo $contactNumber; ?>"</td>
                    
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="admin_email" value="<?php echo $admin_email; ?>"></td>
                    
                </tr>
                
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="admin_ID" value="<?php echo $admin_ID; ?>">
                        <input type="submit" name="submit" value="Update admin" class="btn-primary">

                    </td>
                    
                </tr>
            </table>
        </form>

    </div>
</div>

<?php 
//check submit button if clicked or not
if(isset($_POST['submit'])){
    //get values from form
    $admin_ID = $_POST['admin_ID'];
    $admin_fname = $_POST['admin_fname'];
    $admin_lname = $_POST['admin_lname'];
    $contactNumber = $_POST['contactNumber'];
    $admin_email = $_POST['admin_email'];

    //sql query
    $sql = "UPDATE admin SET
    admin_fname = '$admin_fname',
    admin_lname = '$admin_lname',
    contactNumber = '$contactNumber',
    admin_email = '$admin_email'
     WHERE admin_ID= '$admin_ID'
     ";

     //execute the query
     $res= mysqli_query($conn, $sql);

     //check if query is successfull
     if($res==TRUE){

        $_SESSION['update']= "<div class='success'>Admin updated successfully</div>";
        header("Location: admin.php");
        exit();
        
    }
    else{
        $_SESSION['update']="<div class='error'>Update failed. Try again</div>";
        header("Location: admin.php");
        exit();
    }
}

?>

<?php include('partials/footer.php'); ?>