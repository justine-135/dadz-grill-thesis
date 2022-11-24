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

        session_start();
        $id = $_SESSION["uid"];
        $sql = "INSERT INTO served (`user_id`, served)
        VALUES ('$id', 1)";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;  
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

        $sql = "UPDATE series_orders SET is_ready = 1, is_attended = 0 WHERE table_id = $tid";
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

        session_start();
        $id = $_SESSION["uid"];
        $sql = "INSERT INTO served (`user_id`, served)
        VALUES ('$id', 1)";
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
            $item_ids = explode("|",$row["item_id"]);
            $sid = $row["sales_id"];
            $tid = $row["table_id"];
            $order = $row["item_name"];
            $quantities = explode("|",$row["quantity"]);
            $quantities_transaction = $row["quantity"];
            $prices = $row["total_purchase"];
        }

        $date = date("Y/m/d");
        for ($i=0; $i < count($item_ids)-1; $i++) { 
            $sql = "SELECT * FROM sales_report WHERE date_time = '$date' AND food_id = '$item_ids[$i]' ";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if (count($result) == 0) {
                $sql = "INSERT INTO sales_report (food_id, cancel)
                VALUES ('$item_ids[$i]', '$quantities[$i]')";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                $stmt = null;
            }
            else{
                $sql = "UPDATE sales_report SET cancel = cancel + $quantities[$i] WHERE `food_id` = $item_ids[$i] AND date_time = '$date'";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                $stmt = null;
            }
        }

        $sql = "SELECT * FROM submitted_orders WHERE sales_id='$oid'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        $stmt = null;
        
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