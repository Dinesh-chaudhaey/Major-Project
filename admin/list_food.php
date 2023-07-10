<?php
ob_start();
session_start();
$user_ID=$_SESSION['user_ID'];
$currentUser= $_SESSION['adminName'];

if(!isset($user_ID) || $_SESSION['user_index']!='1'){
    header("Location:index.php");
}

$main_menu="food-management";
$sub_menu="list-food";

include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');
?>

<div class="content-box">
    <div style="font-size:15pt; text-align:center; display:block;"><strong>Total Food</strong></div>

<table width='100%' border='0' cellpadding='0' cellspacing='0' class='table' align='center'>
<tr>
    <td><b>SN</b></td>
    <td><b>Name</b></td>
    <td><b>Image</b></td>
    <td><b>Price</b></td>
    <td><b>Description</b></td>
    <td><b>Edit/Delete</b></td>
</tr>


<?php
$i=1;
$limit=25;
$sql="select * from food order by id DESC";
include('pagination/paging.php');
$result=$db_connection->query($sql);
$rk=$result->num_rows;
for($r=0; $r<$rk; $r++){
    while($row = $result->fetch_array(MYSQLI_BOTH)){
        $id=$row['id'];
        $name=$row['name'];
        $image_name=$row['image_name'];
        $price=$row['price'];
        $description=$row['description'];
    ?>
    <tr><td><?php echo ($start+$i);?></td>
    <td> <?php echo $row['name']; ?></td>
    <td>
        <?php
       
        // check weather image is available or not
        if($image_name!=""){
           // display the imge
           ?>
           <img src="<?php ?>resources/images/foods-images/<?php echo $image_name;?>" width="80px">
           <?php
        }else{
            // image not found
            echo "Image not found.";
        }
        ?>
    </td>
    <td> <?php echo $row['price']; ?></td>
    <td> <?php echo $row['description']; ?></td>

    <td><a href='food_edit_delete.php?action=edit&id=<?php echo $row['id']?>' title='click to edit this field'><img src="resources/images/icons/edit-icon.png" width="14" height="14"/></a> &nbsp;&nbsp;<a href='food_edit_delete.php?action=del&id=<?php echo $row['id']?>' title='click to delete this field' onclick="return confirm ('Are you sure')"><img src="resources/images/icons/cross.png" alt=""></a></td>
    </tr>
    <?php $i++;
    }
}

?>
</table>
<?php include_once('pagination/paging_show.php'); ?>

</div>
<?php
include('includes/footer.php');
ob_flush();
?>