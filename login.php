<?php
    session_start();
    if (!empty($_SESSION["username"])) {
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/styles.css">
    <title>Login</title>
</head>
<body>
    <form class="login-form" action="./includes/user-contr.inc.php" method="post" enctype="multipart/form-data">
        <div class="head">
            <h1>Member Login</h1>
            <p>Dad'z Grill House admin login form.</p>
        </div>
        <div class="body">
            <div class="login">
                <h2>Sign In</h2>
                <div class="login-input flex-column">
                    <span>Username</span>
                    <input type="text" name="username" id="">
                </div>
                <div class="login-input flex-column">
                    <span>Password</span>
                    <input type="password" name="pass" id="">
                </div>
                <input type="submit" name="login" value="Submit">
                <?php
                    if ($_GET["message"] == "emptyinput") {
                        echo"<p class='err-text-register err-text-login'>Fill up all inputs!</p>";
                    }
                    elseif ($_GET["message"] == "invalidlogin") {
                        echo"<p class='err-text-register err-text-login'>Invalid user.</p>";
                    }
                    else{
                        echo"<p class='err-text-register err-text-login'></p>";
                    }
                ?>
            </div>
        </div>
    </form>
</body>
</html>