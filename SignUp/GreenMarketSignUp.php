<?php
// Connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'greenmarket');

// Storing the form inputs to local variables
$FirstName = isset($_GET["fn"]) ? $_GET["fn"] : "";
$LastName = isset($_GET["ln"]) ? $_GET["ln"] : "";
$PhoneNumber = isset($_GET["pn"]) ? $_GET["pn"] : "";
$Email = isset($_GET["em"]) ? $_GET["em"] : "";
$Password = isset($_GET["pw"]) ? $_GET["pw"] : "";
$UserName = isset($_GET["us"]) ? $_GET["us"] : "";
$successfulmsg = "";

$fnerror = "";
$lnerror = "";
$pnerror = "";
$unerror = "";
$emerror = "";
$pwerror = "";

$errormsg = "";

$Checker = 0;

$q = "SELECT Email From user ";
$result = $conn->query($q);
if(isset($_GET["submit"]))
{
    if (empty($FirstName)) {
        $fnerror = "*";
        $Checker++;
    }
    if (empty($LastName)) {
        $lnerror = "*";
        $Checker++;
    }
    if (empty($PhoneNumber)) {
        $pnerror = "*";
        $Checker++;
    }
    if (empty($Password)) {
        $pwerror = "*";
        $Checker++;
    } elseif (strlen($Password) < 10) {
        $pwerror = "Password's length should be at least 10";
        $Checker++;
    }
    
    if (empty($UserName)) {
        $unerror = "*";
        $Checker++;
    } else {
        // Assuming you have executed a SELECT query to check if the username already exists
        $result = mysqli_query($conn, "SELECT * FROM user WHERE UserName = '$UserName'");
    
        while ($row = mysqli_fetch_array($result)) {
            if ($UserName == $row["Username"]) {
                $unerror = "Username is already taken";
                $Checker++;
            }
        }
    }
    
    if (empty($Email)) {
        $emerror = "*";
        $Checker++;
    } else {
        // Assuming you have executed a SELECT query to check if the email already exists
        $result = mysqli_query($conn, "SELECT * FROM user WHERE Email = '$Email'");
    
        while ($row = mysqli_fetch_array($result)) {
            if ($Email == $row["Email"]) {
                $emerror = "Email is already registered";
                $Checker++;
            }
        }
    }
    
    if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $Email)) {
        $emerror = "Invalid email format";
        $Checker++;
    }
    
    
    
    if ($Checker > 0) {
        $errormsg = "Fields marked with * must be filled in";
    }
    
    if ($Checker == 0) { // if no errors so add to the database 
        // Corrected the typo in the query
        $seed=substr($UserName,0,2);
        $cryptedpassword = crypt($Password,$seed);
        $query = "INSERT INTO user VALUES ('$UserName', '$FirstName', '$LastName', '$Email', '$cryptedpassword', '$PhoneNumber')";
        mysqli_query($conn, $query);
        $successfulmsg="Your are successfully registerd !";
    }
    
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>TestRegistrationPage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <style>
     * {
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

.content {
    max-width: 700px;
    width: 100%;
    background-color: white;
    box-shadow: 0.5px 1px 10px black;
    padding: 25px 30px;
    border-radius: 20px;
    margin-top: 10%;
    margin-left: 50%;

}

body {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    background-image: url('background.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
}

.sign-up-title {
    font-size: 25px;
    font-weight: 200;
    position: relative;
}

.content .sign-up-title::before {
    content: '';
    position: absolute;
    height: 3px;
    width: 30px;
    background: #089F76;
    left: 0;
    top: 35px;

}

.content form .user-details {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 30px 0 12px 0;

}

form .user-details .input-box {

    width: calc(100% / 2 - 20px);

    margin-bottom: 15px;


}

/*input*/
form .user-details .input-box input {
    outline: none;
    height: 45px;
    width: 100%;
    border-radius: 5px;
    border: 1.5px #ccc solid;
    font-size: 16px;
    padding-left: 15px;
    border-bottom-width: 2px;
    transition: all 0.3s ease;

}

/* when you click on the input*/
form .user-details .input-box input:focus,
form .user-details .input-box input:valid {
    border-color: yellowgreen;

}

.user-details .input-box .info {
    display: block;
    font-weight: 500;


}

/*create an account button*/
form .Create-Button input {
    height: 100%;
    width: 50%;
    outline: none;
    background-color: #089F76;
    border: none;
    font-size: 18px;
    font-weight: 200;
    letter-spacing: 1px;
    border-radius: 10px;
    margin-left: 25%;
    color: white;
    cursor: pointer;



}

form .Create-Button {
    height: 45px;


}



form .UAE-Pass-Button a .UaePassP {
    height: 50%;
    width: 50%;
    margin-left: 25%;
    margin-top: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;



}

.topnav {
    overflow: hidden;
    background-color: #f6f5f5;
    width: 100%;
    position: fixed;
    top: 0;
    z-index: 1000;
    box-shadow: 0.5px 1px 5px black;
}

.topnav a {
    margin-top: 10px;
    float: right;
    display: block;
    color: #0c0c0c;
    text-align: center;
    padding: 14px 25px;
    text-decoration: none;
    font-size: 20px;
}

.topnav a:not(#reg):hover {
    background-color: #089F76;
    color: rgb(245, 245, 245);
    border-radius: 30px;
    box-shadow: 0.5px 1px 5px black;

}

.logo {
    float: left;
    margin-right: 15px;
    width: 70px;
}

.title-content {
    width: 40%;
    position: absolute;
    margin-top: 36%;
    margin-right: 43%;
    padding-top: 20px;
    padding-bottom: 20px;
    color: aliceblue;
    padding-left: 4px;
    background-color: rgba(0, 0, 0, 0.05);
    border-radius: 20px;
    background-attachment: fixed;


}

.title-content p {
    text-align: justify;
    font-size: 25px;

}

.title-photo {
    width: 50%;
    position: absolute;
    margin-top: 5%;
    margin-right: 20%;
    height: 30px;

}

.title-photo img {
    width: 500px;
    height: 500px;
    background-attachment: fixed;
    opacity: 0.3;
    border-radius: 30px;

}

#reg {
    background-color: #089F76;
    border-radius: 30px;
    color: white;
    box-shadow: 0.5px 1px 5px black;
}


.error{
    color:red;
}

.error-message{
    color:red;
    display: flex;
    justify-content:center;


}

.successfullmsg{
    color:green;
    display:flex;

}

nav {
    width: 100%;
    height: 80px;
    display: flex;
    justify-content: space-between;
    padding: 20px 5%;
    background-color:  #E9E9E9;
  }
  
 .heading img {
     float: left;
     margin-top: -20px;
     margin-left: -15px;
  }
  
  nav ul {
    display: flex;
    list-style: none;
  }
  
  nav ul li {
    padding: 8px 15px;
    border-radius: 22px;
    transition: 0.2s ease-in;
  }
  
  nav ul li a {
    color: black;
    font-size: 20px;
    font-weight: bold;
    text-decoration: none;
    color: black;
  }
  .login{
    background-color: #089F76;
    color: white;
    padding: 8px 17px;
    border-radius: 22px;
  }
  
  nav ul li:hover {
    background-color: #089F76;
  }
  
  nav ul li a:hover {
    color: white;
  }


    </style>
</head>

<body>
<nav>
        <div class="heading"><img src="logo.png " alt="logo" width="70" height="70"></div>
        <div class="navbar">
          <ul>
          <ul>
          <li><a class="login" href="../Login/login2.php">Log in</a></li>
          <li><a href="../SignUp/GreenMarketSignUp.php">Register</a></li>
          <li><a href="">About</a></li>
          <li><a href="#">Services</a></li>
        </ul>
          </ul>
        </div>
      </nav>  
      <div class="title-photo">
        <img src="GreenPhoto.jpg" alt="photo">


    </div>
      
    <div class="title-content">
    <p>Join our website dedicated to recycling unwanted food and be part of
            our mission to reduce food waste and create a more sustainable future. Create an account
            today and make a positive impact</p>
    </div>

    <div class="content">

        <div class="sign-up-title">Sign Up</div>
        <div class="error-message"><?= $errormsg ?></div>

        <form action="#">
            <div class="user-details">
                <div class="input-box">
                    <span class="info">First Name  <span  class="error"><?= $fnerror ?></span></span>
                    <input type="text" placeholder="Enter Your First Name" name="fn" >
                  
                </div>
                <div class="input-box">
                    <span class="info">Last Name                     <span class="error"><?= $lnerror ?></span>
 </span>
                    <input type="text" placeholder="Enter Your Last Name" name="ln" >
                </div>
                <div class="input-box">
                    <span class="info">Email                     <span class="error"><?= $emerror ?></span>
</span>
                    <input type="text" placeholder="Enter Your Email" name="em" >
                </div>
                <div class="input-box">
                    <span class="info">Username                     <span class="error"><?= $unerror ?></span>
 </span>
                    <input type="text" placeholder="Enter Your Username" name="us" >
                </div>
                <div class="input-box">
                    <span class="info">Password                    <span class="error"><?= $pwerror ?></span>
</span>
                    <input type="password" placeholder="Enter Your Password" name="pw" >
                </div>
                <div class="input-box">
                    <span class="info">Phone Number                    <span class="error"><?= $pnerror ?></span>
</span>
                    <input type="text" placeholder="Enter Your Phone Number" name="pn" >
                </div>
            </div>
            <div class="Create-Button">
                <input type="submit" value="Create An Account" name="submit"> 
            </div>
            <div class="UAE-Pass-Button">
                <a class="UaePass" href="https://uaepass.ae/">
                    <img class="UaePassP" src="uae-pass.png" alt="signup by uae pass">
                </a>
            </div>
            <!-- Display the error message -->
            <div class="successfullmsg"><?=$successfulmsg?></div>
        </form>
    </div>
</body>

</html>
