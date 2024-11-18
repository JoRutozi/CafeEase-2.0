<?php include('partials/menu.php'); ?>
<!--Main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

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
                    <input type="text" name="product_name" placeholder="product name"> 

                </td>
            </tr>
            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" >Description</textarea>

                </td>
            </tr>
            <tr>
                <td>Title: </td>
                <td>
                    <input type="number" name="price" placeholder="price"> 

                </td>
            </tr>
            <tr>
                <td>Image: </td>
                <td>
                    <input type="file" name="image" > 

                </td>
            </tr>
            <tr>
                <td>Category: </td>
                <td>
                <select name="category" >
                    <?php 
                    $sql ="SELECT * FROM category WHERE active='Yes'";
                    $res= mysqli_query($conn, $sql);
                    $count=mysqli_num_rows($res);

                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $category_ID = $row['category_ID'];
                            $category_name = $row['category_name'];
                        ?>
                        <option value="<?php echo $category_ID; ?>"><?php echo $category_name; ?></option>
                        <?php
                        }

                    }
                    else{
                        ?>
                        <option value="0">No category found</option>
                        <?php
                    }

                    ?>
                    
                </select>
                </td>
            </tr>
            <tr>   
                <td>Featured: </td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No

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
                    <input type="submit" name="submit" value="Add product" class="btn-primary">

                </td>
            </tr>

           </table>



           </form>

           <?php 
           if(isset($_POST['submit'])){
            //
            //get the value from form
            $product_name= $_POST['product_name'];
            $description= $_POST['description'];
            $price= $_POST['price'];
            $category= $_POST['category'];
            //for radio input, check if the button is selected or not
            if(isset($_POST['featured'])){

                $featured = $_POST['featured'];

            }
            else{

                $featured = "No";

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
                $image_name= "Food_".rand(000, 999).".".$ext;

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/food/".$image_name;
                
                $upload = move_uploaded_file($source_path, $destination_path);
                //check whether the image is uploaded or not
                if($upload==false){

                    $_SESSION['upload'] ="<div class='error'>Failed to upload</div>";
                    header('location:add_food.php');
                    die();

                }


            }
            else{
                //don't upload image;
                $image_name= " "; 
            }

            //sql query
            $sql= "INSERT INTO product SET
            product_name='$product_name',
            description='$description',
            price='$price',
            category_ID='$category',
            image= '$image_name',
            featured='$featured',
            active= '$active'

            
            ";
            //execute query
            $res = mysqli_query($conn, $sql);

            //check if the query is successfull
            if($res==true){
                $_SESSION['add'] ="<div class= 'success'>product Added successfully</div> ";
                header('location:food.php');
            }
            else{
                $_SESSION['add'] ="<div class= 'success'>Failed to add food</div> ";
                header('location:add_food.php');
            }


           }
           ?>


    </div>
</div>
<?php include('partials/footer.php'); ?>
