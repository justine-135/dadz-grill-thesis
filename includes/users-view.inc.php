<?php
    include 'autoload.inc.php';
    
    if (isset($_GET["view"])) {
        $view = $_GET["view"];
        if ($view == 1) {
            $allUser = new UsersView();
            $allUser->initGetUsers();
        }
        if ($view == 2) {
            $date = $_GET["date"];
            $date2 = $_GET["date2"];
            $userCompliance = new UsersView();
            $userCompliance->initUserCompliance($date, $date2);
        }
    }
?>
