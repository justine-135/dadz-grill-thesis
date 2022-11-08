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
    protected function getSalesReportDate($date)
    {
        $sql = "SELECT inventory.fid, inventory.item_name, inventory.item_group, sales_report.date_time,  inventory.cost, sales_report.success, sales_report.cancel
        FROM inventory, sales_report
        WHERE inventory.fid = food_id AND date_time = '$date'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }
}