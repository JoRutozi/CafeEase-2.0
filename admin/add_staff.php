<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add staff</h1>
        <br>
        <br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>staff Id:</td>
                    <td><input type="text" name="staff_ID" placeholder="Enters your ID"></td>
                    
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="staff_fname" placeholder="Enters your First Name"></td>
                    
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="staff_lname" placeholder="Enters your Last Name"></td>
                    
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="tel" name="contactNumber" placeholder="Enters your Phone Number"></td>
                    
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="staff_email"></td>
                    
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><input type="text" name="staff_position" placeholder="Enters your status"></td>
                    
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="staff_password"></td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add staff" class="btn-primary">

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
$staff_ID =$_POST['staff_ID'];
    $staff_fname =$_POST['staff_fname'];
    $staff_lname =$_POST['staff_lname'];
    $contactNumber =$_POST['contactNumber'];
    $staff_email =$_POST['staff_email'];
    $staff_position = $_POST['staff_position'];
    $staff_password =md5($_POST['staff_password']);//password encryption with md5

// Prepare and execute SQL statement to insert data into patient_table
$sql = "INSERT INTO staff (staff_ID, staff_fname, staff_lname,  ".
"contactNumber, staff_email, staff_position, staff_password) VALUES ('$staff_ID', '$staff_fname', '$staff_lname',".
" '$contactNumber', '$staff_email', '$staff_position', '$staff_password')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['add'] = "staff added successfully";
    header("Location: staff.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Close the database connection
$conn->close();


?>