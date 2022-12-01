<?php
    include 'autoload.inc.php';
    
    if (isset($_GET["user"])) {
        $user = $_GET["user"];
        if ($user == 1) {
            $cashierTable = new TableView();
            $cashierTable->initTableCa();
        }
        if ($user == 2) {
            $waiterTable = new TableView();
            $waiterTable->initTableWa();
        }
        if ($user == 3) {
            $cashierTable = new TableView();
            $cashierTable->initTableCl();
        }
        if($user == 4){
            $cashierTable = new TableView();
            $cashierTable->initTableCl();
        }
        if($user == 5){
            $cashierTable = new TableView();
            $cashierTable->initTableSetting();
        }
        if($user == 6){
            $cashierTable = new TableView();
            $cashierTable->initTableNumbers();
        }
    }
?>