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







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>Document</title>


    <link href="login2.css" rel="stylesheet" type="text/css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">


   
</head>

<body>


<div > 

<div id="imgDiv">
<img width="60px" src="logoPicture.png" alt="ff" width="35px">
</div>


<ul >

    <li class="">  <a href="../Landing_Page/Landingpage.html" >Home Page</a>  </li> 

<li class="listFormat" id="logBorder"> <a  class="log" href="#Login"> Log in </a> </li>

<li class=""><a href="../SignUp/GreenMarketSignUp.php">Register </a></li>


</ul>

<div id="userDiv">
     <img src="avatar.png" alt="rr" id="user" width="40px">
     <div id="notif">
        <img  width="30px" src="notification.png" alt="">
    </div>

    
</div>




</div>

    </div>


    <div id="secondpart">


        <h1>Good To See You again !</h1>


       



        <div id="formDiv">


            <div id="log_pic">

                <img src="user-interface.png" alt="log" width="170px">
    
            </div>


            <form>


               
                <p id="L1"> <b>Login</b> </p>



                <label for="EmailPlace">Email/Phone number <span style="color:red"><?=$emailError?></span></label>
                <br>
                <input class="bottomMargin" type="email" id="EmailPlace" placeholder="e.g email@gmail.com" size="50" name="email" > 

                <br>
                <label for="passPlace"> Password <span style="color:red"> <?=$passwordError?></span></label>
                <br>

                <input type="password" id="passPlace" placeholder="e.g gd!3322a@1" size="50" name="password"> 

                

                <br>
                <div>
                <input type="submit" value="log in " id="log" name="submit">
            </div>


            <div >

               <button  id="b1"> Login With <img width="13px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAN0AAADkCAMAAAArb9FNAAAA7VBMVEX///8cHRoAAAAYrXXoICcaGxgXGBUTFBD19fUQEQ0WFxP5+fkAqm/8/PwKDAbo6Ojk5OQHCQAABAAAp2koKSbf39/S0tLu7u43ODbCwsJ8fHvh4eEjJCHY2NjGxsaioqF0dHOcnJtSUlG0tLOOjo3nAABqamk+Pz1ZWVhhYWCDg4KLi4ru9/M6Ozmurq65ubhISEcvMC773N1pxJ6b1rzT7eJQvJDF59mn28UytIG34c98yKboFR7nABDxiIvtYmbd8umL0LJiwZnR5NX98PHubXDznZ/rREn4yMn1sbPsUlfpLDP3u73ylpn96enjgctxAAAZO0lEQVR4nN1dd3/ayNY2E6sCAhG6KaKEGlOyTts4d53cvdtu+f4f55UwRqfMqIBkZ9/zT/IzAuloTnlOmTNXV3lSq9rfbkZTb7Fot9uFgPx/d4tZdzTcdBoVM9eb50hmc7IatzXhU821bFvTtAN3/r+6bVhu8IHotRerTdMsv/TDpqFyc+i1/Wd3Df2RIyVpthGwWV9OO62XfuokZDZHc/95HTuaLUy6VRPC8DY3L/30kdTaLAtCpGIMrKMjRNvb/qCqWB3thLBiRDGGbJ/DxbD60qxQqgxvfdm6iLMnMvwlHP1IMtpZni2PUtKF2G1+DDNTmRYuFUgJ+Ss4G7w0a1fNmRCZs/ZIluiNXnQBOzth5cPagXThev2X4m2yT2BIfIft1ASjmmPYCdbcdxPjzgvxFmNJdN++i8J84U0320GzWjXLPpnVanOwnUy7i3n9gGfieDREe/vcvHXmkbzplv/k++5wEAWUzUpzs94dWIzkzxbtzfNx5tuSXQRvms9Z3ds0iwl/rNFZjX1RjVpEXeyfbf0qM7W+aa7oLTep0UZxMN05wlEzaIv58ziIjXBUj1AT2jrxmlFqbT1fSHU1f8tnwKBLhX/zzVt72rjwx5uruppBx83dPSyE9M6GKHSbmdygueqpnKjt5gywNzLm/GXbbc8VSE7lwUyBW61xZjeR0pzf1UcUq0slkpLpxxyyBRS5Lp5ZoEqn+2gwF20fLEWNabjI1XCW9zrlbZJbzudmLQSxMCIb3VbRDMqLDyImud6tOKwj/jSRb/psIMCt9vnyFlB5A/lzuznfbuk+8eYOc77VkTa9JwOqiUrO9zL3vjfXbGFNny/HurkNon//pvnLSstzhTsfpo6aW80D9SuVMwLuzswWov0sSLNYTe8CNnUUvGq3C2892vZTuK9zXsoz0ZKY9iBiP5QSjPZs2Klkh3NegtZycHpgM4hz64vp4EWS0NXtcJBCJoqD7m5O8XRFydwTKDBqQszXz82hOTuoyTTZ1eWBZwjHsF2xQn+XQm9G/tes8XOm2Vv72qOfWSa4uLGun6JrzN7KTcJdcCNDiN3ouRgcP0XhYhRzZXEyR2GngFHDShXMy8hncP4safb+SaJiAF5rapOAzIWLl0wyQ7KFu8wXLgc0Cp8qCpxXPZ5tN2Cc2UrJ3SGvNh/mDIa8UKLUIKgxk+Wy7Dm8ZpqavWABxTpXWAmsgSpsvJnJM2QWtkOzcypgWk10c+RvAiRTmltodVXZP0GyxxOMxA6VBCu2kqC5opubgSmf1EmarilPhcrUGwV2datvtg6Iq2VWG4POZuot2wcspsxgHsgV67x8/JOx02VLt60rK3eOlSiNVDZvtqOFv6pulNwKPa9AcigcW/c9ENe6mzHNeRwpqPwsU6lLtbOeC+Eo11AT7Zz8w013Xt9NmWwUV/JSgl4TdW97hqqYnW5bXXy3xSwv9ZOEJ52eNGlbE/vp2WWEq3J/tJck+R7JNfKPyx/Jh9YSKbKEsb44z99Xthj4WPdZwtetxAtovq5llBcYqPoMHJF/Da844/fW/RgpQ2DfGmlSDdSEl91NpDTQmIvTRW+YderAjzhkVkvssy5YIJoyjdPEPpeidmcsWz8jx6SfyYt3ws0Nyg9kTRWaWOd0u75OzYklpnmmsyZ7iX0Ri1yQ2YS+Sk0s8k4SjCxun516DoHDlL5HJ5UOtPqDznY4HK3Ww+Gw02k2kq1AS+JbDStzYDYjKqeJWbLnqzSH63HvFPi47um/+9l00o910b76Ufb0jD1fmdqTRMar2Bwu966yXerQDm23u5ubaMO0khjqLO10cV7DPy9uYzXuZrj0gwsrOnrzHzSIKfbRyLvJYK0msouKim2H/HZclbA/1dI0SQcczqMStV1mPJNmkGPJnGPm9Bi5uJmqsb6a7Mh24a1DsUtG7BVvMXOGG2mytmNRixNHBfmS7Kl+u9Km0pkJeyYRS2cfoSKV6WWt7ZrjAzsFQOgy9i7XvfIYMyd2akfQz6JJ2hb1kZy/If3xyy0ncQViobyyKU3bnkG6sOX8dQha0sSFXcUeYc5TXdhfZNgA7htcKTiv9ixy3UWoZZSQucos4+Z2TbRl69IiRkC3LkC6k2TMFdfKhtTHR9UNy4F5aMcy7Di7qksxujnGj2S0z44Y+smYmzjqIkjQJC2M9njWHW22245Pk60PpWeL3T5gMxLKWNKqITEEzu5M5loFdG9FAba6UNnJAIHoy9H2piXToWKrsR3NAnitxDSamPMsG4W8pIqdmHZIlZy59KKhQuGMoGN/G68VreZo5r8FRUe7IVs+yt5ZfgF7T2suM9LVnVQodSFS1febwd49OQoQYw4eFgjTa+KMNOoWPbfdkyGUiWzhgvbvYerwubIZyzPtjs6sfnmHjJheSJ3+aCBt0qT1O0lqM1i27pkp6dbwVqaDOkdcxTZWmiQtGZDMHnqPMlBw0yZB3+FJ6hf1Eft4h/9oQczodS0bP15KQD1HL0em2x2+e0cT2uTSHFl1LWuHHtNX1scXiVRbSZdI6WSObsSkUsuojGiuXZf+trOnijxAT+imcQtrYi75FSwc8X3vOqvcptll1soo0NUZwiew5e5KSh306JrFDSDNkPkLN85yn3GDVXZth9o1+Awar9OrqIWFjpeVy2PKnGNlXUzY9oh5sZlbA2jDSI7HFsibcHvEmROL7CuHpkc0W6+R1auEliW50WxipeNvhTJnZ5h+g7Ql2mcXiIqcNChFs/saVug0l36vOCYi4/RSF9XKyZa6RcOdHnEMx+y/niLnP4Z+jC/Lkqxc+ppMc7kvtJP1SK2wdDJBGgpRqwkjRQICbtPiculR5qITt2/fv6d/mvpRnabXkuVEJth2MtTSmkynnTSeaBYaFY3tCCPdelpkW+rD3edS6XXpGwrvnvxUwpxI00KQ6OIkJkABTJ63lDm1wL/99KFUehVQ6QNgzzzJmpHMA9/0MHuXbq4/uUlWxcWBQ1TG7eHLkbUDez+FH4A+24TgsFKHplOrXep8Hjfu6iymL9btZMy9/wB48+n1w+mjLuhoTdjhYu4hexIXlZJGh9ZCJnUz7AtUzL3/8PoVptLd6UMvPXdXFRSOXV4/KHY2/NZDks+Q69zbnyhvSDQT9lpjqiDLeU6mIZZuCHNya3mHZfLI3ZfT57BPHn+zP10uVSN/mlDh7dusWAI0x7ZL6ucePkt487n7FF6yeIJCBCh0hbAsoWpHQXnjzCqTIWFP50h3fn/iQvloVd6G15i3h3XQiGN+gkCqGhO6vbxL2xz1gp0a5zCHnYG9lzxD+bt04Xzm7uBlphdMkynglQvXxqrLYesYGE5LVolqFALttMX4jCB6jBMtEsVWSKXP3BdyZWswoU2qAP5p8tpuCyZ0Jea6WDhqTqJNS5hwvUSW/v34Wsrc69KHj/E/XwQ/31P4UZhJ0ffs4zBbknrLfbEOTbIsf/izTOVKpQ8/v+XXcsJ7aRTsdYG7Ze8X7PO3WIIwhlAdTzM4GJLZk9Lrbw8Jf9+Ea6dirwy2LugFUnkB70eysMEF0lrN41ehSZHc+k7iwV/dSX5JRXsbcqcIIGA2iwaeYH+mXudf3e58phX7UlYQgjl84fnKlUp3qfo2AQ7qHZ7Qkfn1ZWjaNAN/BOZrGNxbzYSh+TGlK9NIpBWaYG+A69zr74nUDdCpmNQ7PuJeYtircPGI5oWc83zCU8ityyaYoJ2d/LvvGWh+lcBMEioeq3K9k4jIYgEgRBSPnRwyfy+N00uRyF0LFmbsNpW4t0wqv5/VTNwVvXqvF95JBsqgAaCGf/NYAXS4L16H74TvAUUGk5uUz1QqP9ErEtKKpmwkhhPUACzqlwbBTFnZHiTgzhjrZQgSuMb+RJ34w5nMsU33msVtHJQjnsRsdGR742FzA+MOw3NqqYlFKX1Oa04gkdWToQaw/zl2I/WRYIKWmUSY32RL94BXrvThEuZ4axMPkIFfS1r4aYe+lNUbbiKX7kMJM3cWT4Bwz52mc0EDPi9ZkN6IcCNoXRnrnzBzn6OMZavZ2cbmGkwNZWddj10BAEstURQLgILmkreFplDRXvK3mLlXKubMwXR87KGKCy5JUlGCyEILmEw0gWYxxYIVIVYDJPZSoXODmSFqx1tosa1BeLCApDAHvVeSjGiUYMIZDdRIvcdJSzlAGbZxm0ZsMnmJy4cMGgI9StJmBJeHATFQoGcI8wNiThoSbFiLjd2OeZwiav+TXB7G8Ya8F7a8WRRuV0eTA7CITiUZck6zGR+hq5Oay/5ctk0prsUKl+35vpHpSTRp0vCRqm0/IrDdo6SB+W4OzeNNa+r7oKUrSZRuKt8iGGvHZ1A2efYSvHHZbxW1Iz8HvF+GMIwqxQ5kcwyMvVFo8PpndhdT3iGnSNehb+JgmWke4E5S0/aeFuRQb4bRG4Vu8DPHw58hg8nlslqX99tqWnxGDuX0GVoGwkafyadiaCkC3oGYaw65FNbryLoiXweKPEfq64p9CXTm0Wy35APLUZKKKWroNCQ2B2Bmy0MvimWTutAfYF/9DXAHC3SPVFXt+3facOkatrAMS0RXQRkkgT6BZY1BYjAwqcCoMDEGSVRqfSNNSqsn3VKtO2IO16lyPOFDY7oFi/f6nmCgYi8UPoZlAMx2VuiH6LUomsKcQ3dQoslm0nR8eDk+DLNvPWx2T45b18gaoMVjvIfgShJFhNDR1yWzp44HkZ/Hpg7alNIDuQHtkdOCTuImQ6HgNbOSUg9oHrMdoZ+SAOmTVhrtMk4EEnMGVJKIRxnK5Xfy+wPCnKsYJQDtGTUd0Gwypw1qKpK88zFItAJnCGwMg6xAJYldhoJJAWYZWbyCLrqKfp1NhL8x4VggqjHhM9uyzNmhMC52AcQGEs4kAPp5rHbQYr4i38KVPktTBnWoI42CWGiuXZIeC4sq8qy62RltHlEMEAGWqIBqh58RJMJK3/CXKghpOLfqDgwTnvVEC6ow10OFKgw6tUJ0g8cUjNUiBgjF7Ei6YDqlRHqlUFpevo3hdCmI+1n2HzoFurCLk9FkXXqYPODuiOUF1oGEwTAT9hl/CZZzCnYhskWuEWX3oYBTAB/2hcREHAvg7gi+VaMYoHbU2SGMGNe0AUA6i0+gaFLFC5M9MZi8DdwdedEgLid+BaodiQ6QQMVlHOGrYKIJssRU8cLvxby/ffj7NaIjEKNh0YD+AKOwPnreuIJCJWqhgdXUevjRQocXU0YGmQWHcAeySfjODzC0w9+BRYcEaY8diCToSsMkOMkPDc7gzsXcldvA3SHTBH05ASrgcTU7ljkkmjSBV1E7pGZS7sYnPaF+v6gBlUSf3AGjgr2dCZQlSTIViyZ5u3slmEjMXQiHqGQA265Z6JMvgDtcz0K4O0kiHIkmedLQq9E31U/KXfmp+9GgbQSAO5K6+Q5MJgaZADryOuZVczgaEguO9JRkdUCSn7iLm6TcXTV6AXTSRIG+auBrSYoaZMMIUgEPxOD74LCRV8wQ0/0I7oBZISA+OXdX5iq4KW936KuceRm6uwf0nYhAv3lMRpBQDgbIBHfAJAK2CYC7BJshKjI8A34cYwWYMCJJBwA+6EqcOiCx/Q0rkmwEKRAeYk/7qbiTEuAOK3UEdzDQx5IOHggtqvk0GlRnVqio5A7YzHOHBai5gzkVbDqEMo0RejaikDdW0Hmoubx8Ug4jJBV3mnPu+C24MQE5iyjuCiruQlhPQaO56glR8CSBWugSyBsJ9zfRrUEvxF34pDprlym25OfkhdkhEtueBEGPqyhdyB3WuyTcadFBHyCgqxiJncJeaV4lEV26dtiaAeDBO81U9DQVoEZSxSfHk7oX80TJrIp67fDrPos7cy6c4Lhw0goeItBkjQEyapzhEdTIA2Y4Uky0mXiL5Ypa0xAjnj9PE2AVDPNQqvYBfQdyh2+8UmenUlNHpY8pCBTvEiMxiKtwyBGVWUxL4ZviNaCkBGIE4qJAhxFB0aBricB6ED3wemNKOqldbIuBmsxwIUjKF2yrIBEQsB0G5gFEfrLG5TQU/pSk9pqUimFsTOoU6ugVZHqIK4JR+IU7BEE284JN/BDwI7f2SZl5AD0SxGmjSpoiKGttp5v49iFgD86OEK5wOx266UdlsnaiBitjZR7hidaH6DZ27kAoHynGO3CC+xyVGT+cE4sItYFLkI9lGD8GGI4eDfuhozpzHtWBgJgRF6UsI1QcpUtA/ROS9Tn1DcsmnoQEN99eNOhuogIrKNOOgSYo+REMiNKT3BqURbKHBk1yrF0gFQGgGbR+AAJVc9KqArd7aPjnwGmqkva1jgoZYYKDGC7bQwm2bpDYGKZrcZUEJpdJVgA1QzLdgtx5yidC44GTo3EpwSdFEedHpUsYqM0K2qTEwFgC7ooj1FZ3gSs/UE+1TQHWXrHRNEFDJ5mlBLAPk1pkCqXzWlqDFZmseumxxDA7ie0AMCuk1Ru4NZ00H8KjcHnbZTtssUES19p0PS+YFk4mq8aOdY6jkVLTIdLEEd5U7c+h1PKO7dOeciy1o5pwHIeficTak1LTVmlWPinNSlNt+FEjC1+8rXB1TbfwmqxU8ysvHtYBjSbZlANaT2nhXKgNP+zUlez4r3RvnT0++Q4PWcpSLgnyRXctq7txAH7THGyz0TZFKb5vkWTgUjEO9+yRp5BgbRnbcFDkIpVzZPhJjgF2PGsJ4mqzLh/96syzOOACFKxIkUvtz4sQk5DCB5qEK9nISKnFJvodqBbZ45OYEPJFn0DFI521XgQmQZIWf4iD2ZOsnSaW2UwMjCjMw6wf9njNCEyCFk+rxZY4FlzvnOyGs8HCPH5QCKQ/Kr/EWlbgwsbEOgHRVs+CJWbZHboCHoaY90/qZqqpGmuSmQfxdh226QbDp2dZDsYBIR6xcahjHy8Q5ICF4Xg4enwQsw6myliHWeGF5STbs4DgzkmS6wGtAVQ0oe1goegcj5yNzWpVRzOfvNGkkf3JSroykwB9Amk4akYtHoEfOZ6sFU8gQUkCmgd1K1xkjw2dlpfTfMpEtFWHXTC58kn5LckWdbJbIYchTEkJzB6gPQlANGmDLawncDTfIueDkgadhFQcbLYXz8o9mWSX1jYeIrr24eLpPfrwFPm79fR2fpQstRtDxeNRNW6dWWM44YHuuNjDxWOiR8bKnTEc9jhF3a1fyt5M9ZbuInbLoO2dfG8xnVghPQohgk6vR3GwQQqqbkYbWTkCVZjpTic0QIFHY3SGasEQXgqIBbYQ5nbOO9z5Sp0C3ijCq638lEdXrJKKGfhx2u6eHf0ctXgIL0s6Uel430M3lfKkKkwAXF+a1YwgsHZsiyEaZMW2h11JhDN4VtFWzWGE9DzcfYtaPISXmT+54qblQLYQ81UnRkThzr1cDmQ9EBqvwjYZopmUMkSykZ8ibrtC6LPpptm4qQTU6A+axB2dotok2Zmz6Tvkjvo8fJ6QLM/QNFTHJGnBsY1h8COcNYIEN7WjP80VpeIt9f8kn6JBRdL5bnRYOWMyoMdvzxF7TSEM3XYubn2JJjQch+2pR7KpS2v4w6QH5pHJkcXpbj/3cj13mU5tojuzyUxRV1a1aewSHprHXk62ZyCbg86AGXYINvkoCwwo2RkATxdJDpKRcJerFHYPeJOavo/q/EpAS3RiuE1PcHik4ir6ELZHytGzXRWPIzcEDUZDOMaM5lWQK0dpFN2Rg+WqJ9jB6Yy7ywsjSjohCzpf758nzXvNTgu4CtwC0ipb1WdUWclPqgKSmZ/fDotdzH9+O7L3+pv0m2wuv8pDFTe7qMNU8/TbcDY+dcvfSgdSzTol4/miTqzrr+vKI1XzNCqw74hJyNu7L1/u1DPu6OlBYhcBIxujRQBNSClZs849xS8RTS/BreTM2IJVi9551dx44zo8qFIUFmnHJKcikElIHw2bbVLKiR+admW2Gp3NcOTTcNts5QiVAyqfDqG0paMVoqnVo8ok9rllDM6hJ9PH59gkIc6eLVbZIqnLaHhouKid6XUqBWYKRf3ipowMqdHd19qr+MTVr+/e/cr/WumxMqotFlkevHYxJZClX/91//Xr/S+cP/OWY0lLsiH1R6Z39/fXPt3fv2MfSYfDubVp9mW5vKh8fWDOpzecPWkWTPPDjuwq4fnSb1+vn+irhL2pLFD1+VukOkvrxej3+xN31/d/8M+3chRpCNvLFYxkQ4A5Xzgl7FVu5WkizRFilcdBP1kS4u76zZ/8inJXlUbRXDH+sfn7i7D3m+SajjoMN160RyCW/vx6jdn7h+Qi01NH4Zc3leZIxX/jxbv++i/ZZYO6Kkl7wY66Z6B3ZPGuv/4ugWVX5ZFKPJMf//kS9J83hL37a4nj86OGrjzLl8sJadnRb5S9668y2+I7B0/IBi7/4MDzH4y9NxJQHVBlynJEl+4azZ84e/dfJZ4voOJmLPDRfS/YV5WQ/svYkzr2R2pM9+I0yt2RHZTzo9GfnL2v/1NffrOZ6Y+5r6hc4I9Df9zfU+7kpuVElc5muvmhMkkR9L/fieO7/+WlHylT+scbtHz3f730A2VLf/wbLt+9DHH+nakMl08W7P3N6d1fT/x9/f+ldkf6z+8Bf/dv/vob+LFz6I9frq//UvryfOn/ANxr1abNW9KEAAAAAElFTkSuQmCC" alt="">  UAE PASS</button>
              
            </div>

            <div id="ForgotDiv">

                <a id="forgot">Forgot password? </a>
            </div>

            </form>




        </div>


    </div>





    
</body>
</html>