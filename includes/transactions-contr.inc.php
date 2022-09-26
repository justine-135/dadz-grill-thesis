<?php
    include 'autoload.inc.php';

    if (isset($_POST["bill"])) {
        $id = $_POST["id"];
        
        $billout = new TransactionsContr();
        $billout->initBillout($id);
    }   

    elseif (isset($_POST["paid"])) {
        $id = $_POST["id"];
        $tbl = $_POST["table"];

        $paid = new TransactionsContr();
        $paid->initPaid($id, $tbl);
    }   

    else{
        header("location: ../transactions.php");
    }

?>