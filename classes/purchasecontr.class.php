<?php

class PurchaseContr extends Purchase
{
    public function initPurchase($names, $tableId, $orgPrc, $total, $waiter, $qty, $prc, $uid, $item_id, $servings)
    {
        $this->setPurchase($names, $tableId, $orgPrc, $total, $waiter, $qty, $prc, $uid, $item_id, $servings);
        header("location: ../menu.php?alert=order_done&id=" . $tableId);
        exit();
    }

    public function initFinish($oid, $tid)
    {
        $this->setFinish($oid, $tid);
        header("location: ../sales.php?alert=order_finish&id=" . $oid);
        exit();
    }

    public function initCancel($oid, $tid)
    {
        $this->setCancel($oid, $tid);
        header("location: ../sales.php?alert=order_cancel&id=" . $oid);
        exit();
    }
}
