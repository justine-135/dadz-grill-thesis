<?php

class Dashboard extends Dbh{
    protected function getTransactions(){
        $sql = "SELECT * FROM transactions;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getOrders(){
        $sql = "SELECT * FROM transactions;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->rowCount();
        return $results;
    }

    protected function getTables(){
        $sql = "SELECT * FROM tables;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }
}

?>