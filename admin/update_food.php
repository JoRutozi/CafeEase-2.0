<?php include('partials/menu.php'); ?>
<!--Main content section starts -->
<div class="main-content">
        <div class="wrapper">
           <h1>Update Food</h1>

           <br><br>

           <?php 

           if(isset($_GET['product_ID'])){
            $product_ID= $_GET['product_ID'];
            $sql= "SELECT * FROM product WHERE product_ID='$product_ID'";

            $res = mysqli_query($conn, $sql);
            if($res==TRUE){
                $rows = mysqli_num_rows($res);
                if($rows==1){
                    $rows=mysqli_fetch_assoc($res);
                        $product_name = $rows['product_name'];
                        $description = $rows['description'];
                        $price = $rows['price'];
                        $current_image = $rows['image'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
                    
                }
            }


           }
           else{
            header('location:food.php');
           }
           ?>

        <form action="" method="POST" enctype="multipart/form-data">

           <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="product_name" value="<?php echo $product_name; ?>"> 

                </td>
            </tr>
            <tr>    
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" ><?php echo $description; ?></textarea>

                </td>
            </tr>
            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>"> 

                </td>
            </tr>
            <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                    if($current_image!=""){
                   
                   ?>
                   <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                   <?php 
                   }
                   else{
                    echo "<div class='error'>Image not added</div>";
                   }
                   ?>

                </td>
            </tr>
            <tr>
                <td>New Image: </td>
                <td>
                    <input type="file" name="image" > 

                </td>
            </tr>
            <tr>   
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No

                </td>
            </tr>
            <tr>   
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No

                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="product_ID" value="<?php echo $product_ID; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-primary">

                </td>
            </tr>

           </table>



        </form>

        <?php
        if(isset($_POST['submit'])){

            $product_ID=$_POST['product_ID'];
            $product_name= $_POST['product_name'];
            $description= $_POST['description'];
            $price= $_POST['price'];
            $image_name= $_POST['image'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];

            if(isset($_FILES['image']['name'])){
                //upload new image
                $image_name=$_FILES['image']['name'];

                if($image_name!=""){

                    $image_name= $_FILES['image']['name'];
                   //auto rename image
                   //1. get the extension
                   $ext= end(explode('.', $image_name));
                   $image_name= "Food_".rand(000, 999).".".$ext;

                   $source_path = $_FILES['image']['tmp_name'];

                   $destination_path = "../images/food/".$image_name;
                
                   $upload = move_uploaded_file($source_path, $destination_path);
                   //check whether the image is uploaded or not
                   if($upload==false){

                      $_SESSION['upload'] ="<div class='error'>Failed to upload</div>";
                      header('location:food.php');
                      die();

                    }
                    if($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        if(file_exists($remove_path)) {
                            unlink($remove_path);
                        }
                       else{
                       $_SESSION['failed to remove']="<div class='error'>Failed to remove image</div>";
                       header('location:food.php');
                       die();
                      }
                    }


                }
                else{
                    $image_name= $current_image;
                }

            }
            else{
                $image_name= $current_image;

            }
            $sql2="UPDATE product SET
            product_name='$product_name',
            description= '$description',
            price= '$price',
            image='$image_name',
            featured= '$featured',
            active= '$active'
            WHERE product_ID='$product_ID'
            ";
            $res2= mysqli_query($conn, $sql2);

            if($res2==TRUE){

                $_SESSION['update']= "<div class='success'>update successfull</div>";
                header("Location: food.php");
                exit();
                
            }
            else{
                $_SESSION['update']="<div class='error'>Update failed. Try again</div>";
                header("Location: food.php");
                exit();
            }
        }

        ?>

        <?php include('partials/footer.php'); ?>