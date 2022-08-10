<?php

class Dashboard extends Dbh{
    protected function getSales(){
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
}

?>