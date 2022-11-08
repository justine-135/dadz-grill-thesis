<?php

    include 'autoload.inc.php';

    if (isset($_GET['view'])) {
        $view = $_GET['view'];
        if ($view == 1) {
            $transactionsView = new TransactionsView();
            $transactionsView->initTransactions();
        }

        if ($view == 2) {
            $id = $_GET['id'];

            $billView = new TransactionsView();
            $billView->initInvoice($id);
        }

        if ($view == 3) {

            $billView = new TransactionsView();
            $billView->exportTransactions();
        }

        if ($view == 5) {
            $date = $_GET['date'];
            $billView = new TransactionsView();
            $billView->initTransactionsDate($date);
        }

        if ($view == 6) {
            $date = $_GET['date'];
            $billView = new TransactionsView();
            $billView->exportTransactionsDate($date);
        }
    }

    elseif (isset($_POST["print"])) {
        $id = $_POST['id'];
        $change = $_POST['change'];
        $payment = $_POST['payment'];
        $total = $_POST['total'];

        if (empty($change) || empty($payment) || empty($total)) {
            header("location: ../bill.php?id=".$id);
        }
        else{
            $changeNumeric = floatval(preg_replace('/[^\d.]/', '', $change));
            $paymentNumeric = floatval(preg_replace('/[^\d.]/', '', $payment));
            $totalNumeric = floatval(preg_replace('/[^\d.]/', '', $total));

            if ($paymentNumeric > $totalNumeric) {
                $receipt = new TransactionsView();
                $receipt->initReceipt($id, $changeNumeric, $paymentNumeric, $totalNumeric);
            }
            else{
                header("location: ../bill.php?id=".$id);
            }
        }        
    }

    else {
        header("location: ../index.php");
    }
    
    
?>