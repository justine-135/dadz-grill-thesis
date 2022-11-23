<?php

class TableContr extends Table{
    // public function initTableTimer(){
    //     for ($i=0; $i < 9; $i++) { 
    //         $this->updateTableTimer($i);
    //     }
    // }   

    public function initAttended($tblId){
        $this->setAttended($tblId);
    }

    public function initRequest($tblId){
        $this->setRequest($tblId);
    }

    public function initClean($tblId){
        $this->setClean($tblId);
    }

    public function initMenu($tblId){
        $this->openMenu($tblId);
    }

    public function initOccupy($tblId){
        $this->setOccupy($tblId);
    }

    public function initUnoccupy($tblId){
        $this->setUnoccupy($tblId);
    }
    
    public function initCall($tblId){
        $this->setCall($tblId);
    }

    public function initNotify($id){
        $this->setNotify($id);
    }

    public function initStopTableTimer($id){
        $this->setStopTimer($id);
    }


    public function initGetId($id){
        $results = $this->setGetId($id);
        foreach ($results as $row) {
            if ($row['table_status'] == 'Occupied') {
                echo "0";
            }
            elseif($row['table_status'] == 'Unoccupied'){
                echo "1";
            }
            elseif($row['table_status'] == 'Call'){
                echo "2";
            }
            else{
                echo "3";
            }
        }
    }

    public function initCounter($counter){
        echo $counter;
    }
}
?>