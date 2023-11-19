<?php
session_start();
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Product Page</title>
    <link type="text/css" rel="stylesheet" href="productPageDesign.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

</head>

<body>
    <div class="navBar1">
        <div class="logo">
            <img src="navPhotos/logoPicture.png" alt="logo">
        </div>
        <div class="nav_list">
            <ul class="top_list">
                <li class="homePage"><a href="../Landing_Page/Landingpage.html">Home Page</a></li>
                <li> <a href="#">Welcome Back <?=$_SESSION["username"]?></a></li>
                <li class="logout"><a href="../Login/logout.php">Log out</a></li>
            </ul>

            <div class="photo_icon">
                <a href="#"><img src="navPhotos/profilePicture.jpeg" alt="account photo" class="account_photo"></a>
                <i class="fa-solid fa-bell" style="color: #0d0d0d;"></i>
            </div>
        </div>


    </div>

    <div class="body">
        <div class="navBar2">
            <div class="allProducts">
                All Products
            </div>
            <div class="sorting">
                <ul class="sort_options">
                    <li><button>List by quantity</button></li>
                    <li><button>List by price</button></li>
                    <li><button>Select category</button></li>
                    <li><button>Add products</button></li>
                </ul>
            </div>
        </div>
    </div>
    <script src="productPageScript.js"></script>
</body>

</html>