<?php
    include 'autoload.inc.php';

    $name;
    $group;
    $cost;
    $stats;
    $file;
    $fileName;
    $fileTempLoc;
    $fileType;
    $fileError;
    $fileSize;
    $fileNameTime;
    $target;
    $fileExt;
    $fileActualExt;
    $allowed;
    $fid;
    $img;

    session_start();
    $userName = $_SESSION["username"];
    $checkTime = time() - $_SESSION["last_login_timestamp"];
    if ($checkTime > 3600) {
        $logoutUser = new UserContr($userName, $pass, $confirmPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, $userType);
        $logoutUser->initLogoutUser();
    }
    else{
        if (isset($_POST["insert"])) {
            $name = ucfirst($_POST['name']);
            $group = ucfirst($_POST['group']);
            $cost = $_POST['cost'];
            $cost = (int)$cost;
            $stats = ucfirst($_POST['stats']);
        
            $file = $_FILES['photo'];
            $fileName = $file['name'];
            $fileTempLoc = $file['tmp_name'];
            $fileType = $file['type'];
            $fileError = $file['error'];
            $fileSize = $file['size'];
            $fileNameTime = time().''.$fileName;
        
            $target = '../img/temp/'. $fileNameTime;
        
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
        
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            $fid = $_POST['upd-ing-id'];
    
            $foodItem = new FoodContr($name, $group, $cost, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $fid, $img);
            $foodItem->initSetFood();
        }
    
        elseif (isset($_POST["update"])) {
            $name = ucfirst($_POST['name']);
            $group = ucfirst($_POST['group']);
            $cost = $_POST['cost'];
            $cost = (int)$cost;
            $stats = ucfirst($_POST['stats']);
            $fid = $_POST['upd-ing-id'];
    
            $foodItem = new FoodContr($name, $group, $cost, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $fid, $img);
            $foodItem->initUpdateFood();
        }
    
        elseif (isset($_POST["delete"])) {
            $fid = $_POST['id-value'];
            $img = $_POST['img-value'];
            $img = '.'.$img;
    
            $foodItem = new FoodContr($name, $group, $cost, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $fid, $img);
            $foodItem->initDeleteFood();
        }
    
        else{
            header("location: ../foods.php");
        }
    }
    
    exit();
