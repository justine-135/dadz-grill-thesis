<?php
    include 'autoload.inc.php';

    if (isset($_POST["purchase"])) {
        $names = $_POST['names'];
        $tableId = $_POST['table-id'];
        $total = $_POST['total'];
        $waiter = $_POST['waiter-name'];
        $qty = $_POST['quantities'];
        $prc = $_POST['prices'];

        $purchase = new PurchaseContr();
        $purchase->initPurchase($names, $tableId, $total, $waiter, $qty, $prc);
    }

    if (isset($_POST["finish"])) {
        $oid = $_POST['order-num'];
        $tid = $_POST['table-order'];

        $finish = new PurchaseContr();
        $finish->initFinish($oid, $tid);
    }

    if (isset($_POST["cancel"])) {
        $oid = $_POST['order-num2'];
        $tid = $_POST['table-order2'];

        $cancel = new PurchaseContr();
        $cancel->initCancel($oid, $tid);
        echo $id;
    }

?>