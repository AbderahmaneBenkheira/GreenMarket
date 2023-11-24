<?php
session_start();  // Start the session

$conn = mysqli_connect('localhost', 'root', '', 'greenmarket');

// Assuming you have stored the user's information in the session during login
$userName = isset($_SESSION["username"]) ? $_SESSION["username"] : "";

$productName = isset($_GET["productname"]) ? $_GET["productname"] : "";
$productQty = isset($_GET["qty"]) ? $_GET["qty"] : "";
$productPrice = isset($_GET["productPrice"]) ? $_GET["productPrice"] : "";


if (isset($_GET["submit"])) {
    // Use $userName in your query to associate the product with the logged-in user
    $query = "INSERT INTO products (ProductName, ProductQuantity, ProductPrice, ProductProvider) VALUES ('$productName', '$productQty', '$productPrice', '$userName')";

    // Execute your query here using mysqli_query
    mysqli_query($conn, $query);
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Page</title>
    <link rel="icon" type="image/x-icon" href="logo.png">
    <link rel="stylesheet" href="Addproduct.css">

    <script>
      var help

      function ini()
      {
        help = document.getElementById("helper");
        var pr = document.getElementById("pr");
        var qty = document.getElementById("qty");
        var price = document.getElementById("price");
        var Myform = document.getElementById("Myform");

        Rl(pr," Write the Name of the Producted \n Which Start with Upper-Case");
        Rl(qty," Write the Quantity of the product which should be more than 3 Kg");
        Rl(price," Write the price of the product which should be in the range of [0-100]");

        Myform.addEventListener("submit",function(){return confirm(" Are you Sure you want to submit?"); },false);
      }
    
      function Rl(obj,message)
      {
        obj.addEventListener("focus",function(){help.innerHTML = message;},false);
        obj.addEventListener("blur",function(){help.innerHTML = "";},false);
      }



    window.addEventListener("load",ini,false);
   </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    
<nav>
<a href="../Landing_Page/Landingpage.html"> <div class="heading"><img src="logo.png " alt="logo" width="70" height="70"></div></a>
        <div class="navbar">
          <ul>
            <li><a class="login" href="#">Hello <?=$_SESSION["username"]?></a></li>
            <li><a href="logout.php">Log out</a></li>
            <li><a href="../ProductPage/productPage.php">Products</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
          </ul>
        </div>
      </nav>  
      

      
       <section>

       <div class="left">
        <img src="./image.png" alt="">
        <p class="LeftText">Help us build a diverse and vibrant collection of products on our website! Add your products today and be a part of our growing community. Together, we can create a resource that benefits everyone</p>
       </div>


      <div class="input">
        <form action="" id = "Myform">
          <p id = "add" style="font-size:30px; ">Add a product</p>

            <input type="text" name="productname" id="pr" placeholder="Name of the product">
            <input type="text" name="qty" id="qty" placeholder="Quantity">
            <input type="text" name="productname" id="price" placeholder="Price">

          <div class="icon">
            <img src="./icon.png" alt="" class="AddPictures">
            <p>Add pictures</p>
          </div>

            <input type="submit" class="SubmitBtn" id = "submit">
        </form>
      </div>

      <div id = "helper"></div>
       </section>

       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#FFFFFF" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
       
      
</body>
</html>