<?php
    include 'autoload.inc.php';

    if (isset($_POST["bill"])) {
        $id = $_POST["id"];
        
        $billout = new TransactionsContr();
        $billout->initBillout($id);
    }   
    
    elseif (isset($_POST["process"])) {
        $id = $_POST["id"];
        header("location: ../bill.php?id=".$id);
    }  

    elseif (isset($_POST["save"])) {
        $id = $_POST["id"];
        $tbl = $_POST["table_id"];
        
        $paid = new TransactionsContr();
        $paid->initPaid($id, $tbl);
        // header("location: ../index.php");

    }

    else{
        header("location: ../transactions.php");
    }

?>