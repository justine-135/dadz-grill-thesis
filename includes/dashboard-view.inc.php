<?php
    include 'autoload.inc.php';

    if (isset($_GET["grid"])) {
        $grid = $_GET["grid"];

        if ($grid == 1) {
            $order = new DashboardView();
            $order->initSales();
        }

        if ($grid == 2) {
            $order = new DashboardView();
            $order->initOrders();
        }

        if ($grid == 3) {
            $order = new DashboardView();
            $order->initCancels();
        }

        if ($grid == 4) {
            $order = new DashboardView();
            $order->initSuccess();
        }

        if ($grid == 5) {
            $occupied = new DashboardView();
            $occupied->initOccupied();
        }

        if ($grid == 6) {
            $unoccupied = new DashboardView();
            $unoccupied->initUnoccupied();
        }

        if ($grid == 7) {
            $call = new DashboardView();
            $call->initCall();
        }

        if ($grid == 8) {
            $dirty = new DashboardView();
            $dirty->initDirty();
        }
    }
?>