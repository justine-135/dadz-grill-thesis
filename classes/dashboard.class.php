<?php

class Dashboard extends Dbh{
    protected function getTransactions($date, $date2){
        // echo $date . " " . $date2;
        if (empty($date) || empty($date2)) {
            $sql = "SELECT * FROM transactions;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
            return $results;
        }
        else{
            $sql = "SELECT * FROM transactions WHERE DATE(reg_date) BETWEEN '$date' AND '$date2'";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
            return $results;
        }

    }

    protected function getOrders($date, $date2){

        if (empty($date) || empty($date2)) {
            $sql = "SELECT * FROM transactions;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->rowCount();
            return $results;
        }
        else{
            $sql = "SELECT * FROM transactions WHERE DATE(reg_date) BETWEEN '$date' AND '$date2'";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->rowCount();
            return $results;
        }

    }

    protected function getTables(){
        $sql = "SELECT * FROM tables;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getCrews(){
        $sql = "SELECT * FROM users;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getTotalServed(){
        session_start();
        $id = $_SESSION["uid"];
        $sql = "SELECT * FROM users WHERE id = '$id';";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }
}

?>