<?php
    include 'autoload.inc.php';

    if (isset($_POST['print'])) {
        $id = $_POST['id'];
        $change = $_POST['change'];
        $payment = $_POST['payment'];
        $total = $_POST['total'];
        $discounts = $_POST['discounts'];
            
        $changeNumeric = floatval(preg_replace('/[^\d.]/', '', $change));
        $paymentNumeric = floatval(preg_replace('/[^\d.]/', '', $payment));
        $totalNumeric = floatval(preg_replace('/[^\d.]/', '', $total));
        
        $discountsArr = explode(",",$discounts);

        $receipt = new TransactionsView();
        $receipt->initReceipt($id, $changeNumeric, $paymentNumeric, $totalNumeric, $discountsArr);
    }
    else{
        header("location: ..index.php");
    }
?>