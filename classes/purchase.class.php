<?php

class Purchase extends Dbh{
    protected function setPurchase($names, $tableId, $orgPrc, $total, $waiter, $qty, $prc, $uid, $item_id){
        $total_names='';
        $quantities='';
        $prices='';
        $original_price='';
        $item_ids = '';

        for ($i=0; $i < count($names); $i++) { 
            $total_names .= $names[$i]."|";
            $quantities .= $qty[$i]."|";
            $prices .= $prc[$i]."|";
            $original_price .= $orgPrc[$i]."|";
            $item_ids .= $item_id[$i]."|";

            $sql = "UPDATE inventory SET quantity = quantity + '$qty[$i]', sold = quantity * cost WHERE fid = $item_id[$i]";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();    
            $stmt = null;
        }

        $sql = "INSERT INTO submitted_orders (table_id, item_id, item_name, quantity, original_price, total_purchase, order_status, waiter)
        VALUES ('$tableId', '$item_ids', '$total_names', '$quantities', '$original_price' ,'$prices', 'Pending', '$waiter')";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();    
        $stmt = null;

        $sql = "INSERT INTO series_orders (table_id, item_id, `order`, original_price, quantity, price, waiter, is_ready)
        VALUES ( '$tableId' , '$item_ids' , '$total_names' , '$original_price' , '$quantities' , '$prices' , '$waiter', 0)";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
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
        $sql = "SELECT * FROM tables WHERE id='$tid'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $tableStatus = $row['table_status'];
        }

        $results = null;
        $stmt = null;

        $sql = "SELECT * FROM submitted_orders WHERE sales_id='$oid'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        
        foreach ($results as $row) {
            $item_ids = explode("|",$row["item_id"]);
            $quantities = explode("|",$row["quantity"]);
        }

        for ($i=0; $i < (count($item_ids) - 1); $i++) { 
            $sql = "UPDATE inventory SET success = success + $quantities[$i] WHERE fid = '$item_ids[$i]'";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();    
            $stmt = null;
        }

        $sql = "UPDATE series_orders SET is_ready = 1 WHERE table_id = $tid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        if ($tableStatus == "Unoccupied" || $tableStatus == "Occupied") {
            $sql = "UPDATE tables SET table_status = 'Occupied', payment = 'Pending', pending_orders = pending_orders - 1, done_orders = done_orders + 1 WHERE id = $tid";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;
        }
        else {
            $sql = "UPDATE tables SET payment = 'Pending', pending_orders = pending_orders - 1, done_orders = done_orders + 1 WHERE id = $tid";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;
        }

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
        $quantities_transaction="";
        $prices="";

        foreach ($results as $row) {
            $sid = $row["sales_id"];
            $tid = $row["table_id"];
            $order = $row["item_name"];
            $quantities_transaction = $row["quantity"];
            $prices = $row["total_purchase"];
        }

        $sql = "SELECT * FROM submitted_orders WHERE sales_id='$oid'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        $stmt = null;
        
        foreach ($results as $row) {
            $item_ids = explode("|",$row["item_id"]);
            $quantities_items = explode("|",$row["quantity"]);
        }

        for ($i=0; $i < (count($item_ids) - 1); $i++) { 
            $sql = "UPDATE inventory SET cancel = cancel + $quantities_items[$i] WHERE fid = '$item_ids[$i]'";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();    
            $stmt = null;
        }


        $sql = "INSERT INTO transactions (table_id, `order`, quantity, price, paid)
        VALUES ( '$tid' , '$order' , '$quantities_transaction' , '$prices' , 3)";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "DELETE FROM submitted_orders WHERE sales_id=$oid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "DELETE FROM series_orders WHERE id=$oid";
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