<?php
include('../admin/includes/dbconnect.php');
?>

<?php
include('includes/header.php');
?>
<style>

.style{
    padding-left:40%;
    font-family:arial;
    font-size:38px;
    margin:2% 0 1% 0;
}

.contact-form{
    border:1px solid black;
    border-radius:14px;
    padding:8% 0 16% 8%;
    margin:5% 0;
    background-color:rgb(2, 16, 46);
}

.text-texture{
width:90%;
font-size:18px;
font-family:'Times New Roman', Times, serif;
padding:2% 0 2% 2%;
outline:none;
border:none;
border-radius:6px;
}

.placeholder{
font-size:18px;
}

.uncoupled{
width:44%;
font-size:18px;
font-family:'Times New Roman', Times, serif;
padding:2% 0 2% 2%;
outline:none;
border:none;
border-radius:6px;

}

.butn{
float:right;
margin:4% 9% 0 0;
padding:1% 6%;
border:none;
outline:none;
background-color:rgb(255, 69, 0);
color: #fff;
transition:0.1s ease-in;
font-size:20px;
font-family:'Times New Roman', Times, serif;
border-radius:6px;

}

button:hover{
background-color:rgb(39, 36, 66);
}

textarea{
font-size:18px;
font-family:'Times New Roman', Times, serif;
padding:2% 0 2% 2%;
outline:none;
border:none;
border-radius:6px;
outline:none;
border:none;
border-radius:6px;

}

</style>


<section class="contact" style="background-color: rgb(204, 201, 206)">
<div class="container">
<div class="row">
<h2 class="style">
        Let's connect 
    </h2>
<div class="col-md-4 offset-md-4">
    <form action="" method="POST" class="contact-form">
    <input type="text" name="name" placeholder="Your Name" class="text-texture" required><br><br>
    <input type="email" name="email" placeholder="Your Email" class="text-texture" required><br><br>
    <input type="tel" name="phoneno" placeholder="Your Phone Number" class="text-texture" required><br><br>
    <input type="text" name="location" placeholder="Your Location" class="text-texture" required><br><br>
    <input type="text" name="position" placeholder="Your position" class="uncoupled" required>
    <input type="text" name="companyname" placeholder="Company Name" class="uncoupled" required><br><br>
    <textarea name="msg" id="" cols="30" rows="3" placeholder="Your Messages"></textarea>

    <button class="butn" type="submit" name="submit">Submit</button>
    </form>

    <?php
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phoneno'];
        $location=$_POST['location'];
        $position=$_POST['position'];
        $company_name=$_POST['companyname'];
        $msg_area=$_POST['msg'];




        if(empty($email || $phone)){
            $emailErr="Email is Required";
            $phoneErr="Phone is Required";
        }else{
            $email=filter_var($email, FILTER_SANITIZE_EMAIL);
            if(filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^[0-9]{10}+$/', $phone)){
                $sql="INSERT INTO contact set
                name='$name',
                email='$email',
                phone=' $phone',
                location='$location',
                position='$position',
                company_name='$company_name',
                msg_area='$msg_area'
                ";
        
                $result=mysqli_query($db_connection, $sql);
                if($result){
                    $_SESSION['contact']="You will be notify soon";
                    ?>
                    <script type="text/javascript">
                        alert('Thank you for joining us!');
                        location.href='http://localhost/mproject/frontend/home.php';
                    </script>
                    <?php
                    
                }else{
                    ?>
                    <script type="text/javascript">
                        alert("Something went wrong !");
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
</div>
</div>
</section>

<?php
include('includes/footer.php');
include('includes/script.php');
?>
