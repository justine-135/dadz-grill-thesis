<?php

class Purchase extends Dbh{
    protected function setPurchase($names, $tableId, $orgPrc, $total, $waiter, $qty, $prc, $uid){
        $total_names='';
        $quantities='';
        $prices='';
        $original_price='';

        for ($i=0; $i < count($names); $i++) { 
            $total_names .= $names[$i]."|";
            $quantities .= $qty[$i]."|";
            $prices .= $prc[$i]."|";
            $original_price .= $orgPrc[$i]."|";
        }
        $sql = "INSERT INTO submitted_orders (table_id, item_name, quantity, original_price, total_purchase, order_status, waiter)
        VALUES ('$tableId', '$total_names', '$quantities', '$original_price' ,'$prices', 'Pending', '$waiter')";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();    
        $stmt = null;

        for ($i=0; $i < count($names); $i++) { 
            $sql = "INSERT INTO series_orders (table_id, `order`, original_price, quantity, price, waiter, is_ready)
            VALUES ( '$tableId' , '$names[$i]' , '$orgPrc[$i]' , '$qty[$i]' , '$prc[$i]' , '$waiter', 0)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
        }
        $stmt = null;

        $sql = "UPDATE tables SET pending_orders = pending_orders + 1 WHERE id = $tableId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();    
        $stmt = null;

        $sql = "UPDATE users SET served = served + 1 WHERE id = $uid";
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

        $sql = "UPDATE tables SET table_status = 'Occupied', payment = 'Pending', pending_orders = pending_orders - 1, done_orders = done_orders + 1 WHERE id = $tid";
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

        $sql = "UPDATE tables SET pending_orders = pending_orders - 1 WHERE id = $tid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();   
        $stmt = null;
    }
}

?>