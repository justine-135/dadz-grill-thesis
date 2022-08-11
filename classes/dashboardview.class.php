<?php

class DashboardView extends Dashboard{
    public function initOrders(){
        $results = $this->getOrders();

        echo $results;
    }

    public function initCrews(){
        $results = $this->getCrews();

    }

    public function initSales(){
        $results = $this->getTransactions();

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            if ($row["paid"] == 1) {
                $val = (int)$row["total"];
                $total += (int)$val;
            }
        }

        echo $total;
    }

    public function initCancels(){
        $results = $this->getTransactions();

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            if ($row["paid"] == 3) {
                $total += 1;
            }
        }

        echo $total;
    }

    public function initSuccess(){
        $results = $this->getTransactions();

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            if ($row["paid"] == 1) {
                $val = (int)$row["paid"];
                $total += (int)$val;
            }
        }

        echo $total;
    }

    public function initOccupied(){
        $results = $this->getTables();

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            if ($row["table_status"] == "Occupied") {
                $total += 1;
            }
        }

        echo $total;
    }

    public function initUnoccupied(){
        $results = $this->getTables();

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            if ($row["table_status"] == "Unoccupied") {
                $total += 1;
            }
        }

        echo $total;
    }

    public function initCall(){
        $results = $this->getTables();

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            if ($row["table_status"] == "Calling") {
                $total += 1;
            }
        }

        echo $total;
    }

    public function initDirty(){
        $results = $this->getTables();

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            if ($row["table_status"] == "Dirty") {
                $total += 1;
            }
        }

        echo $total;
    }
}

?>