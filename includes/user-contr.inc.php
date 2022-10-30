<?php
    include 'autoload.inc.php';

    $userName="";
    $pass="";
    $confirmPass="";
    $fname="";
    $lname="";
    $fullName="";
    $email="";
    $contact="";
    $bDate="";
    $address="";
    $userType="";

    if (isset($_POST["register"])) {
        $fname = strtoupper($_POST['fname']);
        $lname = strtoupper($_POST['lname']);
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $bDate = $_POST['bdate'];
        $address = $_POST['address'];
        $userName = $_POST['uname'];
        $pass = $_POST['pwd'];
        $confirmPass = $_POST['cpwd'];
        $userType = $_POST['usertype'];
        $fullName = $fname." ".$lname;

        $userCheck = new UserContr($userName, $pass, $confirmPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, $userType);
        $userCheck->initUser();
    }

    if (isset($_POST["logout"])) {
        session_start();
        $userName = $_SESSION["username"];

        $logoutUser = new UserContr($userName, $pass, $confirmPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, $userType);
        $logoutUser->initLogoutUser();
    }

    if (isset($_POST["login"])) {
        $userName = $_POST["username"];
        $pass = $_POST["pass"];

        $loginUser = new UserContr($userName, $pass, $confirmPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, $userType);
        $loginUser->initLoginUser();
    }

    if (isset($_POST["curr_time"])) {
        session_start();
        $userName = $_SESSION["username"];
        $checkTime = time() - $_SESSION["last_login_timestamp"];
        echo $checkTime;
        if ($checkTime > 3600) {
            $logoutUser = new UserContr($userName, $pass, $confirmPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, $userType);
            $logoutUser->initLogoutUser();
        }
    }
?>