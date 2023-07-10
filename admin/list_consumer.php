<?php
ob_start();
session_start();
$user_ID=$_SESSION['user_ID'];
$currentUser=$_SESSION['adminName'];
if(!isset($user_ID) || $_SESSION['user_index']!='1')
{
    header("Location:index.php");
}

$main_menu="consumer-management";
$sub_menu="list-consumer";

include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');

?>

<div class="content-box">
    <div style="font-size:15pt; text-align:center; display:block;"><strong>Total Consumer</strong></div>
<table width='100%' border='0' cellpadding='0' cellspacing='0' class='table' align='center'>
    <tr>
        <td><b>S.N</b></td>
        <td><b>Name</b></td>
        <td><b>Email</b></td>
        <td><b>Phone No.</b></td>
        <td><b>Location</b></td>
        <td><b>Position</b></td>
        <td><b>Company</b></td>
        <td><b>Message</b></td>
        <td><b>Action</b></td>
    </tr>

    <?php
    $i=1;
    $limit=50;
    $sql="select * from contact order by id DESC";
    include('pagination/paging.php');
    $result=$db_connection->query($sql);
    $rk=$result->num_rows;
    for($r=0; $r<$rk; $r++){
        while($row=$result->fetch_array(MYSQLI_BOTH)){
            $id=$row['id'];
            $name=$row['name'];
            $email=$row['email'];
            $phone=$row['phone'];
            $location=$row['location'];
            $position=$row['position'];
            $company_name=$row['company_name'];
            $msg_area=$row['msg_area'];
            ?>
            <tr>
                <td><?php echo ($start+$i); ?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['location'];?></td>
                <td><?php echo $row['position'];?></td>
                <td><?php echo $row['company_name'];?></td>
                <td><?php echo $row['msg_area'];?></td>
                <td><a href='consumer_delete.php?action=del&id=<?php echo $row['id'];?>' title='click to delete this field' onclick="return confirm ('Are you Sure Want to delete this consumer')"><img src="resources/images/icons/cross.png" alt=""></a></td>
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