<?php
ob_start();
session_start();
$user_ID=$_SESSION['user_ID'];
$currentUser=$_SESSION['adminName'];
if(!isset($user_ID))
{
    header("Location:index.php");
}

$main_menu="service-management";
$sub_menu="add-service";

include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');

?>


<?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    

    // echo "<pre>"; print_r($_GET);
    // echo "<pre>"; print_r($_POST);

    $sql="select * from service where name='$name'";
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
        $destination_path="resources/images/service-image/".$image_name;
        // upload the image
        $upload=move_uploaded_file($source_path, $destination_path);

        // check weather image is uploaded or not
        if(!$upload){
            header('Location:list_service.php?msg='.urlencode('failed to upload image'));
            die();
        }
    }else{
        // don't upload the image and set the image_value as blank
        $image_name="";
    }

    if($result->num_rows == 0){
        $sql="INSERT INTO service set name='{$name}', image_name='{$image_name}'";
        
        $result = $db_connection->query($sql);
        if($result){
            header('Location:list_service.php?msg='.urldecode('New category added successfully'));
        }else{
            header('Location:add_service.php?msg='.urlencode('sorry the category cannot be added'));
        }
    }else{
        header('Location:add_service.php?msg='.urlencode('the category is already exists'));
    }
}
?>

<div class="content-box">
    <form action="add_service.php" method="POST" enctype="multipart/form-data">
        <table width="600" border="0" align="center">
        <tr>
            <td colspan="2" align="center"><strong>Add Category</strong> </td>
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