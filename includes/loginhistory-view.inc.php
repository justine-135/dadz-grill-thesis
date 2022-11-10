<?php
    include 'autoload.inc.php';
    
    if (isset($_GET["view"])) {
        $view = $_GET["view"];

        if ($view == 1) {
            $loginHistory = new UsersView();
            $loginHistory->initGetHistory();
        }

        if ($view == 2) {
            if (isset($_GET["date"]) && isset($_GET["date2"])) {
                $date = $_GET["date"];
                $date2 = $_GET["date2"];
                $loginHistory = new UsersView();
                $loginHistory->initGetHistoryDate($date, $date2);
            }
        }
    }
?>
