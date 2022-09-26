<?php

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

    protected function updateTableTimer($i)
    {
        $sql = "SELECT is_started FROM tables WHERE id = $i";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $increment = 1;
        if ($result > 0) {
            foreach ($result as $row) {
                $started = $row["is_started"];
                if ($started == 1) {
                    $sql = "UPDATE tables SET timer = timer + $increment WHERE id = $i";
                    $stmt = $this->connection()->prepare($sql);
                    $stmt->execute();
                }
            }
        }
    }

    protected function has_order_attended($id)
    {
        $sql = "UPDATE tables SET payment = 'Pending', done_orders = 0, is_started = true WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        header("location: ../menu.php?alert=has_order&id=" . $id);
    }

    protected function has_order_request($id)
    {
        $sql = "UPDATE tables SET payment = 'Requesting' WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        header("location: ../menu.php?alert=request&id=" . $id);
    }

    protected function no_order($id)
    {
        header("location: ../menu.php?alert=no_order&id=" . $id);
    }

    protected function is_dirty($tblId)
    {
        $sql = "UPDATE tables SET table_status = 'Unoccupied', payment = 'No order', pending_orders = 0, done_orders = 0 WHERE id = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        header("location: ../dirty.php?alert=dirty&id=" . $tblId);
    }

    protected function setAttended($tblId)
    {
        $sql = "SELECT payment, done_orders FROM tables WHERE id = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $payment = $row["payment"];
            $doneOrder = $row['done_orders'];
        }

        if ($payment == "Pending" && $doneOrder > 0) {
            $this->has_order_attended($tblId);
        } else {
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
        $sql = "SELECT payment FROM tables WHERE id = $tblId";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $payment = $row["payment"];
        }

        if ($payment != 'Bill out') {
            header("location: ../store.php?id=" . $tblId);
        }
        else{
            header("location: ../menu.php");
        }
    }

    protected function setNotify1()
    {
        $sql = "UPDATE tables SET table_status = 'Call' WHERE id = 1";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
    }

    protected function getTable1()
    {
        $sql = "SELECT * FROM tables WHERE id = 1";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;

    }
}
