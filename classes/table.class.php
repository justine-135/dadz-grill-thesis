<?php
// set the default timezone to use.
date_default_timezone_set('Asia/Manila');

class Table extends Dbh
{
    protected function getTables()
    {
        $sql = "SELECT * FROM tables ORDER BY `number` ASC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function has_order_attended($id)
    {
        // Prints something like: Monday 8th of August 2005 03:12:46 PM
        $hms = date('h:i:s');  
        $res = 0;
        $arr = explode(':', $hms);
        if (count($arr) === 3) {
            echo "hour:" . $arr[0] . "<br>";
            echo "min:" . $arr[1] . "<br>";
            echo "sec:" . $arr[2] . "<br>";

            $res = $arr[0] * 3600 + $arr[1] * 60 + $arr[2];59;
        }
        
        $warning_time = $res + 7200;
        $end_time = $res + 8100;

        $sql = "SELECT is_started, payment FROM tables WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        $stmt = null;

        foreach ($results as $row) {
            $is_started = $row["is_started"];
            $payment = $row["payment"];
        }

        if ($is_started != 1) {
            if ($payment != "Requesting") {
                $sql = "UPDATE tables SET timer = '$res', warning_time = '$warning_time', end_time = '$end_time', payment = 'Pending', done_orders = 0, is_started = true WHERE `number` = $id";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                $stmt = null;
                header("location: ../menu.php?alert=has_order&id=" . $id);

            }else{
                header("location: ../menu.php?alert=no_order&id=" . $id);
            }
        } 
        else{
            $sql = "UPDATE tables SET table_status = 'Occupied', done_orders = 0 WHERE `number` = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;
            header("location: ../menu.php?alert=has_order&id=" . $id);
        }

    }

    protected function has_order_request($id)
    {
        
        $sql = "SELECT table_status FROM tables WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        $stmt = null;

        foreach ($results as $row) {
            $tableStatus = $row["table_status"];
        }

        if ($tableStatus == "Call") {
            $sql = "UPDATE tables SET table_status = 'Occupied', payment = 'Requesting', is_started = 0 WHERE `number` = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
        }
        else{
            $sql = "UPDATE tables SET payment = 'Requesting', is_started = 0 WHERE `number` = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
        }



        header("location: ../menu.php?alert=request&id=" . $id);
    }

    protected function no_order($id)
    {
        header("location: ../menu.php?alert=no_order&id=" . $id);
    }

    protected function is_dirty($tblId)
    {
        $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0 WHERE `number` = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        session_start();
        $id = $_SESSION["uid"];
        $sql = "INSERT INTO served (`user_id`, served)
        VALUES ('$id', 1)";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null; 
        
        header("location: ../dirty.php?alert=dirty&id=" . $tblId);
    }

    protected function setAttended($tblId)
    {
        $sql = "SELECT table_status, payment, done_orders, is_started FROM tables WHERE `number` = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $payment = $row["payment"];
            $doneOrder = $row['done_orders'];
            $tableStatus = $row['table_status'];
            $started = $row['is_started'];
        }
        
        if ($tableStatus != "Unoccupied" && $tableStatus != "Dirty") {
            if ($payment != "Requesting" && $payment != "Bill out" && $payment != "No order") {
                $this->has_order_attended($tblId);
            }
            else{
                $this->no_order($tblId);
            }
        }
        else {
            $this->no_order($tblId);
        }
    }

    protected function setRequest($tblId)
    {
        $sql = "SELECT table_status, pending_orders, done_orders, is_started FROM tables WHERE `number` = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $tblStatus = $row["table_status"];
            $tableStarted = $row["is_started"];
            $pendingOrder = $row['pending_orders'];
            $doneOrder = $row['done_orders'];
        }

        if ($tableStarted != 0 && $pendingOrder == 0 && $doneOrder == 0) {
            $this->has_order_request($tblId);
        } else {
            $this->no_order($tblId);
        }
    }

    protected function setCLean($tblId)
    {
        $tblStatus = "";
        
        $sql = "SELECT table_status FROM tables WHERE `number` = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $tblStatus = $row["table_status"];
        }

        if ($tblStatus == 'Dirty') {
            $this->is_dirty($tblId);
        }
        else{
            header("location: ../dirty.php?alert=not_dirty&id=" . $tblId);
        }
        
    }

    protected function openMenu($tblId)
    {
        $tblId2 = $tblId;
        $sql = "SELECT table_status, payment, timer FROM tables WHERE `number` = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $payment = $row["payment"];
            $tableStatus = $row["table_status"];
            $timer = $row["timer"];
        }

        if ($tableStatus != "Dirty") {
            if ($payment != 'Requesting' && $payment != 'Bill out') {
                if ($tblId2 == $tblId) {
                    session_start();
                    $_SESSION["table"] = $tblId;
                    header("location: ../store.php");
                }
                else{
                    header("location: ../menu.php");
                }
            }
            else {
                header("location: ../menu.php");
            }
        }
        else{
            header("location: ../menu.php");
        }
    }

    protected function setOccupy($tblId)
    {
        $sql = "UPDATE tables SET table_status = 'Occupied' WHERE `number` = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        header("location: ../tables.php?alert=changed&id=" . $tblId);

        exit();
    }

    protected function setUnoccupy($tblId)
    {
        $sql = "UPDATE tables SET table_status = 'Unoccupied' WHERE `number` = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        header("location: ../tables.php");

        exit();
    }

    protected function setCall($tblId)
    {
        $sql = "UPDATE tables SET table_status = 'Call' WHERE `number` = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        header("location: ../tables.php");

        exit();
    }

    protected function setNotify($id)
    {
        $sql = "SELECT * FROM tables WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $tblStatus = $row["table_status"];
        }

        if ($tblStatus != 'Unoccupied' && $tblStatus != 'Dirty') {
            $sql = "UPDATE tables SET table_status = 'Call' WHERE `number` = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();

            header("location: ../menu?alert=1");
        }
    }

    protected function setStopTimer($id)
    {
        $sql = "UPDATE tables SET is_started = false WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

         $this->has_order_request($id);

        header("location: ../menu.php");
    }

    protected function setGetId($id)
    {
        $sql = "SELECT * FROM tables WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function addTable($tableNumber)
    {
        $sql = "SELECT * FROM tables";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $result = 0;

        foreach ($results as $row) {
            if ($tableNumber == $row['number']) {
                $existed = $row['number'];
                if ($row['show'] == 1) {
                    $result = 1;
                }
                elseif ($row['show'] == 0){
                    $result = 2;
                }
                else{
                    $result = 3;
                }
            }
        }

        if ($result == 1) {
            header("location: ../setting.php?alert=fail&id=" . $tableNumber);
        }
        elseif ($result == 2) {
            $sql = "UPDATE tables SET `date` = `date`, `show` = 1 WHERE `number` = $tableNumber";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null; 
            header("location: ../setting.php?alert=success&id=" . $tableNumber);
        }
        else{
            $sql = "INSERT INTO tables (`number`, table_status, timer, warning_time, end_time, payment, pending_orders, done_orders, is_started, `show`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$tableNumber, "Unoccupied", 0, 0, 0, "No order", 0, 0, 0, 1]);
            $stmt = null; 
            header("location: ../setting.php?alert=success&id=" . $tableNumber);
        }
    }

    protected function deleteTable($tableNumber)
    {
        $sql = "SELECT * FROM tables WHERE `number` = $tableNumber";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        $condition = 0;

        foreach ($results as $row) {
            if ($row['table_status'] != "Unoccupied" || $row['payment'] != "No order" || $row['pending_orders'] > 0 || $row['done_orders'] > 0 || $row['is_started'] > 0) {
                $condition = 0;
            }
            else{
                $condition = 1;
            }
        }

        if ($condition == 1) {
            $sql = "UPDATE tables SET `date` = `date`, `show` = 0 WHERE `number` = $tableNumber";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null; 
            header("location: ../setting.php?alert=deleted&id=" . $tableNumber);
        }
        else{
            header("location: ../setting.php?alert=faildelete&id=" . $tableNumber);
        }

    }

    protected function setCounter($id, $counter)
    {
        $intCounter = intval($counter);
        $sql = "UPDATE tables SET `counter`= `counter` + 1  WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null; 
    }

    protected function resetCounter($id)
    {
        $sql = "UPDATE tables SET `counter`= 0 WHERE `number` = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null; 
    }
}