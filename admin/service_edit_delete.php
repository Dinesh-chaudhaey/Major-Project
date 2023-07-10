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
       
        $sql="SELECT * FROM service where id=".$_GET['id'];

        $result = $db_connection->query($sql);

        $count=mysqli_num_rows($result);
        if($count==1){
            $row=mysqli_fetch_array($result);
            $name=$row['name'];
            $current_image=$row['image_name'];
           

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
                    <img src="<?php ?>resources/images/service-image/<?php echo $current_image;?>" width="80px">
                    <?php

                }else{
                    echo "Image not found";
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>Select image</td>
            <td><input type="file" class="text-input medium-input" name="image"></td>
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
      

        // check whether image is selected or not
        if(isset($_FILES['image']['name'])){
            $image_name=$_FILES['image']['name'];
            if($image_name!= ""){
                    // upload the image
                    $source_path=$_FILES['image']['tmp_name'];
                    $destination_path="resources/images/service-image/".$image_name;
                    // upload the image
                    $upload=move_uploaded_file($source_path, $destination_path);
            
                    // check weather image is uploaded or not
                    if(!$upload){
                        header('Location:list_service.php?msg='.urlencode('failed to upload image'));
                        die();
                    }

                    // remove the current image
                    if($current_image!= ""){
                        $remove_path="resources/images/service-image/".$current_image;
                        $remove=unlink($remove_path);
                        if(!$remove){
                            $_SESSION['failed-remove']="failed to remove current image";
                            header("Location:list_service.php");
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


        $sql = "UPDATE service set 
        name='$name', 
        image_name='$image_name'
         where 
        id =".$_GET['id'];
        $result = $db_connection->query($sql);

        if($result){
            header('Location:list_service.php?msg='.urlencode('category updated successfully'));
        }else{
            header('Location:list_service.php?msg='.urlencode('failed to update category'));
        }
    }
    ?>

    <?php
    if((isset($_GET['id'])) && $_GET['action']=='del'){
        $id=$_GET['id'];

    $sql="delete from service where id=".$id;
    $result=$db_connection->query($sql);

    if($result){
        header('Location:list_service.php?msg='.urlencode('category delete successfully'));
    }
    }
    ?>

</div>

<?php
include('includes/footer.php');
ob_flush();
?>