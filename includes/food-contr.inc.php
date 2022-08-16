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

    if (isset($_POST["update"])) {
        $name = ucfirst($_POST['name']);
        $group = ucfirst($_POST['group']);
        $cost = $_POST['cost'];
        $cost = (int)$cost;
        $stats = ucfirst($_POST['stats']);
        $fid = $_POST['upd-ing-id'];

        $foodItem = new FoodContr($name, $group, $cost, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $fid, $img);
        $foodItem->initUpdateFood();
    }

    if (isset($_POST["delete"])) {
        $fid = $_POST['id-value'];
        $img = $_POST['img-value'];
        $img = '.'.$img;

        $foodItem = new FoodContr($name, $group, $cost, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $fid, $img);
        $foodItem->initDeleteFood();
    }

    exit();
