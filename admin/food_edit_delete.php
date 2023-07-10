<?php
ob_start();
session_start();
$user_ID=$_SESSION['user_ID'];
$currentUser= $_SESSION['adminName'];

if(!isset($user_ID)){
    header("Location:index.php");

}

include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');
?>

<div class="content-box">
    <?php
    if((isset($_GET['id'])) && $_GET['action']=='edit'){
       
        $sql="SELECT * FROM food where id=".$_GET['id'];

        $result = $db_connection->query($sql);

        $count=mysqli_num_rows($result);
        if($count==1){
            $row=mysqli_fetch_array($result);
            $name=$row['name'];
            $current_image=$row['image_name'];
            $price=$row['price'];
            $description=$row['description'];

        }

       // $groupResult= $result->fetch_array(MYSQLI_BOTH);
    //}
    ?>
    <form action="" method="post" enctype="multipart/form-data">
    <table width="100%" border="0" align="center">
        <input type="hidden" name="id" value="<? echo $_GET['id'];?>">
        <tr>
            <td colspan="2" align="center"><strong>Edit Food</strong></td>
        </tr>

        <tr>
            <td>Name</td>
            <td><input type="text" class="text-input medium-input" name="name" required value="<?php echo $name;?>"></td>
        </tr>

        <tr>
            <td>Current Image</td>
            <td>
                <?php
                
                if($current_image!= ""){
                    ?>
                    <img src="<?php ?>resources/images/foods-images/<?php echo $current_image;?>" width="80px">
                    <?php

                }else{
                    echo "Image not found";
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>Select New image</td>
            <td><input type="file" class="text-input medium-input" name="image"></td>
        </tr>

        <tr>
            <td>Price</td>
            <td><input type="text" class="text-input medium-input" name="price" required value="<?php  echo $price;?>"></td>
        </tr>

        <tr>
            <td>Description</td>
            <td><input type="text" class="text-input medium-input" name="description" required value="<?php echo $description ;?>"></td>
        </tr>

        
        <tr>
            <td></td>
            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <td><input type="submit" name="submit" value="UPDATE" class="button"></td>
        </tr>
    </table>
    
    </form>

    <?php } ?>

    <?php
    if (isset($_POST['submit'])){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $current_image=$_POST['current_image'];
        $price=$_POST['price'];
        $description=$_POST['description'];

        // check whether image is selected or not
        if(isset($_FILES['image']['name'])){
            $image_name=$_FILES['image']['name'];
            if($image_name!= ""){
                    // upload the image
                    $source_path=$_FILES['image']['tmp_name'];
                    $destination_path="resources/images/foods-images/".$image_name;
                    // upload the image
                    $upload=move_uploaded_file($source_path, $destination_path);
            
                    // check weather image is uploaded or not
                    if(!$upload){
                        header('Location:list_food.php?msg='.urlencode('failed to upload image'));
                        die();
                    }

                    // remove the current image
                    if($current_image!= ""){
                        $remove_path="resources/images/foods-images/".$current_image;
                        $remove=unlink($remove_path);
                        if(!$remove){
                            $_SESSION['failed-remove']="failed to remove current image";
                            header("Location:list_food.php");
                            die();
                        }
    
                    }
                   

            }else{
                $image_name=$current_image;
            }

        }else{
            $image_name=$current_image;
        }

        // echo "<pre>"; print_r($_GET);
        // echo "<pre>"; print_r($_POST);


        $sql = "UPDATE food set 
        name='$name', 
        image_name='$image_name',
        price='$price', 
        description='$description' where 
        id =".$_GET['id'];
        $result = $db_connection->query($sql);

        if($result){
            header('Location:list_food.php?msg='.urlencode('food updated successfully'));
        }else{
            header('Location:list_food.php?msg='.urlencode('failed to update food'));
        }
    }
    ?>

    <?php
    if((isset($_GET['id'])) && $_GET['action']=='del'){
        $id=$_GET['id'];

    $sql="delete from food where id=".$id;
    $result=$db_connection->query($sql);

    if($result){
        header('Location:list_food.php?msg='.urlencode('food delete successfully'));
    }
    }
    ?>

</div>

<?php
include('includes/footer.php');
ob_flush();
?>