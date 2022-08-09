<?php

class Orders extends Dbh{
    protected function getOrder($oid){
        $sql = "SELECT waiter, `order`, quantity, is_ready FROM series_orders WHERE table_id='$oid'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }
}

?>