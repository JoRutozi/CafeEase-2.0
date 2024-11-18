<?php 

include('../Config/constant.php');

//1.get id of admin to be deleted
echo $admin_ID= $_GET['admin_ID'];

//2.create sql query to delete admin
$sql= "DELETE FROM admin WHERE admin_ID=$admin_ID";

//execute the query
$res= mysqli_query($conn,$sql);
//check whether the query executed successfully or not
if($res==TRUE){

    $_SESSION['delete']= "<div class='success'>Admin deleted successfully</div>";
    header("Location: admin.php");
    exit();
    
}
else{
    $_SESSION['delete']="<div class='error'>Deletion failed. Try again</div>";
    header("Location: admin.php");
    exit();
}

//3. Redirect to admin page

?>