<?php
    include 'autoload.inc.php';

    if (isset($_POST["purchase"])) {
        $names = $_POST['names'];
        $tableId = $_POST['table-id'];
        $total = $_POST['total'];
        $waiter = $_POST['waiter-name'];
        $qty = $_POST['quantities'];
        $prc = $_POST['prices'];
        $uid = $_POST["uid"];
        $item_id = $_POST["item_id"];
        $orgPrc = $_POST["orig_price"];

        $purchase = new PurchaseContr();
        $purchase->initPurchase($names, $tableId, $orgPrc, $total, $waiter, $qty, $prc, $uid, $item_id);
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
    }
?>