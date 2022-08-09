<?php
    include 'autoload.inc.php';

    if (isset($_GET["id"])) {
        $oid = $_GET['id'];

        $order = new OrdersView();
        $order->initGetOrder($oid);
    }

?>