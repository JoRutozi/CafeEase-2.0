<?php include('partials/menu.php'); ?>
<?php include('../config/constant.php'); ?>

<?php

// Initialize balances
$ewallet_balance = 0;
$total_amount = 0;
$Total_total_balance = 0;

// Check if a customer ID is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];

    // Prepare and execute SQL statement for ewallet_balance
    $stmt = $conn->prepare("SELECT ewallet_balance FROM customer WHERE customer_id = ?");
    $stmt->bind_param("s", $customer_id);
    $stmt->execute();
    $stmt->bind_result($ewallet_balance);
    $stmt->fetch();
    $stmt->close();

    // Prepare and execute SQL statement for total_amount
    $stmt = $conn->prepare("SELECT total_amount FROM `order` WHERE customer_id = ?");
    $stmt->bind_param("s", $customer_id);
    $stmt->execute();
    $stmt->bind_result($total_amount);
    $stmt->fetch();
    $stmt->close();

    // Prepare and execute SQL statement for Total_total_balance
    $stmt = $conn->prepare("SELECT balance FROM `order` WHERE customer_id = ?");
    $stmt->bind_param("s", $customer_id);
    $stmt->execute();
    $stmt->bind_result($Total_total_balance);
    $stmt->fetch();
    $stmt->close();

    // Handle invalid customer ID
    // if ($ewallet_balance === null || $total_amount === null || $Total_total_balance === null) {
    //     $ewallet_balance = 0;
    //     $total_amount = 0;
    //     $Total_total_balance = 0;
    //     echo "<script>alert('Invalid Customer ID');</script>";
    // }

    $_SESSION['id'] = $customer_id;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .header{
            background-color: blue;
            color: whitesmoke;
            text-align: left;
            padding: 20px;
            font-size: 24px;
        }
        .dashboard {
            display: flex;
            justify-content: space-around;
            background-image:url("back.png");
            padding: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            width: 30%;
        }
        .card h2 {
            margin: 0;
        }
        .button-container {
            display: flex;
            margin: 20px 0;
            justify-content: flex-end;
            margin-left: auto;
        }
        .button-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .make-payment {
            background-color: darkcyan;
            color: white;
            margin-left: 20px;
        }
        .payment-history {
            display: flex;
            justify-content: center;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: bottom 20px;
        }
        .history-btn{
            background-color: darkcyan;
            color: white;
            margin-left: 20px;
            padding: 15px 30px;
            font-size: 18px;
        }

        #ewallet-balance {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        #total-balance {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        #total-total-balance {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .customer-id-container{
            display: flex;
            justify-content: center;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: bottom 20px;
        }
        .submit{
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <script>
        document.getElementById('reset-button').addEventListener('click', function() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "reset_payment.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('total-balance').innerText = '0';
                    alert('Total payment balance has been reset.');
                }
            };
            xhr.send("customer_id=<?php echo $customer_id; ?>");
        });
    </script>
</head>
<body>
    <header class="header">E-Wallet Management</header>
    <div class="dashboard">
        <div class="card">
            <h2>E-WALLET BALANCE</h2>
            <p id="ewallet-balance"><?php echo $ewallet_balance; ?></p>
            <p>Current E-Wallet Balance</p>
        </div>
        <div class="card">
            <h2>PAYMENT BALANCE</h2>
            <p id="total-balance"><?php echo $total_amount; ?></p>
            <p>payment balance</p>
        </div>
        <div class="card">
            <h2> BALANCE</h2>
            <p id="total-total-balance"><?php echo $Total_total_balance; ?></p>
            <p>Your Payment Balance</p>
        </div>
    </div>
    <div class="button-container">
    <a href="<?php echo SITEURL ?>admin/reset_payment.php?customer_id= <?php echo $customer_id; ?>" class="btn-danger">Reset Payment</a>
    </div>
    <div class="payment-history">
        <button onclick="window.location.href='payment_history_admin.php'" class='history-btn'>Payment History</button>
    </div>
    <div class="customer-id-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="customer_id">Enter Customer ID:</label>
            <input type="text" id="customer_id" name="customer_id" required>
            <input type="submit" class="submit" value="Submit">
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    if (!isset($_SESSION['user'])) {
        header('Location: login.php'); // Redirect to login page if user is not logged in
        exit;
    }
    
    $customer_id = $_SESSION['user'];
    $balance =0;


// Prepare and execute SQL statement to insert data into patient_table
$sql = "UPDATE order SET balance = '$balance' WHERE customer_ID = '$customer_id'";

if ($conn->query($sql) === TRUE) {
   
    header("Location: eWallet.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Close the database connection
$conn->close();


?>