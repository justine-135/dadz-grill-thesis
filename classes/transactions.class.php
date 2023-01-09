<?php

class Transactions extends Dbh
{
    protected function getTransactions()
    {
        $sql = "SELECT * FROM transactions";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getTransactionsDate($date, $date2)
    {
        $dateLike = $date;
        $dateLike2 = $date2;

        $sql = "SELECT * FROM transactions WHERE DATE(reg_date) BETWEEN '$dateLike' AND '$dateLike2'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function has_request($id)
    {
        $sql = "SELECT * FROM series_orders WHERE table_id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        $item_ids = array();
        $orders = array();
        $qtys = array();
        $prices = array();
        $original_prices = array();

        foreach ($results as $row) {
            if ($row['is_ready'] == 1) {
                array_push($item_ids, $row["item_id"]);
                array_push($orders, $row["order"]);
                array_push($qtys, $row["quantity"]);
                array_push($prices, $row["price"]);
                array_push($original_prices, $row["original_price"]);
                $prices2 = $row['price'];
            }
        }

        $total = 0;
        $newItemId = "";
        $newOrder = "";
        $newQuantity = "";
        $newPrice = "";
        $newOrgPrice = "";

        for ($i = 0; $i < count($orders); $i++) {
            $price = (int)$prices[$i];
            // $total += (float)$price
            $newItemId .= $item_ids[$i];
            $newOrder .= $orders[$i] . "";
            $newQuantity .= $qtys[$i] . "";
            $newPrice .= $prices[$i] . "";
            $newOrgPrice .= $original_prices[$i] . "";
        }

        $prices2 = explode("|", $prices2);

        for ($i=0; $i < count($prices2); $i++) { 
            $total += (float)$prices2[$i];
        }

        $newItemId = rtrim($newItemId, "|");
        $newOrder = rtrim($newOrder, "|");
        $newQuantity = rtrim($newQuantity, "|");
        $newPrice = rtrim($newPrice, "|");
        $newOrgPrice = rtrim($newOrgPrice, "|");

        $stmt = null;

        $sql = "SELECT * FROM tables WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $start_time = $row['timer'];
        }

        $sql = "INSERT INTO transactions (table_id, start_time, duration, food_id, `order`, original_price, quantity, price, total)
        VALUES ( '$id' , '$start_time' , 1 , '$newItemId' , '$newOrder' , '$newOrgPrice' , '$newQuantity' , '$newPrice', '$total')";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "UPDATE tables SET payment = 'Bill out', is_started = false WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        header("location: ../tables.php?alert=billout&id=" . $id);
        exit();
    }
    protected function has_request2($id, $condition)
    {
        if ($condition == 1 || $condition == 3) {
            $sql = "SELECT * FROM series_orders WHERE table_id = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
    
            $item_ids = array();
            $orders = array();
            $qtys = array();
            $prices = array();
            $original_prices = array();
    
            foreach ($results as $row) {
                if ($row['is_ready'] == 1) {
                    array_push($item_ids, $row["item_id"]);
                    array_push($orders, $row["order"]);
                    array_push($qtys, $row["quantity"]);
                    array_push($prices, $row["price"]);
                    array_push($original_prices, $row["original_price"]);
                }
            }

            $total = 0;
            $newItemId = "";
            $newOrder = "";
            $newQuantity = "";
            $newPrice = "";
            $newOrgPrice = "";
    
            for ($i = 0; $i < count($orders); $i++) {
                $price = (int)$prices[$i];
                $total += $price;
                $newItemId .= $item_ids[$i];
                $newOrder .= $orders[$i] . "";
                $newQuantity .= $qtys[$i] . "";
                $newPrice .= $prices[$i] . "";
                $newOrgPrice .= $original_prices[$i] . "";
            }
    
            $newItemId = rtrim($newItemId, "|");
            $newOrder = rtrim($newOrder, "|");
            $newQuantity = rtrim($newQuantity, "|");
            $newPrice = rtrim($newPrice, "|");
            $newOrgPrice = rtrim($newOrgPrice, "|");

            foreach ($results as $row) {
                $item_ids = explode("|",$row["item_id"]);
                $qtys = explode("|",$row["quantity"]);
            }

            $date = date("Y/m/d");

            for ($i=0; $i < count($item_ids)-1; $i++) { 
                $sql = "SELECT * FROM sales_report WHERE date_time = '$date' AND food_id = '$item_ids[$i]' ";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
    
                if (count($result) == 0) {
                    $sql = "INSERT INTO sales_report (food_id, cancel)
                    VALUES ('$item_ids[$i]', '$qtys[$i]')";
                    $stmt = $this->connection()->prepare($sql);
                    $stmt->execute();
                    $stmt = null;
                }
                else{
                    $cancelQuantity = intval($qtys[$i]);
                    $sql = "UPDATE sales_report SET cancel = cancel + $cancelQuantity WHERE `food_id` = $item_ids[$i] AND date_time = '$date'";
                    $stmt = $this->connection()->prepare($sql);
                    $stmt->execute();
                    $stmt = null;
                }
            }

            date_default_timezone_set("Asia/Manila");
            $start_time = date("H:i:s");
            $arr = explode(':', $start_time);
    
            if (count($arr) === 3) {
                $start_time_second = $arr[0] * 3600 + $arr[1] * 60 + $arr[2];
            }
            else{
                $start_time_second = $arr[0] * 60 + $arr[1];
            }

            $sql = "SELECT * FROM tables WHERE `number` = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();

            foreach ($results as $row) {
                if ($row['timer'] != 0) {
                    $start_time = $row['timer'];
                    $sql = "INSERT INTO transactions (table_id, start_time, duration, food_id, `order`, original_price, quantity, price, paid)
                    VALUES ( '$id' , '$start_time' , 0 , '$newItemId' , '$newOrder' , '$newOrgPrice' , '$newQuantity' , '$newPrice', 3)";
                    $stmt = $this->connection()->prepare($sql);
                    $stmt->execute();
                    $stmt = null;
                }
                else{
                    $sql = "INSERT INTO transactions (table_id, start_time, duration, food_id, `order`, original_price, quantity, price, paid)
                    VALUES ( '$id' , '$start_time_second' , 0 , '$newItemId' , '$newOrder' , '$newOrgPrice' , '$newQuantity' , '$newPrice', 3)";
                    $stmt = $this->connection()->prepare($sql);
                    $stmt->execute();
                    $stmt = null;
                }
            }
    
            $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0, is_started = false WHERE `number` = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;

            $sql = "DELETE FROM series_orders WHERE table_id=$id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;
            header("location: ../tables.php?alert=success&id=" . $id);
        }
        else if ($condition != 2){
            $sql = "UPDATE tables SET table_status = 'Unoccupied' WHERE `number` = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;

            header("location: ../tables.php?alert=changed&id=" . $id);
        }
        else{
            header("location: ../tables.php?alert=fail&id=" . $id);
        }

        exit();
    }

    protected function setTransactions($id)
    {
        $sql = "SELECT * FROM tables WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        foreach ($results as $row) {
            if ($row["payment"] == "Requesting") {
                $this->has_request($id);
            } 
            else{
                header("location: ../tables.php?alert=nochange&id=" . $id);
                exit();
            }
        }
    }
    
    protected function setUnoccupied($id)
    {
        $sql = "SELECT * FROM tables WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        $condition = 0;
        foreach ($results as $row) {
            if ($row["is_started"] == "1") {
                $condition = 1;
                $this->has_request2($id, $condition);
            } 
            else{
                if ($row['payment'] == "Requesting" || $row['payment'] == "Requested" || $row['payment'] == "Bill out") {
                    $condition = 2;
                    $this->has_request2($id, $condition);
                }
                else if ($row['payment'] == "Pending"){
                    $condition = 3;
                    $this->has_request2($id, $condition);
                }
                else{
                    $condition = 4;
                    $this->has_request2($id, $condition);
                }
            }
        }      
    }

    protected function setPaid($id, $tbl, $discounted, $discountedArr)
    {
        $sql = "SELECT * FROM transactions WHERE id = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$id]);

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $item_ids = explode("|",$row["food_id"]);
            $quantities = explode("|",$row["quantity"]);
            $original_prices = explode("|",$row["original_price"]);
            $prices = explode("|",$row["price"]);
        }

        
        $discountedPrices = explode(",",$discounted);
        $newDiscountedPrices = "";
        for ($i=0; $i < count($discountedPrices); $i++) { 
            $newDiscountedPrices .= $discountedPrices[$i] . "|";
        }

        $discountedPricesArr = explode(",",$discountedArr);
        $newDiscountedPricesArr = "";
        for ($i=0; $i < count($discountedPricesArr); $i++) { 
            $newDiscountedPricesArr .= $discountedPricesArr[$i] . "|";
        }
        echo $newDiscountedPricesArr;

        $sql = "UPDATE transactions SET `price` = '$newDiscountedPricesArr' WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $date = date("Y/m/d");
        for ($i=0; $i < count($item_ids); $i++) { 

            $sql = "SELECT * FROM sales_report WHERE date_time = '$date' AND food_id = '$item_ids[$i]' ";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if (count($result) == 0) {
                $sql = "INSERT INTO sales_report (food_id, success)
                VALUES ('$item_ids[$i]', '$quantities[$i]')";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                $stmt = null;
            }
            else{
                $successQuantity = intval($quantities[$i]);
                $sql = "UPDATE sales_report SET success = success + $successQuantity WHERE food_id = $item_ids[$i] AND date_time = '$date'";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                $stmt = null;
            }
        }

        foreach ($results as $row) {
            $isPaid = $row["paid"];
        }

        if ($isPaid != 1) {
            $sql = "UPDATE transactions SET reg_date = reg_date, paid = true WHERE id = $id";
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
    
            $sql = "UPDATE tables SET table_status = 'Dirty', timer = 0, payment = 'Paid' WHERE `number` = $tbl";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;
    
            $sql = "DELETE FROM series_orders WHERE table_id=$tbl";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;
        }

        exit();
    }

    protected function getInvoice($id)
    {
        $sql = "SELECT * FROM transactions WHERE id = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$id]);

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getSalesReport()
    {
        $sql = "SELECT * FROM inventory";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

}
