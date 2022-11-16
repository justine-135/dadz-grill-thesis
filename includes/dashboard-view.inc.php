<?php
    include 'autoload.inc.php';

    if (isset($_GET["grid"])) {
        $grid = $_GET["grid"];

        if ($grid == 1) {
            if (isset($_GET["date"]) && isset($_GET["date2"])) {
                $date = $_GET['date'];
                $date2 = $_GET['date2'];
                $order = new DashboardView();
                $order->initSales($date, $date2);
            }
        }

        if ($grid == 2) {
            if (isset($_GET["date"]) && isset($_GET["date2"])) {
                $date = $_GET['date'];
                $date2 = $_GET['date2'];
                $order = new DashboardView();
                $order->initOrders($date, $date2);
            }
        }

        if ($grid == 3) {
            if (isset($_GET["date"]) && isset($_GET["date2"])) {
                $date = $_GET['date'];
                $date2 = $_GET['date2'];
                $order = new DashboardView();
                $order->initCancels($date, $date2);
            }
        }

        if ($grid == 4) {
            if (isset($_GET["date"]) && isset($_GET["date2"])) {
                $date = $_GET['date'];
                $date2 = $_GET['date2'];
                $order = new DashboardView();
                $order->initSuccess($date, $date2);
            }
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

        if ($grid == 9) {
            $dirty = new DashboardView();
            $dirty->initCrew();
        }

        if ($grid == 10) {
            $dirty = new DashboardView();
            $dirty->initActiveCrew();
        }

        // if ($grid == 11) {
        //     $dirty = new DashboardView();
        //     $dirty->initTotalServed();
        // }
        
        if ($grid == 12) {
            $dirty = new DashboardView();
            $dirty->initCrewRole();
        }

        if ($grid == 11) {
            if (isset($_GET["date"]) && isset($_GET["date2"])) {
                $date = $_GET['date'];
                $date2 = $_GET['date2'];
                $served = new DashboardView();
                $served->initTotalServed($date, $date2);
            }
        }
    }

    if (isset($_GET["sample"])) {
        $allServed = new DashboardView();
        $allServed->initTotalServedAll();
    }
?>