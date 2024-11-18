<?php 

include('../Config/constant.php');

//1.get id of staff to be deleted
echo $staff_ID= $_GET['staff_ID'];

//2.create sql query to delete staff
$sql= "DELETE FROM staff WHERE staff_ID=$staff_ID";

//execute the query
$res= mysqli_query($conn,$sql);
//check whether the query executed successfully or not
if($res==TRUE){

    $_SESSION['delete']= "<div class='success'>staff deleted successfully</div>";
    header("Location: staff.php");
    exit();
    
}
else{
    $_SESSION['delete']="<div class='error'>Deletion failed. Try again</div>";
    header("Location: staff.php");
    exit();
}

//3. Redirect to staff page

?>