<?php

class Foods extends Dbh{

    protected function getFoods(){
        $sql = "SELECT * FROM inventory;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getSets(){
        $sql = "SELECT * FROM inventory WHERE item_group = 'Sets';";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getMeats(){
        $sql = "SELECT * FROM inventory WHERE item_group = 'Meat';";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getSides(){
        $sql = "SELECT * FROM inventory WHERE item_group = 'Sides';";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getDrinks(){
        $sql = "SELECT * FROM inventory WHERE item_group = 'Drinks';";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getAddons(){
        $sql = "SELECT * FROM inventory WHERE item_group = 'Addons';";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function setFood($name, $group, $cost, $grams, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed){
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
            if(move_uploaded_file($fileTempLoc, $target)){
                $sql = "INSERT INTO inventory (item_name, item_group, cost, grams, photo, order_status)
                VALUES (?, ?, ?, ?, ?, ?)";
                
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$name, $group, $cost, $grams, $fileNameTime, $stats]);
            }
            }
        }
    }

    protected function updateFood($name, $group, $cost, $grams, $stats, $fid){
        $sql = "UPDATE inventory SET item_name = '$name', item_group = '$group', cost = $cost, grams = grams + $grams, order_status = '$stats' WHERE fid = $fid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
    }

    protected function deleteFood($img, $fid){
        unlink($img);
        $sql = "DELETE FROM inventory WHERE fid='$fid'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
    }
}

?>