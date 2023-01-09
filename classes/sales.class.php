<?php

class Sales extends Dbh
{
    protected function getSalesReport()
    {
        $sql = "SELECT inventory.fid, inventory.item_name, inventory.item_group, sales_report.date_time,  inventory.cost, sales_report.success, sales_report.cancel
        FROM inventory, sales_report
        WHERE inventory.fid = food_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }
    protected function getSalesReportDate($date, $date2)
    {
        $sql = "SELECT inventory.fid, inventory.item_name, inventory.item_group, sales_report.date_time,  inventory.cost, sales_report.success, sales_report.cancel
        FROM inventory, sales_report
        WHERE inventory.fid = food_id AND date_time BETWEEN '$date' AND '$date2'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getTransactions($date, $date2){
        if (empty($date) || empty($date2)) {
            $sql = "SELECT * FROM transactions;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results2 = $stmt->fetchAll();
            return $results2;
        }
        else{
            $sql = "SELECT * FROM transactions WHERE DATE(reg_date) BETWEEN '$date' AND '$date2'";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results2 = $stmt->fetchAll();
            return $results2;
        }

    }
}