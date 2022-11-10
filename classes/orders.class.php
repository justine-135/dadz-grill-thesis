<?php

class Orders extends Dbh{
    protected function getOrder($oid){
        $sql = "SELECT * FROM series_orders WHERE table_id='$oid'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }
}

?>