<style>
  .srchfood{
    background-color:rgb(209, 206, 206) ;
    margin:3% 0;
  }

  .srchbox:hover{
    color:rgb(143, 127, 235);
  }


  .no-results{
    margin:3% 0%;
    text-align:center;
    font-size:1.6rem;
    font-family:'Times New Roman';
  }
</style>
<?php
// Include the database connection file
require_once '../admin/includes/dbconnect.php';

// Include the header file
require_once 'includes/header.php';
$search_term = "{$_POST['search']}";
?>
<div class="srchfood">
<h2 class="text-center">Food on your search <a href="#" class="text-center srchbox" >"<?php echo " $search_term "?>"</a></h2>
<?php

// Check if the search input is provided
//$search=$_POST['search'];
if (isset($_POST['search']) && !empty($_POST['search'])) {
    // Prepare the SQL query
    $sql = "SELECT * FROM food WHERE name LIKE ? OR description LIKE ?";
    $stmt = mysqli_prepare($db_connection, $sql);
    
    // Bind the search term
    $search_term = "%{$_POST['search']}%";
    mysqli_stmt_bind_param($stmt, "ss", $search_term, $search_term);
   
    // Execute the prepared statement
    mysqli_stmt_execute($stmt);
    
    // Check if the query was executed successfully
    if ($res = mysqli_stmt_get_result($stmt)) {
        // Check if any rows were returned
        if (mysqli_num_rows($res) > 0) {
            // Display the food menu items
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $name = $row['name'];
                $image_name = $row['image_name'];
                $price = $row['price'];
                $description = $row['description'];
                ?>
                <div class="col-md-5 food-menu-box float-box">
                    <div class="food-menu-img">
                        <?php
                        // Validate and display the food image
                        if (empty($image_name)) {
                            echo "Image not found";
                        } else {
                            $allowed_extensions = array("jpg", "jpeg", "png", "gif");
                            $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                            if (in_array($file_extension, $allowed_extensions) && finfo_file(finfo_open(FILEINFO_MIME_TYPE), "../admin/resources/images/foods-images/$image_name") !== false) {
                                ?>
                                <img src="../admin/resources/images/foods-images/<?php echo $image_name; ?>" class="img-radius">
                                <?php
                            } else {
                                echo "Invalid image file";
                            }
                        }
                        ?>
                    </div>
                    <div class="food-menu-description">
                        <h5><?php echo $name; ?></h5>
                        <h6 class="food-cost">Rs.<?php echo $price; ?></h6>
                        <p class="food-menu-detail">
                            <?php echo $description; ?>
                        </p>
                        <a href="mycart.php?food_id=<?php echo $id; ?>" class="btn btn-primary add-cart">Order Now</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
            }
        } else {
            // No matching food items found
            echo "<div class='no-results'>No such food available</div>";
        }
        
        // Free the result set
        mysqli_free_result($res);
    } else {
        // Query execution failed
        echo "<div class='error'>Query execution failed</div>";
    }
    ?>


        <div class="clearfix"></div>
    <?php
   
    // Close the prepared statement
    mysqli_stmt_close($stmt);
}
?>

</div>


<?php
// Include the footer file
require_once 'includes/footer.php';

// Include the script file
require_once 'includes/script.php';

// Close the database connection
mysqli_close($db_connection);
?>