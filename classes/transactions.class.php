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

    protected function getTransactionsDate($date)
    {
        $dateLike = $date . "%";
        $sql = "SELECT * FROM transactions WHERE reg_date LIKE '$dateLike'";
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

        $sql = "INSERT INTO transactions (table_id, food_id, `order`, original_price, quantity, price)
        VALUES ( '$id' , '$newItemId' , '$newOrder' , '$newOrgPrice' , '$newQuantity' , '$newPrice')";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "UPDATE tables SET payment = 'Bill out', is_started = false WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        header("location: ../tables.php?alert=billout&id=" . $id);
        exit();
    }

    protected function setTransactions($id)
    {
        $sql = "SELECT * FROM tables WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            if ($row["payment"] == "Requesting") {
                $this->has_request($id);
            } else {
                header("location: ../tables.php?alert=no_request&id=" . $id);
            }
        }
    }

    protected function setPaid($id, $tbl)
    {
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
