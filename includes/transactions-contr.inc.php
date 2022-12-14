<?php
    include 'autoload.inc.php';

    session_start();
    $userName = $_SESSION["username"];
    $checkTime = time() - $_SESSION["last_login_timestamp"];
    if ($checkTime > 3600) {
        $logoutUser = new UserContr($userName, $pass, $confirmPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, $userType);
        $logoutUser->initLogoutUser();
    }
    else{
        if (isset($_POST["bill"])) {
            $id = $_POST["id"];
            
            $billout = new TransactionsContr();
            $billout->initBillout($id);
        }   
        
        elseif (isset($_POST["process"])) {
            $id = $_POST["id"];
    
            session_start();
            $_SESSION["bill_id"] = $id;
            echo $_SESSION["bill_id"];
            header("location: ../bill.php");
        }  
    
        elseif (isset($_POST["save"])) {
            $id = $_POST["id"];
            $tbl = $_POST["table_id"];
            $discounted = $_POST['discounted'];
            $discountedArr = $_POST['discountedArr'];
            
            $paid = new TransactionsContr();
            $paid->initPaid($id, $tbl, $discounted, $discountedArr);
            // header("location: ../index.php");
            // echo $discounted;
    
        }
    
        else{
            header("location: ../transactions.php");
        }
    }

   

?>