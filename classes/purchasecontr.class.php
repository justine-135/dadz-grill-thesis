<?php

class PurchaseContr extends Purchase{
    public function initPurchase($names, $tableId, $total, $waiter, $qty, $prc){
        $this->setPurchase($names, $tableId, $total, $waiter, $qty, $prc);
        header("location: ../menu.php");
    }

    public function initFinish($oid, $tid){
        $this->setFinish($oid, $tid);
        header("location: ../sales.php");
    }

    public function initCancel($id){
        $this->setCancel($id);
        header("location: ../sales.php");
    }
}

?>