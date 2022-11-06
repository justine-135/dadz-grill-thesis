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

        $arrtotals = array();
        foreach ($results as $row) {
            if ($row["paid"] == 1) {
                if ($row['price'] != "") {
                    array_push($arrtotals, $row["price"] . "|");
                }
            }
        }

        $val = "";
        for ($i=0; $i < count($arrtotals); $i++) { 
            $arrval = $arrtotals[$i];
            $val .= $arrval;
        }
        $arrtotal = explode("|",$val);

        $total = 0;
        for ($i=0; $i < count($arrtotal); $i++) { 
            $total += (int)$arrtotal[$i];
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
            if ($row["table_status"] == "Call") {
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

    public function initCrew(){
        $results = $this->getCrews();

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            $total += 1;
        }

        echo $total;
    }

    public function initActiveCrew(){
        $results = $this->getCrews();

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            if ($row["is_active"] >= 1) {
                $total += 1;
            }
        }

        echo $total;
    }

    public function initTotalServed(){
        $results = $this->getTotalServed();

        foreach ($results as $row) {
            echo $row["served"];
        }
    }
    
    public function initCrewRole(){
        $results = $this->getTotalServed();

        foreach ($results as $row) {
            if ($row['is_superuser'] == 1) {
                echo "Manager";
            }
            elseif ($row['is_cashier'] == 1) {
                echo "Cashier";
            }
            elseif ($row['is_cook'] == 1) {
                echo "Cook";
            }
            elseif ($row['is_waiter'] == 1) {
                echo "Waiter";
            }
            else{
                echo "Cleaner";
            }
        }
    }
}

?>