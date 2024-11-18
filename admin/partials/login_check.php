<?php
if(!isset($_SESSION['user'])){
    $_SESSION['no-login'] = "<div class='error'>Please Login to access Admin panel</div>";
    header('location:login_admin.php');
} 
?>