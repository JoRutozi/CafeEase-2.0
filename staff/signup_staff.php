<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="../css/admin.css">
<style>
  /* styles.css */

/* Apply styles to the entire page */
body {
    background-color: white;
    font-family: Arial, sans-serif;
}

/* Style the form container */
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

/* Style form labels */
label {
    font-weight: bold;
}

/* Style input fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="password"],
input[type="tel"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

/* Style the submit button */
input[type="submit"] {
    background-color: #0074d9;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
}

/* Style the login link */
a {
    color: #0074d9;
    text-decoration: none;
}
  
</style>
</head>
<body>
<form action="" method="post">
    <h1>Registration: </h1><br>
    <div>
        <label for="staff_fname"><b>First name: </b></label>
          <input type="text" id="staff_fname" name="staff_fname" required> 
        
    </div><br>
    <div>
        <label for="staff_lname"><b>Last name: </b></label>
          <input type="text" id="staff_lname" name="staff_lname" required> 
        
    </div><br>
    <div>
        <label for="staff_ID"><b>Id number: </b></label>
          <input type="text" id="staff_ID" name="staff_ID" required> 
        
    </div><br>
    <div>
        <label for="staff_email"><b>Email: </b></label>
          <input type="email" id="staff_email" name="staff_email" required> 
        
    </div><br>
    <div>
        <label for="staff_password"><b>Password: </b></label>
          <input type="password" id="staff_password" name="staff_password" required> 
        
    </div><br>
    <div>
        <label for="contactNumber"><b>Phone Number: </b></label>
          <input type="tel" id="contactNumber" name="contactNumber" required> 
        
    </div><br>
    <div>
        <label for="staff_position"><b>Position: </b></label>
          <input type="text" id="staff_position" name="staff_position" required> 
        
    </div><br>
    
    <input type="submit" name="submit" value="Sign Up" class="btn-primary">
    <a href="login_staff.php" class="btn-primary">login</a>
</form>
    
</body>
</html>

<?php
include('../Config/constant.php');

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
    header("Location: login_staff.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Close the database connection
$conn->close();


?>