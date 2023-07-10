<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php"><img src="images/logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link"  href="home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="service.php">SERVICE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="menu.php">MENU</a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link " href="contact.php">CONTACT</a>
        </li>

        <!--
                    <li class="nav-item">
          
          <i class="fa fa-shopping-cart" style="font-size:1.8rem; cursor:pointer; " id="cart-icon"></i>
          
          </li>
        -->

        
        
        

        

        
      </ul>
      <form class="d-flex" role="search" method="POST" action="<?php ?>food-search.php">
        <input class="form-control me-2" type="search" name="search" placeholder="Search in WoW Food" aria-label="Search" required>
        <button class="btn btn-outline-success" name="submit" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<script type="text/javascript">
let button=document.getElementById('cart-icon');
button.onclick=function(e){
    e.preventDefault();
    location.href='http://localhost/mproject/frontend/mycart.php';
}
</script>