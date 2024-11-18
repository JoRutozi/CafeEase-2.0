<?php 

include('../Config/constant.php');

//1.get id of category to be deleted
echo $category_ID= $_GET['category_ID'];

//2.create sql query to delete category
$sql= "DELETE FROM category WHERE category_ID='$category_ID'";

//execute the query
$res= mysqli_query($conn,$sql);
//check whether the query executed successfully or not
if($res==TRUE){

    $_SESSION['delete']= "<div class='success'>category deleted successfully</div>";
    header("Location: category.php");
    exit();
    
}
else{
    $_SESSION['delete']="<div class='error'>Deletion failed. Try again</div>";
    header("Location: category.php");
    exit();
}

//3. Redirect to category page

?>