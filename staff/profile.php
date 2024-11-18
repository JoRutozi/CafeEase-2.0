<?php
// Start session (if not already started)


// Include necessary files and configuration
include('partials/menu.php'); // Adjust path as per your file structure
include('../Config/constant.php'); // Adjust path as per your file structure

// Check if user is logged in (check for session variable)
if(!isset($_SESSION['user'])) {
    // Redirect to login page or handle unauthorized access
    header('location: login_staff.php');
    exit;
}

$staff_ID = $_SESSION['user'];

// SQL query to fetch user data
$sql = "SELECT * FROM staff WHERE staff_ID = '$staff_ID'";
$res = mysqli_query($conn, $sql);

if($res) {
    $count = mysqli_num_rows($res);

    if($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $staff_fname = $row['staff_fname'];
        $staff_lname = $row['staff_lname'];
        $contactNumber = $row['contactNumber'];
        $staff_email = $row['staff_email'];
        $staff_position = $row['staff_position'];
    } else {
        echo "<p>User not found.</p>";
    }
} else {
    echo "Query error: " . mysqli_error($conn);
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>My Account</h1>
        <br>
        <br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>First Name:</td>
                    <td><h4><?php echo $staff_fname; ?></h4></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><h4><?php echo $staff_lname; ?></h4></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><h4><?php echo $contactNumber; ?></h4></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><h4><?php echo $staff_email; ?></h4></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><h4><?php echo $staff_position; ?></h4></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="<?php echo SITEURL ?>staff/update_password_staff.php?staff_ID=<?php echo $staff_ID; ?>" class="btn-primary">Change password</a>
                        <a href="<?php echo SITEURL ?>staff/update_staff.php?staff_ID=<?php echo $staff_ID; ?>" class="btn-secondary">Update</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>
