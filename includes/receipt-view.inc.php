<?php
    include 'autoload.inc.php';

    if (isset($_POST['print'])) {
        $id = $_POST['id'];
        $change = $_POST['change'];
        $payment = $_POST['payment'];
        $total = $_POST['total'];
            
        $changeNumeric = floatval(preg_replace('/[^\d.]/', '', $change));
        $paymentNumeric = floatval(preg_replace('/[^\d.]/', '', $payment));
        $totalNumeric = floatval(preg_replace('/[^\d.]/', '', $total));
        
        $receipt = new TransactionsView();
        $receipt->initReceipt($id, $changeNumeric, $paymentNumeric, $totalNumeric);
    }
    else{
        header("location: ..index.php");
    }
?>