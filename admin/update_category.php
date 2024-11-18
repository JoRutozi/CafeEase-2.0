<?php include('partials/menu.php'); ?>
<!--Main content section starts -->
<div class="main-content">
        <div class="wrapper">
           <h1>Update Category</h1>

           <br><br>

           <?php 

           if(isset($_GET['category_ID'])){
            $category_ID= $_GET['category_ID'];
            $sql= "SELECT * FROM category WHERE category_ID='$category_ID'";

            $res = mysqli_query($conn, $sql);
            if($res==TRUE){
                $rows = mysqli_num_rows($res);
                if($rows==1){
                    $rows=mysqli_fetch_assoc($res);
                        $category_name = $rows['category_name'];
                        $current_image = $rows['image'];
                        $description = $rows['description'];
                        $active = $rows['active'];
                    
                }
            }


           }
           else{
            header('location:category.php');
           }
           ?>

        <form action="" method="POST" enctype="multipart/form-data">

           <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="category_name" value="<?php echo $category_name; ?>"> 

                </td>
            </tr>
            <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                    if($current_image!=""){
                   
                   ?>
                   <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
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
                    <input <?php if($description=="Yes"){echo "checked";} ?> type="radio" name="description" value="Yes">Yes

                    <input <?php if($description=="No"){echo "checked";} ?> type="radio" name="description" value="No">No

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
                    <input type="hidden" name="category_ID" value="<?php echo $category_ID; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-primary">

                </td>
            </tr>

           </table>



        </form>

        <?php
        if(isset($_POST['submit'])){

            $category_ID=$_POST['category_ID'];
            $category_name=$_POST['category_name'];
            $current_image=$_POST['current_image'];
            $image_name= $_POST['image'];
            $description=$_POST['description'];
            $active=$_POST['active'];

            if(isset($_FILES['image']['name'])){
                //upload new image
                $image_name=$_FILES['image']['name'];

                if($image_name!=""){

                    $image_name= $_FILES['image']['name'];
                   //auto rename image
                   //1. get the extension
                   $ext= end(explode('.', $image_name));
                   $image_name= "Food_category_".rand(000, 999).".".$ext;

                   $source_path = $_FILES['image']['tmp_name'];

                   $destination_path = "../images/category/".$image_name;
                
                   $upload = move_uploaded_file($source_path, $destination_path);
                   //check whether the image is uploaded or not
                   if($upload==false){

                      $_SESSION['upload'] ="<div class='error'>Failed to upload</div>";
                      header('location:category.php');
                      die();

                    }
                    if($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        if(file_exists($remove_path)) {
                            unlink($remove_path);
                        }
                       else{
                       $_SESSION['failed to remove']="<div class='error'>Failed to remove image</div>";
                       header('location:category.php');
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
            $sql2="UPDATE category SET
            category_name='$category_name',
            image='$image_name',
            description= '$description',
            active= '$active'
            WHERE category_ID='$category_ID'
            ";
            $res2= mysqli_query($conn, $sql2);

            if($res2==TRUE){

                $_SESSION['update']= "<div class='success'>update successfull</div>";
                header("Location: category.php");
                exit();
                
            }
            else{
                $_SESSION['update']="<div class='error'>Update failed. Try again</div>";
                header("Location: category.php");
                exit();
            }
        }

        ?>

        <?php include('partials/footer.php'); ?>