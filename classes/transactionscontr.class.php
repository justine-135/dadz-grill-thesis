<?php

class TransactionsContr extends Transactions{
    public function initBillout($id){
        $this->setTransactions($id);
    }

    public function initPaid($id, $tbl, $discounted, $discountedArr){
        $this->setPaid($id, $tbl, $discounted, $discountedArr);
    }

    
    public function initUnoccupy($tblId){
        $this->setUnoccupied($tblId);
    }
    
}

?>