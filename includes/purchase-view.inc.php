<?php
    include 'autoload.inc.php';

    if (isset($_GET["view"])) {
        $view = $_GET["view"];

        if ($view == 1) {
            $purchasesView = new PurchaseView();
            $purchasesView->initGetPurchases();
        }
    }

    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        $purchaseView = new PurchaseView();
        $purchaseView->initGetPurchase($id);
    }

?>