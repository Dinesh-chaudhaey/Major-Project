<?php
ob_start();
session_start();
$user_ID=$_SESSION['user_ID'];
$currentUser=$_SESSION['adminName'];
if(!isset($user_ID))
{
    header("Location:index.php");
}

$main_menu="food-management";
$sub_menu="add-food";

include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');

?>


<?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $description=$_POST['description'];

    // echo "<pre>"; print_r($_GET);
    // echo "<pre>"; print_r($_POST);

    $sql="select * from food where name='$name'";
    $result=$db_connection->query($sql);
    
    //check weather the image is selected or not
    // print_r($_FILES['image']);
    // die();
    if(isset($_FILES['image']['name'])){
        // upload the image
        // to upload the image we need image name source path and destination path
        $image_name=$_FILES['image']['name'];

        // // autorename of image 
        // $ext=end(explode('.', $image_name));
        // // rename of imge
        // $image_name="food_".rand(000, 999).'.'.$ext;


        $source_path=$_FILES['image']['tmp_name'];
        $destination_path="resources/images/foods-images/".$image_name;
        // upload the image
        $upload=move_uploaded_file($source_path, $destination_path);

        // check weather image is uploaded or not
        if(!$upload){
            header('Location:list_food.php?msg='.urlencode('failed to upload image'));
            die();
        }
    }else{
        // don't upload the image and set the image_value as blank
        $image_name="";
    }

    if($result->num_rows == 0){
        $sql="INSERT INTO food set name='{$name}', image_name='{$image_name}', price='{$price}', description='{$description}'";
        
        $result = $db_connection->query($sql);
        if($result){
            header('Location:list_food.php?msg='.urldecode('New food added successfully'));
        }else{
            header('Location:add_food.php?msg='.urlencode('sorry the food cannot be added'));
        }
    }else{
        header('Location:add_food.php?msg='.urlencode('the food is already exists'));
    }
}
?>

<div class="content-box">
    <form action="add_food.php" method="POST" enctype="multipart/form-data">
        <table width="600" border="0" align="center">
        <tr>
            <td colspan="2" align="center"><strong>Add Food</strong> </td>
        </tr>

        <tr>
            <td>Name</td>
            <td><input type="text" class="text-input medium-input" name="name" required value=""></td>
        </tr>

        <tr>
            <td>Select Image:</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Price</td>
            <td><input type="text" class="text-input medium-input" name="price" required value=""></td>
        </tr>


        <tr>
            <td>Description</td>
            <td><input type="text" class="text-input medium-input" name="description" required value=""></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="ADD" class="button"></td>
        </tr>

        </table>
       

    
</form>
</div>


<?php
include('includes/footer.php');
ob_flush();
?>