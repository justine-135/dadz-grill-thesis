<?php
    session_start();
    if (empty($_SESSION["username"])) {
        header("location: login.php?message=");
    }

    if ($_SESSION["is_superuser"] == 1) {
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
    <title>Registration</title>
</head>
<body>
    <div class="registration-bg flex-row">
        <form action="./includes/user-contr.inc.php" class="modal-register flex-row" method="post" enctype="multipart/form-data">
            <div class="head">
                <h1>Account Registration</h1>
                <p>Create an admin account.</p>
                <p>Click <a href="admins.php">here</a> to go back.</p>
            </div>
            <div class="body flex-column">
                <div class="admin-info flex-row">
                    <div class="register-input flex-column">
                        <span>First name</span>
                        <input type="text" name="fname" id="" required>
                    </div>
                    <div class="register-input flex-column">
                        <span>Last name</span>
                        <input type="text" name="lname" id="" required>
                    </div>
                    <div class="register-input flex-column">
                        <span>Email</span>
                        <input type="text" name="email" id="" placeholder="sample@gmail.com" required>
                    </div>
                </div>
                <div class="admin-contacts flex-row">
                    <div class="register-input flex-column">
                        <span>Contact</span>
                        <input type="text" name="contact" id="" placeholder="09XXXXXXXXX" required>
                    </div>
                    <div class="register-input flex-column">
                        <span>Birth date</span>
                        <input type="date" name="bdate" id="" required>
                    </div>
                    <div class="register-input flex-column">
                        <span>Address</span>
                        <input type="text" name="address" id="" required>
                    </div>
                </div>
                <div class="admin-userpass flex-row">
                    <div class="register-input flex-column">
                        <span>Username</span>
                        <input type="text" name="uname" id="" required>
                    </div>
                    <div class="register-input flex-column">
                        <span>Password</span>
                        <input type="password" name="pwd" id="" required>
                    </div>
                    <div class="register-input flex-column">
                        <span>Confirm Password</span>
                        <input type="password" name="cpwd" id="" required>
                    </div>
                </div>
                <div class="admin-usertype flex-row">
                    <div class="register-input flex-column">
                            <span>Usertype</span>
                            <select name="usertype" id="">
                                <option value="cashier">Cashier</option>
                                <option value="waiter">Waiter</option>
                                <option value="cook">Cook</option>
                                <option value="cleaner">Cleaner</option>
                            </select>
                        </div>
                    </div>
                <div class="admin-create flex-column">
                    <input class="create-account-btn" name="register" type="submit" value="Create account">
                    <?php
                        if (isset($_GET['message'])) {
                            if ($_GET["message"] == "emptyinput") {
                                echo"<p class='err-text-register'>Fill up all inputs!</p>";
                            }
                            elseif ($_GET["message"] == "invaliduser") {
                                echo"<p class='err-text-register'>Invalid user.</p>";
                            }
                            elseif ($_GET["message"] == "invalidcontact") {
                                echo"<p class='err-text-register'>Invalid contact format.</p>";
                            }
                            elseif ($_GET["message"] == "invalidemail") {
                                echo"<p class='err-text-register'>Invalid email.</p>";
                            }
                            elseif ($_GET["message"] == "passwordmatch") {
                                echo"<p class='err-text-register'>Password don't match.</p>";
                            }
                            elseif ($_GET["message"] == "userexist") {
                                echo"<p class='err-text-register'>User already registered.</p>";
                            }
                            elseif ($_GET["message"] == "processfailed") {
                                echo"<p class='err-text-register'>Something went wrong, try again.</p>";
                            }
                        }
                    ?>
                </div>
            </div>
        </form>
    </div>

    <script src="./js/registration.js?v=<?php echo time(); ?>"></script>
</body>
</html>
<?php } else {
    header("location: admins.php");
}
?>