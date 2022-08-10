<?php
    include 'autoload.inc.php';

    if (isset($_GET["grid"])) {
        $grid = $_GET["grid"];

        if ($grid == 1) {
            $order = new DashboardView();
            $order->initSales();
        }
    }

    if (isset($_GET["grid"])) {
        $grid = $_GET["grid"];

        if ($grid == 2) {
            $order = new DashboardView();
            $order->initOrders();
        }
    }
?>