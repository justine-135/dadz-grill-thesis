<?php

class Table extends Dbh{
    protected function getTables(){
        $sql = "SELECT * FROM tables";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function updateTableTimer($i){
        $sql = "SELECT is_started FROM tables WHERE id = $i";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
    
        $result = $stmt->fetchAll();
        $increment = 1;
        if ($result > 0){
            foreach ($result as $row) {
                $started = $row["is_started"];
                if ($started == 1) {
                    $sql = "UPDATE tables SET timer = timer + $increment WHERE id = $i";
                    $stmt = $this->connection()->prepare($sql);
                    $stmt->execute();                
                }
            }
        }
    }

    protected function has_order_attended($id){
        $sql = "UPDATE tables SET table_status = 'Occupied', payment = 'Pending', order_status = 'Done' WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();     
        $stmt = null;   
        
        $sql = "UPDATE tables SET is_started = true WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();        
        $stmt = null;
        
        header("location: ../menu.php?alert=has_order&id=" . $id);
    }

    protected function has_order_request($id){
        $sql = "UPDATE tables SET payment = 'Requesting', is_started = false WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();     

        header("location: ../menu.php");
    }

    protected function no_order($id){
        header("location: ../menu.php?alert=no_order&id=" .$id);
    }

    protected function setAttended($tblId){
        $tblStatus;
        $timerStarted;

        $sql = "SELECT order_status, is_started FROM tables WHERE id = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $tblStatus = $row["order_status"];
        }
        
        if ($tblStatus == "Pick-up" || $tblStatus == "Done") {
            $this->has_order_attended($tblId);
        }
        else{
            $this->no_order($tblId);
        }
    }

    protected function setRequest($tblId){
        $sql = "SELECT order_status, is_started FROM tables WHERE id = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $tblStatus = $row["order_status"];
        }
        
        if ($tblStatus != "No order") {
            $this->has_order_request($tblId);
        }
        else{
            $this->no_order($tblId);
        }
    }
}

?>