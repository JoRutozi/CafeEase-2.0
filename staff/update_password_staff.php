<?php include('partials/menu.php'); ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Change password</h1>
            <br><br>
            <?php

            if(isset($_GET['staff_ID'])){
                $staff_ID= $_GET['staff_ID'];
            }
            ?>


            <form action="" method="POST">
                <table class="tbl-30">
                <tr>
                    <td>Curent Password:</td>
                    <td><input type="password" name="current_password" placeholder="current password"></td>
                    
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="new password"></td>
                    
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="confirm password"></td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="staff_ID" value="<?php echo $staff_ID; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-primary">

                    </td>
                    
                </tr>

                </table>


            </form>

            


        </div>
</div>

<?php
if(isset($_POST['staff_ID'])){
    $staff_ID =$_POST['staff_ID'];
    $current_password =md5($_POST['current_password']);//password encryption with md5
    $new_password =md5($_POST['new_password']);//password encryption with md5
    $confirm_password =md5($_POST['confirm_password']);//password encryption with md5

    $sql = "SELECT * FROM staff WHERE staff_ID= '$staff_ID' AND staff_password= '$current_password' ";
    $res= mysqli_query($conn, $sql);
    if($res==true){
        $count= mysqli_num_rows($res);
        if($count==1){
            
            if($new_password == $confirm_password){

                $sql2 = "UPDATE staff SET
                staff_password= '$new_password'
                WHERE staff_ID= '$staff_ID'";
                $res2= mysqli_query($conn, $sql2);
                if($res2==true){

                    $_SESSION['change-password'] = "Password changed Successfully";
                    header('location:staff.php');

                }else{
                    $_SESSION['change-password'] = "Password not Successfully";
                    header('location:staff.php');

                }

            }
            else{
                $_SESSION['password-not-match'] = "password do not match";
            header('location:staff.php');
            }

         }
         else{
            $_SESSION['user-not-found'] = "User not found";
            header('location:staff.php');
        }
    }
}
?>

<?php include('partials/footer.php'); ?>