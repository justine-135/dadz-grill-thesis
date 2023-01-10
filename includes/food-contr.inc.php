<?php
    include 'autoload.inc.php';

    $name = "";
    $group = "";
    $cost = 0;
    $grams = 0;
    $servings = 0;
    $serving = "";
    $stats = "";
    $file = "";
    $fileName = "";
    $fileTempLoc = "";
    $fileType = "";
    $fileError = "";
    $fileSize = "";
    $fileNameTime = "";
    $target = "";
    $fileExt = "";
    $fileActualExt = "";
    $allowed = "";
    $fid = "";
    $img = "";
    $inclusions = "";
    $inclusions_name = "";

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
            $cost = (float)$cost;
            $grams = $_POST['grams'];
            $grams = (float)$grams;
            $servings = $_POST['servings'];
            $serving = $_POST['serving'];
            $stats = ucfirst($_POST['stats']);
            $inclusions_name = $_POST['inclusion_name'];
            
            if (isset($_POST['inclusions'])) {
                $inclusions = $_POST['inclusions'];
            }
        
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
            $fid = 0;
            $img = null;

            // foreach ($serving as $s) {
            //     if (strlen($s) < 0) {
            //         header("location: ../foods.php?alert=store_no&id=0");
            //         exit();
            //         echo "dont store food";
            //     }
            //     else{
            //         echo "Storefood";
            //     }
            // }
    
            $foodItem = new FoodContr($name, $group, $cost, $grams, $servings, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $fid, $img, $inclusions, $serving, $inclusions_name);
            $foodItem->initSetFood();
        }
    
        elseif (isset($_POST["update"])) {
            $name = ucfirst($_POST['name']);
            $group = ucfirst($_POST['group']);
            $cost = $_POST['cost'];
            $cost = (float)$cost;
            $grams = $_POST['grams'];
            $grams = (float)$grams;
            $servings = $_POST['servings'];
            $servings = (float)$servings;
            $stats = ucfirst($_POST['stats']);
            $fid = $_POST['upd-ing-id'];
    
            $foodItem = new FoodContr($name, $group, $cost, $grams, $servings, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $fid, $img, $inclusions, $serving, $inclusions_name);
            $foodItem->initUpdateFood();
        }
    
        elseif (isset($_POST["delete"])) {
            $fid = $_POST['id-value'];
            $img = $_POST['img-value'];
            $img = '.'.$img;
    
            $foodItem = new FoodContr($name, $group, $cost, $grams, $servings, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $fid, $img, $inclusions, $serving, $inclusions_name);
            $foodItem->initDeleteFood();
        }
    
        else{
            header("location: ../foods.php");
        }
    }
    
    exit();
