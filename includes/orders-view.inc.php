<?php
    include 'autoload.inc.php';

    if (isset($_GET["id"])) {
        $oid = $_GET['id'];
        $view = $_GET["view"];

        if ($view == 1) {
            $order = new OrdersView();
            $order->initGetOrder($oid);
        }
        
        if ($view == 2) {
            $order = new OrdersView();
            $order->initGetOrderAttend($oid);
        }

        if ($view == 3) {
            $order = new OrdersView();
            $order->initPendingOrders($oid);
        }
    }
?>