<?php
include('../admin/includes/dbconnect.php');
?>

<?php
include('includes/header.php');
?>
<!--food menu start here-->
<section class="food-menu">
  <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="row">

            <?php
            $sql="select * from food";
            $result=mysqli_query($db_connection, $sql);
            $count=mysqli_num_rows($result);
            if($count>0){
                while($row=mysqli_fetch_assoc($result)){
                    $id=$row['id'];
                    $name=$row['name'];
                    $image_name=$row['image_name'];
                    $price=$row['price'];
                    $description=$row['description'];

                    ?>
                            
                            <div class="col-md-5 food-menu-box float-box">
                                        
                                        <div class="food-menu-img">
                                            <?php
                                            if($image_name== ""){
                                                echo "Image not found";
                                            }else{
                                                ?>
                                                    <img src="<?php ?>../admin/resources/images/foods-images/<?php echo $image_name;?>"  class="img-radius">
                                                <?php
                                            }
                                            ?>
                                            
                                        </div>
                                            <div class="food-menu-description">
                                                <h5><?php echo $name;?></h5>
                                                <h6 class="food-cost">Rs.<?php echo $price;?></h6>
                                                <p class="food-menu-detail">
                                                    <?php echo $description;?>
                                                </p>
                                                <button class="btn btn-primary add-cart" onclick="addcart()"><a href="<?php ?>mycart.php?food_id=<?php echo $id;?>" class="text-white">Order Now</a></button>
                                            </div>
                                            <div class="clearfix"></div>
                                    </div>
                            

                        
                    <?php
                    }
                
            }else{
                echo "food not found";
            }

            ?>
        

            </div>
    </div>
  <div class="clearfix"></div>
</section>
<!--food menu end here-->
<!--
    <script type="text/javascript">
 function addcart(){
    alert('button clicked');
 }
</script>
-->



<?php
include('includes/footer.php');
include('includes/script.php');
?>
