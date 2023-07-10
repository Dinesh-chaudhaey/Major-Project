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
<div class="content"> <!--content start here-->

<?php
if(isset($_GET['id']) && $_GET['action']=='edit'){
    $sql="SELECT * FROM tbl_order where id=".$_GET['id'];
    $result=$db_connection->query($sql);
    $count=mysqli_num_rows($result);
    if($count==1){
        $row=mysqli_fetch_array($result);
        $food=$row['food'];
		$price=$row['price'];
		$qty=$row['quantity'];
		$total=$row['total'];
		$order_date=$row['order_date'];
		$status=$row['status'];
		$customer_name=$row['customer_name'];
		$contact=$row['contact'];
		$email=$row['email'];
		$address=$row['address'];
    }
?>

<form action="" method="post">
    <table width="100%" border="0" align="center">
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
        <tr>
            <td colspan="2" align="center"> <strong>Edit Order</strong></td>
        </tr>

        <tr>
            <td>Food</td>
            <td><input type="text" readonly class="text-input medium-input" name="food" required value="<?php echo $food;?>"></td>
        </tr>

        <tr>
            <td>Price</td>
            <td><input type="tel" readonly class="text-input medium-input" name="price" required value="<?php echo $price;?>"></td>
        </tr>

        <tr>
            <td>Quantity</td>
            <td><input type="number" readonly class="text-input medium-input" name="qty" required value="<?php echo $qty;?>"></td>
        </tr>

        <tr>
            <td>Total</td>
            <td><input type="tel" readonly class="text-input medium-input" name="total" required value="<?php echo $total;?>"></td>
        </tr>

        <tr>
            <td>Order Date</td>
            <td><input type="date('y-m-d h:i:sa')" readonly class="text-input medium-input" name="date" required value="<?php echo $order_date;?>"></td>
        </tr>

        <tr>
            <td>Status</td>
            <td>
                 <select class="text-input medium-input" name="status" required value="<?php echo $status;?>">
                         <option value="Ordered">Ordered</option>
                         <option value="Delivered">Delivered</option>
                         <option value="On Delivery">On Delivery</option>
                         <option value="Cancelled">Cancelled</option>
                 </select>
           </td>
          
        </tr>

        <tr>
            <td>Customer Name</td>
            <td><input type="text" readonly class="text-input medium-input"  name="customer_name" required value="<?php echo $customer_name;?>"></td>
        </tr>

        <tr>
            <td>Contact</td>
            <td><input type="tel" readonly class="text-input medium-input" name="contact" required value="<?php echo $contact;?>"></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><input type="email" readonly class="text-input medium-input" name="email" required value="<?php echo $email;?>"></td>
        </tr>

        <tr>
            <td>Address</td>
            <td><input type="text" class="text-input medium-input" name="address" required value="<?php echo $address;?>"></td>

        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="UPDATE" class="button"></td>
        </tr>


    </table>
</form>

<?php } ?>

<?php
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $food=$_POST['food'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];
    $total=$_POST['total'];
    $order_date=$_POST['date'];
    $status=$_POST['status'];
    $customer_name=$_POST['customer_name'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $address=$_POST['address'];

    $sql1="UPDATE tbl_order set
    food='{$food}',
    price='{$price}',
    quantity='{$qty}',
    total='{$total}',
    order_date='{$order_date}',
    status='{$status}',
    customer_name='{$customer_name}',
    contact='{$contact}',
    email='{$email}',
    address='{$address}'
 where
     id=".$_GET['id'] ;
     $result1=$db_connection->query($sql1);

     if($result1){
        header('Location:list_order.php?msg='.urlencode('Order updated successfully'));
     }else{
        header('Location:order_edit_delete.php?msg='.urlencode('failed to update order'));
     }
}
?>

<?php
if(isset($_GET['id']) && $_GET['action']=='del'){
    $id=$_GET['id'];
    $sql="delete from tbl_order where id=".$id;
    $result=$db_connection->query($sql);
    if($result){
        header('Location:list_order.php?msg='.urlencode('order deleted successfully'));
    }
}
?>





<?php
include('includes/footer.php');
ob_flush();
?>






