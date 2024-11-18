<?php 

include('../Config/constant.php');

//1.get id of customer to be deleted
echo $customer_ID= $_GET['customer_ID'];

//2.create sql query to delete customer
$sql= "DELETE FROM customer WHERE customer_ID=$customer_ID";

//execute the query
$res= mysqli_query($conn,$sql);
//check whether the query executed successfully or not
if($res==TRUE){

    $_SESSION['delete']= "<div class='success'>customer deleted successfully</div>";
    header("Location: customer.php");
    exit();
    
}
else{
    $_SESSION['delete']="<div class='error'>Deletion failed. Try again</div>";
    header("Location: customer.php");
    exit();
}

//3. Redirect to customer page

?>