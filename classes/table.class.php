<?php
// set the default timezone to use.
date_default_timezone_set('Asia/Manila');

class Table extends Dbh
{
    protected function getTables()
    {
        $sql = "SELECT * FROM tables";
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
        
        $warning_time = $res + 6300;
        $end_time = $res + 7200;

        $sql = "SELECT is_started, payment FROM tables WHERE id = $id";
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
                $sql = "UPDATE tables SET timer = '$res', warning_time = '$warning_time', end_time = '$end_time', payment = 'Pending', done_orders = 0, is_started = true WHERE id = $id";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                $stmt = null;
                header("location: ../menu.php?alert=has_order&id=" . $id);

            }else{
                header("location: ../menu.php?alert=no_order&id=" . $id);
            }
        } 
        else{
            $sql = "UPDATE tables SET table_status = 'Occupied', done_orders = 0 WHERE id = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;
            header("location: ../menu.php?alert=has_order&id=" . $id);
        }

    }

    protected function has_order_request($id)
    {
        
        $sql = "SELECT table_status FROM tables WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        $stmt = null;

        foreach ($results as $row) {
            $tableStatus = $row["table_status"];
        }

        if ($tableStatus == "Call") {
            $sql = "UPDATE tables SET table_status = 'Occupied', payment = 'Requesting', is_started = 0 WHERE id = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
        }
        else{
            $sql = "UPDATE tables SET payment = 'Requesting', is_started = 0 WHERE id = $id";
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
        $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0 WHERE id = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        header("location: ../dirty.php?alert=dirty&id=" . $tblId);
    }

    protected function setAttended($tblId)
    {
        $sql = "SELECT table_status, payment, done_orders, is_started FROM tables WHERE id = $tblId";
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
            if ($payment != "Requesting" && $payment != "Bill out") {
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
        $sql = "SELECT table_status, pending_orders, done_orders, is_started FROM tables WHERE id = $tblId";
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
        
        $sql = "SELECT table_status FROM tables WHERE id = $tblId";
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
        $sql = "SELECT table_status, payment, timer FROM tables WHERE id = $tblId";
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
                    header("location: ../store.php?id=" . $tblId);
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
        $sql = "UPDATE tables SET table_status = 'Occupied' WHERE id = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        header("location: ../tables.php");

        exit();
    }

    protected function setUnoccupy($tblId)
    {
        $sql = "UPDATE tables SET table_status = 'Unoccupied' WHERE id = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        header("location: ../tables.php");

        exit();
    }

    protected function setCall($tblId)
    {
        $sql = "UPDATE tables SET table_status = 'Call' WHERE id = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        header("location: ../tables.php");

        exit();
    }

    protected function setNotify($id)
    {
        $sql = "SELECT * FROM tables WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $tblStatus = $row["table_status"];
        }

        if ($tblStatus != 'Unoccupied') {
            $sql = "UPDATE tables SET table_status = 'Call' WHERE id = $id";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
        }
    }

    protected function setStopTimer($id)
    {
        $sql = "UPDATE tables SET is_started = false WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        header("location: ../menu.php");
    }

    protected function setGetId($id)
    {
        $sql = "SELECT * FROM tables WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    }
}