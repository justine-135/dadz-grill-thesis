<?php

class TableContr extends Table{
    public function initTableTimer(){
        for ($i=0; $i < 8; $i++) { 
            $this->updateTableTimer($i);
        }
    }   

    public function initAttended($tblId){
        $this->setAttended($tblId);
    }

    public function initRequest($tblId){
        $this->setRequest($tblId);
    }

    public function initClean($tblId){
        $this->setClean($tblId);
    }
}
?>