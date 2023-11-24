<?php
session_start();  // Start the session

$conn = mysqli_connect('localhost', 'root', '', 'greenmarket');

$email = isset($_GET["email"]) ? $_GET["email"] : "";
$password = isset($_GET["password"]) ? $_GET["password"] : "";

$emailError = "";
$passwordError = "";

$query = "SELECT Email, Password, Username FROM user";
$result = $conn->query($query);

if (isset($_GET["submit"])) {
    while ($row = mysqli_fetch_array($result)) {
        if ($row["Email"] == $email || $row["Username"] == $email) {
            $seed = substr($row["Username"], 0, 2);
            $encryptedPass = crypt($password, $seed);

            if ($row["Password"] == $encryptedPass) {
                // Set session variables
                $_SESSION["username"] = $row["Username"];
                $_SESSION["email"] = $row["Email"];

                // Redirect to the product page
                header('location: /GreenMarket/ProductPage/productPage.php');
                exit();
            } else {
                $passwordError = "Password is incorrect";
            }
        } else {
            $emailError = "Email is incorrect";
        }
    }
}

mysqli_close($conn);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" type="image/x-icon" href="logo.png">
    <link rel="stylesheet" href="LogInStyle.css">
    <!--to get icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--to get the font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body>

    <nav>
    <a href="../Landing_Page/Landingpage.html"> <div class="heading"><img src="logo.png " alt="logo" width="70" height="70"></div></a>
        <div class="navbar">
            <ul>
                <li><a class="login" href="../Landing_Page/">Log in</a></li>
                <li><a href="../SignUp/GreenMarketSignUp.php">Register</a></li>
                <li><a href="">About</a></li>
                <li><a href="#">Services</a></li>
            </ul>
        </div>
    </nav>


    <div class="frame">
        <form action="" method="get">
            <h1>Log In</h1>
            <div class="input-area">
                <input type="text" name="email" placeholder="Enter your username" required>
                <i class='bx bxs-user'></i>
                <span style="color:red;font-size"  class="error" ><?php echo $emailError; ?></span>
            </div>
            <div class="input-area">
                <input type="password" name="password" placeholder="Enter your password" required>
                <i class='bx bxs-lock-alt'></i>
                <span class="error" style="color:red"><?php echo $passwordError; ?></span>
            </div>
            <div class="check-area">
                <label for="remember me"><input type="checkbox">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" name="submit" class="Login-btn">Login</button>
            <div class="UAE-Pass-Button">
                <a class="UaePass" href="https://uaepass.ae/">
                    <img class="UaePassP" src="uae-pass.png" alt="signup by uae pass">
                </a>

   
                <div class="Register-Page-Link">
                <p>Don't have an account? <a href="#">Register</a></p>
            </div>
            </div>
        </form>
    </div>
   


</body>

</html>