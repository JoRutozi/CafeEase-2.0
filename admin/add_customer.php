<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add customer</h1>
        <br>
        <br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>customer Id:</td>
                    <td><input type="text" name="customer_ID" placeholder="Enters your ID"></td>
                    
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="customer_fname" placeholder="Enters your First Name"></td>
                    
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="customer_lname" placeholder="Enters your Last Name"></td>
                    
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="tel" name="contactNumber" placeholder="Enters your Phone Number"></td>
                    
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="EmailAddress"></td>
                    
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><input type="text" name="status" placeholder="Enters your status"></td>
                    
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="customer_password"></td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add customer" class="btn-primary">

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
$customer_ID =$_POST['customer_ID'];
    $customer_fname =$_POST['customer_fname'];
    $customer_lname =$_POST['customer_lname'];
    $contactNumber =$_POST['contactNumber'];
    $EmailAddress =$_POST['EmailAddress'];
    $status = $_POST['status'];
    $customer_password =md5($_POST['customer_password']);//password encryption with md5

// Prepare and execute SQL statement to insert data into patient_table
$sql = "INSERT INTO customer (customer_ID, customer_fname, customer_lname,  ".
"contactNumber, EmailAddress, status, customer_password) VALUES ('$customer_ID', '$customer_fname', '$customer_lname',".
" '$contactNumber', '$EmailAddress', '$status', '$customer_password')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['add'] = "customer added successfully";
    header("Location: customer.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Close the database connection
$conn->close();


?>