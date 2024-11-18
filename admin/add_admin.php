<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Admin Id:</td>
                    <td><input type="text" name="admin_ID" placeholder="Enters your ID"></td>
                    
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="admin_fname" placeholder="Enters your First Name"></td>
                    
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="admin_lname" placeholder="Enters your Last Name"></td>
                    
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="tel" name="contactNumber" placeholder="Enters your Phone Number"></td>
                    
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="admin_email"></td>
                    
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="admin_password"></td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add admin" class="btn-primary">

                    </td>
                    
                </tr>
            </table>
        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>



<?php
// include('Config/constant.php');

if(isset($_POST['submit'])){
$admin_ID =$_POST['admin_ID'];
    $admin_fname =$_POST['admin_fname'];
    $admin_lname =$_POST['admin_lname'];
    $contactNumber =$_POST['contactNumber'];
    $admin_email =$_POST['admin_email'];
    $admin_password =md5($_POST['admin_password']);//password encryption with md5

// Prepare and execute SQL statement to insert data into patient_table
$sql = "INSERT INTO admin (admin_ID, admin_fname, admin_lname,  ".
"contactNumber, admin_email, admin_password) VALUES ('$admin_ID', '$admin_fname', '$admin_lname',".
" '$contactNumber', '$admin_email', '$admin_password')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['add'] = "Admin added successfully";
    header("Location: admin.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Close the database connection
$conn->close();


?>