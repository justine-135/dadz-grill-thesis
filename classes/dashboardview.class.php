<?php

class DashboardView extends Dashboard{
    public function initOrders(){
        $results = $this->getOrders();
    }

    public function initCrews(){
        $results = $this->getCrews();
    }

    public function initSales(){
        $results = $this->getSales();
    }
}

?>