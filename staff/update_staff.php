<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update staff</h1>
        <br>
        <br>

        <?php 
        //get the Id of the selected staff
        $staff_ID= $_GET['staff_ID'];
        
        //sql query
        $sql="SELECT * FROM staff WHERE staff_ID = $staff_ID";

        $res=mysqli_query($conn, $sql);
        if($res==true){
            $count = mysqli_num_rows($res);

            if($count==1){

                $row= mysqli_fetch_assoc($res);
                $staff_ID = $row['staff_ID'];
                $staff_fname = $row['staff_fname'];
                $staff_lname = $row['staff_lname'];
                $contactNumber = $row['contactNumber'];
                $staff_email = $row['staff_email'];
                $staff_position = $row['staff_position'];

            }
            // else{
            //     header('location:staff.php');
            // }

        }
        

        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="staff_fname" value="<?php echo $staff_fname; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="staff_lname" value="<?php echo $staff_lname; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="tel" name="contactNumber" value="<?php echo $contactNumber; ?>"</td>
                    
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="staff_email" value="<?php echo $staff_email; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><input type="text" name="staff_position" value="<?php echo $staff_position; ?>"></td>
                    
                </tr>
                
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="staff_ID" value="<?php echo $staff_ID; ?>">
                        <input type="submit" name="submit" value="Update staff" class="btn-primary">

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
    $staff_ID = $_POST['staff_ID'];
    $staff_fname = $_POST['staff_fname'];
    $staff_lname = $_POST['staff_lname'];
    $contactNumber = $_POST['contactNumber'];
    $staff_email = $_POST['staff_email'];
    $staff_position= $_POST['staff_position'];

    //sql query
    $sql = "UPDATE staff SET
    staff_fname = '$staff_fname',
    staff_lname = '$staff_lname',
    contactNumber = '$contactNumber',
    staff_email = '$staff_email',
    staff_position = '$staff_position'
     WHERE staff_ID= '$staff_ID'
     ";

     //execute the query
     $res= mysqli_query($conn, $sql);

     //check if query is successfull
     if($res==TRUE){

        $_SESSION['update']= "<div class='success'>staff updated successfully</div>";
        header("Location: staff.php");
        exit();
        
    }
    else{
        $_SESSION['update']="<div class='error'>Update failed. Try again</div>";
        header("Location: staff.php");
        exit();
    }
}

?>

<?php include('partials/footer.php'); ?>