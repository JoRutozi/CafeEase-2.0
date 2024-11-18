<?php
if(!isset($_SESSION['user'])){
    $_SESSION['no-login'] = "<div class='error'>Please Login to access the website</div>";
    header('location:customer/login_customer.php');
} 
?>
