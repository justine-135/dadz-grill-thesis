<?php

class Purchase extends Dbh{
    protected function setPurchase($names, $tableId, $total, $waiter, $qty, $prc){
        $total_names='';
        $quantities='';
        $prices='';

        for ($i=0; $i < count($names); $i++) { 
            $total_names .= $names[$i]."|";
            $quantities .= $qty[$i]."|";
            $prices .= $prc[$i]."|";
        }

        $sql = "INSERT INTO submitted_orders (table_id, item_name, quantity, total_purchase, order_status, waiter)
        VALUES ('$tableId', '$total_names', '$quantities', '$prices', 'Pending', '$waiter')";
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

    protected function getPurchase($id){
        $sql = "SELECT * FROM submitted_orders WHERE sales_id='$id'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function setFinish($oid, $tid){
        $sql = "UPDATE series_orders SET is_ready = 1 WHERE table_id = $tid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "UPDATE tables SET order_status = 'Pick-up' WHERE id = $tid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "DELETE FROM submitted_orders WHERE sales_id=$oid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
    }

    protected function setCancel($oid, $tid){
        $sql = "SELECT * FROM submitted_orders WHERE sales_id='$oid'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        $sid="";
        $tid="";
        $order="";
        $quantities="";
        $prices="";

        foreach ($results as $row) {
            $sid = $row["sales_id"];
            $tid = $row["table_id"];
            $order = $row["item_name"];
            $quantities = $row["quantity"];
            $prices = $row["total_purchase"];
        }

        $sql = "INSERT INTO transactions (table_id, `order`, quantity, price, paid)
        VALUES ( '$tid' , '$order' , '$quantities' , '$prices' , 3)";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "DELETE FROM submitted_orders WHERE sales_id=$oid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "UPDATE tables SET order_status = 'No order' WHERE id = $tid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();   
        $stmt = null;
    }
}

?>