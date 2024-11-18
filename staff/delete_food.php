<?php 

include('../Config/constant.php');

//1.get id of product to be deleted
echo $product_ID= $_GET['product_ID'];

//2.create sql query to delete product
$sql= "DELETE FROM product WHERE product_ID='$product_ID'";

//execute the query
$res= mysqli_query($conn,$sql);
//check whether the query executed successfully or not
if($res==TRUE){

    $_SESSION['delete']= "<div class='success'>product deleted successfully</div>";
    header("Location: food.php");
    exit();
    
}
else{
    $_SESSION['delete']="<div class='error'>Deletion failed. Try again</div>";
    header("Location: food.php");
    exit();
}

//3. Redirect to product page

?>