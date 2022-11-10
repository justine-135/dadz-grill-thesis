<?php

include 'autoload.inc.php';

if (isset($_GET["view"])) {
    $view = $_GET["view"];
    if ($view == 1) {

        $salesReport = new SalesView();
        $salesReport->initSalesReport();
    }

    if ($view == 2) {
        $date = $_GET["date"];
        $date2 = $_GET["date2"];
        $salesReport = new SalesView();
        $salesReport->initSalesReportDate($date, $date2);
    }
}
