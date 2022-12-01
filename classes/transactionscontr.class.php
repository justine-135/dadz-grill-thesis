<?php

class TransactionsContr extends Transactions{
    public function initBillout($id){
        $this->setTransactions($id);
    }

    public function initPaid($id, $tbl){
        $this->setPaid($id, $tbl);
    }

    
    public function initUnoccupy($tblId){
        $this->setUnoccupied($tblId);
    }
    
}

?>