<?php
include('../admin/includes/dbconnect.php');
?>

<?php
include('includes/header.php');
?>


<!--section for explore food start here-->
<section class="service col-md-12">
  <div class="container">
    <h2 class="text-center">Explore Food</h2>

        <?php
        $sql="SELECT * FROM service";
        $result=mysqli_query($db_connection, $sql);
        $count=mysqli_num_rows($result);
        if($count>0){
            while($row=mysqli_fetch_assoc($result)){
                $id=$row['id'];
                $name=$row['name'];
                $image_name=$row['image_name'];
                ?>
                <div class="box-3 float-container">
                    <a href="#">
                        <?php
                        if($image_name== ""){
                            echo "image cannot be found";
                        }else{
                            ?>
                                <img src="<?php ?>../admin/resources/images/service-image/<?php echo $image_name;?>"  class="img-responsive img-radius" style="border-radius:18px">
                            <?php
                        }
                        ?>

                    </a>
                    <h3 class="float-text col-white"><?php echo $name;?></h3>
                </div>
                <?php
            }
        }
        
        ?>


   <div class="clearfix"></div>
  </div>
</section>
<!--explore food section end here-->

<!--food menu start here-->
<section class="food-menu">
  <div class="container">
      <h2 class="text-center">Food Menu</h2>
      <div class="row">
        <?php
        $sql="SELECT * FROM food";

        $result=mysqli_query($db_connection, $sql);

        // count rows
        $count=mysqli_num_rows($result);

        // check wether food is available or not

        if($count>0){
            while($row=mysqli_fetch_assoc($result)){
                // get the value
                $id=$row['id'];
                $name=$row['name'];
                $price=$row['price'];
                $description=$row['description'];
                $image_name=$row['image_name'];
                ?>

                
                
                            <div class="col-md-5 food-menu-box  float-box">
                                            <div class="food-menu-img">
                                                <?php
                                                if($image_name== ""){
                                                    echo "image cannot be found";
                                                }else{
                                                    ?>
                                                        <img src="<?php ?>../admin/resources/images/foods-images/<?php echo $image_name;?>"  class="img-radius">
                                                    <?php

                                                }
                                                
                                                ?>
                                            
                                            </div> 
                                                <div class="food-menu-description">
                                                        <h5><?php echo $name;?></h5>
                                                        <h6 class="food-cost">RS.<?php echo $price;?></h6>
                                                        <p class="food-menu-detail">
                                                        <?php echo $description;?>
                                                        </p>
                                                        <button  class="btn btn-primary"><a href="<?php ?>mycart.php?food_id=<?php echo $id;?>" class="text-white">Order Now</a></button>
                                                        
                                                    </div>
                                                
                                                
                                        <div class="clearfix"></div> 
                                        
                                           
                            </div>
                           
               
                
                
                <?php
            }
        }else{
            echo "food are not available";
        }
        
        ?> 
         </div>      
    </div>
  <div class="clearfix"></div>
</section>
<!--food menu end here-->


<?php

include('includes/footer.php');
include('includes/script.php');
?>
