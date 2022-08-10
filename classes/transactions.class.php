<?php

class Transactions extends Dbh{
    protected function getTransactions(){
        $sql = "SELECT * FROM transactions";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function has_request($id){
        $sql = "SELECT * FROM series_orders WHERE table_id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        
        $orders = array();
        $qtys = array();
        $prices = array();

        foreach ($results as $row) {
            array_push($orders, $row["order"]);
            array_push($qtys, $row["quantity"]);
            array_push($prices, $row["price"]);
        }

        $total = 0;
        $newOrder = "";
        $newQuantity = "";
        $newPrice = "";

        for ($i=0; $i < count($orders); $i++) { 
            $price = (int)$prices[$i];
            $total += $price;
            $newOrder .= $orders[$i] . "|";
            $newQuantity .= $qtys[$i] . "|";
            $newPrice .= $prices[$i] . "|";
        }

        $sql = "INSERT INTO transactions (table_id, `order`, quantity, price, total)
        VALUES ( '$id' , '$newOrder' , '$newQuantity' , '$newPrice' , '$total')";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        // $sql = "SELECT * FROM submitted_orders WHERE sales_id = $id";
        // $stmt = $this->connection()->prepare($sql);
        // $stmt->execute();
        // $results = $stmt->fetchAll();
        
        // foreach ($results as $row) {        
        //     $table_id = $row["table_id"];
        //     $order = $row["item_name"];
        //     $total_purchase = $row["total_purchase"];

        //     $sql = "INSERT INTO transactions (order_id, table_id, `order`, quantity, price, total, paid)
        //     VALUES ('$id', '$table_id', '$order', '0', '0', '$total_purchase', '0')";
        //     $stmt = $this->connection()->prepare($sql);
        //     $stmt->execute();    
        //     $stmt = null;
        // }

        // echo $id;

        $sql = "UPDATE tables SET payment = 'Bill out', is_started = false WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        header("location: ../tables.php?error=0");
        exit();
    }

    protected function setTransactions($id){
        $sql = "SELECT * FROM tables WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            if ($row["payment"] == "Requesting") {
                $this->has_request($id);
            }
            else{
                header("location: ../tables.php?error=1");
            }
        }
    }

    protected function setPaid($id, $tbl){
        $sql = "UPDATE transactions SET paid = true WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "UPDATE tables SET table_status = 'Dirty', timer = 0, payment = 'Paid' WHERE id = $tbl";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "DELETE FROM series_orders WHERE table_id=$tbl";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        header("location: ../transactions.php");
        exit();
    }
}

?>