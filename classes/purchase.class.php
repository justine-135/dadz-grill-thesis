<?php

class Purchase extends Dbh{
    protected function setPurchase($names, $tableId, $total, $waiter, $qty, $prc){
        $total_names='';

        for ($i=0; $i < count($names); $i++) { 
            $total_names .= $names[$i] . ' x ' . $qty[$i] . '<br>';
        }
    
        $sql = "INSERT INTO submitted_orders (table_id, item_name, total_purchase, order_status, waiter)
        VALUES ('$tableId', '$total_names', '$total', 'Pending', '$waiter')";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();    
        $stmt = null;

        for ($i=0; $i < count($names); $i++) { 
            $sql = "INSERT INTO series_orders (table_id, `order`, quantity, price, waiter, is_ready)
            VALUES ( '$tableId' , '$names[$i]' , '$qty[$i]' , '$prc[$i]' , '$waiter', 0)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
        }
        $stmt = null;

        $sql = "UPDATE tables SET order_status = 'Preparing' WHERE id = $tableId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();    
    }

    protected function getPurchases(){
        $sql = "SELECT * FROM submitted_orders";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getPurchase($oid){
        $sql = "SELECT table_id, item_name FROM submitted_orders WHERE sales_id='$oid'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function setFinish($id){
        $sql = "UPDATE series_orders SET is_ready = 1 WHERE table_id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "UPDATE tables SET order_status = 'Pick-up' WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
    }
}

?>