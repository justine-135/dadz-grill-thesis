<?php

class Dashboard extends Dbh{
    protected function getOrders(){
        $sql = "SELECT * FROM inventory;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }
}

?>