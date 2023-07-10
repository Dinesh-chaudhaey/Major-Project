<?php
include_once('../admin/includes/dbconnect.php');
include_once('includes/header.php');

if (isset($_GET['food_id']) && is_numeric($_GET['food_id'])) {
    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM food WHERE id=?";

    if ($stmt = $db_connection->prepare($sql)) {
        $stmt->bind_param("i", $food_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $price = $row['price'];
            $title = $row['name'];
            $image_name = $row['image_name'];
        } else {
            header("Location:menu.php");
            exit();
        }
    }

    $stmt->close();
} else {
    header("Location:home.php");
    exit();
}
?>

<link rel="stylesheet" href="mycart.css">

<section class="food-search">
    <div class="container">
        <h2 class="text-center">Order Summary</h2>

        <form action="#" class="order" method="POST">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                        if ($image_name != null) {
                            echo "<img src=\"images/image/$image_name\" alt=\"#\" class=\"img-responsive img-curve\">";
                        } else {
                            echo "Image not Available";
                        }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">Rs.<?php echo $price; ?></p>
                    <input type="hidden" name="price" class="iprice" value="<?php echo $price; ?>">
                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive iquantity" value="1" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" onlychar name="full_name" placeholder="E.g Your names " class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" id="number" value="" min="1" max="10"  placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="example@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary text-white text-sizes">
            </fieldset>

        </form>


            <?php
            // check weather button is clicked

           
            // check whether button is clicked

            if(isset($_POST['submit'])){
                $food=$_POST['food'];
                $price=$_POST['price'];
                $quantity=$_POST['qty'];
                $total=$price * $quantity;
                $order_date=date("y-m-d h:i:sa");
                $status="Ordered";
                $customer_name=$_POST['full_name'];
                $contact=$_POST['contact'];
                $email=isset($_POST['email']) ? $_POST['email']: '';
                $address=$_POST['address'];

                if(empty($email || $contact)){
                    $emailErr="Email is Required";
                    $contactErr="Phone is Required";
                }else{
                    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
                    if(filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^[0-9]{10}+$/', $contact)){
                            $sql1="INSERT INTO tbl_order SET
                            food='{$food}',
                            price='{$price}',
                            quantity='{$quantity}',
                            total='{$total}',
                            order_date='{$order_date}',
                            status='{$status}',
                            customer_name='{$customer_name}',
                            contact='{$contact}',
                            email='{$email}',
                            address='{$address}'";

                            $result1=mysqli_query($db_connection, $sql1);
                            if($result1==true){
                                ?>
                                <script type="text/Javascript">
                                    alert('Food Ordered Successfully');
                                    location.href='http://localhost/mproject/frontend/menu.php';

                                </script>
                                <?php
                            }else{
                                ?>
                                <script type="text/Javascript">
                                    alert('Failed to Order Food');
                                    location.href='http://localhost/mproject/frontend/menu.php';

                                </script>
                                <?php
                            }
                    }else{
                        ?>
                        <script type="text/Javascript">
                            alert('please enter valid email or phone');

                        </script>
                        <?php
                    }
                }    
            }


           
            ?>
        </div>
    </section>

<?php
include('includes/footer.php');
include('includes/script.php');
?>
