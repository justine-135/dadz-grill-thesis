<?php

class Unsets extends Dbh{
    public function unset(){
        $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0, is_started = 0 WHERE id = '1'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
    
        $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0, is_started = 0 WHERE id = '2'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
    
        $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0, is_started = 0 WHERE id = '3'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
        
        $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0, is_started = 0 WHERE id = '4'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
        
        $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0, is_started = 0 WHERE id = '5'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
        
        $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0, is_started = 0 WHERE id = '6'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
        
        $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0, is_started = 0 WHERE id = '7'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
        
        $sql = "UPDATE tables SET table_status = 'Unoccupied', timer = 0, warning_time = 0, end_time = 0, payment = 'No order', pending_orders = 0, done_orders = 0, is_started = 0 WHERE id = '8'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        // for ($i=0; $i < 1000; $i++) { 
        //     $sql = "UPDATE inventory SET quantity = 0, sold = 0, success = 0, cancel = 0 WHERE fid = '$i'";
        //     $stmt = $this->connection()->prepare($sql);
        //     $stmt->execute();
        //     $stmt = null;
        // }
        
        $sql = "TRUNCATE series_orders";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
        
        $sql = "TRUNCATE submitted_orders";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
        
        $sql = "TRUNCATE transactions";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "TRUNCATE sales_report";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "TRUNCATE served";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "UPDATE users SET served = 0";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;
    }
}
?>