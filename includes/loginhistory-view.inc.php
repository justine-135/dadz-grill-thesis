<?php
    include 'autoload.inc.php';
    
    if (isset($_GET["view"])) {
        $view = $_GET["view"];

        if ($view == 1) {
            $loginHistory = new UsersView();
            $loginHistory->initGetHistory();
        }

        if ($view == 2) {
            $date = $_GET["date"];
            $loginHistory = new UsersView();
            $loginHistory->initGetHistoryDate($date);
        }
    }
?>
