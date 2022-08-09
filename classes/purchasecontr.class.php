<?php

class PurchaseContr extends Purchase{
    public function initPurchase($names, $tableId, $total, $waiter, $qty, $prc){
        $this->setPurchase($names, $tableId, $total, $waiter, $qty, $prc);
        header("location: ../menu.php");
    }

    public function initFinish($id){
        $this->setFinish($id);
        header("location: ../sales.php");

    }
}

?>