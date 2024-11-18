<?php
include('../config/constant.php');


echo $customer_id= $_GET['customer_id'];
    $balance =0;


// Prepare and execute SQL statement to insert data into patient_table
$sql = "UPDATE `order` SET balance = '$balance' WHERE customer_ID = '$customer_id'";

if ($conn->query($sql) === TRUE) {
   
    header("Location: eWallet_admin.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();


?>
