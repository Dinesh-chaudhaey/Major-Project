<?php
include('../admin/includes/dbconnect.php');
?>

<?php
include('includes/header.php');
?>



<!--section for explore food start here-->
<section class="service col-md-12">
  <div class="container">
    <h2 class="text-center">Food Category</h2>

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






<?php
include('includes/footer.php');
include('includes/script.php');
?>
