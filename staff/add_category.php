<?php include('partials/menu.php'); ?>
<!--Main content section starts -->
<div class="main-content">
        <div class="wrapper">
           <h1>Add Category</h1>

           <br><br>
           <?php 
           if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//display session message
            unset($_SESSION['add']);//remove session message
           }
           if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];//display session message
            unset($_SESSION['upload']);//remove session message
           }
           ?>
           <br><br>

           <form action="" method="POST" enctype="multipart/form-data">

           <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="category_name" placeholder="Category name"> 

                </td>
            </tr>
            <tr>
                <td>Image: </td>
                <td>
                    <input type="file" name="image" > 

                </td>
            </tr>
            <tr>   
                <td>Featured: </td>
                <td>
                    <input type="radio" name="description" value="Yes"> Yes
                    <input type="radio" name="description" value="No"> No

                </td>
            </tr>
            <tr>   
                <td>Active: </td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No

                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-primary">

                </td>
            </tr>

           </table>



           </form>

           <?php 
           if(isset($_POST['submit'])){
            //
            //get the value from form
            $category_name= $_POST['category_name'];
            
            //for radio input, check if the button is selected or not
            if(isset($_POST['description'])){

                $description = $_POST['description'];

            }
            else{

                $description = "No";

            }
            if(isset($_POST['active'])){

                $active = $_POST['active'];

            }
            else{

                $active = "No";

            }
            //check whether the image is selected or not, set the value for image name
            if(isset($_FILES['image']['name'])){
                //upload image
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
                    header('location:add_category.php');
                    die();

                }


            }
            else{
                //don't upload image;
                $image_name= " "; 
            }

            //sql query
            $sql= "INSERT INTO category SET
            category_name='$category_name',
            image= '$image_name',
            description='$description',
            active= '$active'

            
            ";
            //execute query
            $res = mysqli_query($conn, $sql);

            //check if the query is successfull
            if($res==true){
                $_SESSION['add'] ="<div class= 'success'>Category Added successfully</div> ";
                header('location:category.php');
            }
            else{
                $_SESSION['add'] ="<div class= 'success'>Failed to add Category</div> ";
                header('location:add_category.php');
            }


           }
           ?>


        </div>
</div>

<?php include('partials/footer.php'); ?>