<?php

class PurchaseContr extends Purchase{
    public function initPurchase($names, $tableId, $total, $waiter, $qty, $prc, $uid){
        $this->setPurchase($names, $tableId, $total, $waiter, $qty, $prc, $uid);
        header("location: ../menu.php");
    }

    public function initFinish($oid, $tid){
        $this->setFinish($oid, $tid);
        header("location: ../sales.php");
    }

    public function initCancel($oid, $tid){
        $this->setCancel($oid, $tid);
        header("location: ../sales.php");
    }
}

?>