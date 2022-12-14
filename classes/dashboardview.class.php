<?php

class DashboardView extends Dashboard{
    public function initOrders($date, $date2){
        $results = $this->getOrders($date, $date2);

        echo $results;
    }

    public function initCrews(){
        $results = $this->getCrews();

    }

    public function initSales($date, $date2){
        $results = $this->getTransactions($date, $date2);

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
            $total += (float)$arrtotal[$i];
        }
        echo $total;
    }

    public function initCancels($date, $date2){
        $results = $this->getTransactions($date, $date2);

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            if ($row["paid"] == 3 || $row['paid'] == 4) {
                $total += 1;
            }
        }

        echo $total;
    }

    public function initSuccess($date, $date2){
        $results = $this->getTransactions($date, $date2);

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
            if ($row["table_status"] == "Occupied" && $row["show"] == 1) {
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
            if ($row["table_status"] == "Unoccupied" && $row["show"] == 1) {
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
            if ($row["table_status"] == "Call" && $row["show"] == 1) {
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
            if ($row["table_status"] == "Dirty" && $row["show"] == 1) {
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
        $results = $this->getLoginHistory();

        $total = 0;
        $total = (int)$total;
        foreach ($results as $row) {
            if ($row["last_logout"] == null) {
                $total += 1;
            }
        }

        echo $total;
    }

    public function initTotalServed($date, $date2){
        $results = $this->getTotalServed2($date, $date2);
        $total = 0;
        
        foreach ($results as $row) {
            $total += $row["served"];
        }
        echo $total;
    }

    public function initTotalServedAll(){
        $results = $this->getTotalServedAll();
        foreach ($results as $row) {
            echo $row['id'];
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

    public function initCrewCompliance(){
        $results = $this->getTotalServed();

        foreach ($results as $row) {
            if ($row['is_superuser'] == 1) {
                echo "Total Service";
            }
            elseif ($row['is_cashier'] == 1) {
                echo "Total Billed";
            }
            elseif ($row['is_cook'] == 1) {
                echo "Total Cooked";
            }
            elseif ($row['is_waiter'] == 1) {
                echo "Total Served";
            }
            else{
                echo "Total Cleaned";
            }
        }
    }
}

?>