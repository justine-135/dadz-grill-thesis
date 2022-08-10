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
        $results = $this->getSales();

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
}

?>