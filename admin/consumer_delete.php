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
<?php
if((isset($_GET['id'])) && $_GET['action']=='del'){
    $id=$_GET['id'];

    $sql="delete from contact where id=".$id;
    $result=$db_connection->query($sql);

    if($result){
        header('Location:list_consumer.php?msg='.urlencode('consumer deleted successfully'));
    }
}
?>

<?php
include('includes/footer.php');
ob_flush();
?>