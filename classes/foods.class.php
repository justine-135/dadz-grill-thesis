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

    protected function setFood($name, $group, $cost, $grams, $servings, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $inclusions, $serving, $inclusions_name){
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
            if(move_uploaded_file($fileTempLoc, $target)){
                $sql = "SELECT * FROM inventory WHERE item_name = '$name';";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
        
                $results = $stmt->fetchAll();

                if (count($results) > 0) {
                    $sql = "INSERT INTO inventory (item_name, item_group, cost, grams, serving, photo, order_status)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
                    
                    $stmt = $this->connection()->prepare($sql);
                    $stmt->execute([$name, $group, $cost, $grams, $servings, $fileNameTime, $stats]);
                    $stmt = null;
    
                    if ($inclusions != "") {
                        for ($i=0; $i < count($inclusions); $i++) { 
                            $sql = "INSERT INTO inclusions (fid, `name`, foreign_name, servings)
                            VALUES (?, ?, ?, ?)";
                            
                            $stmt = $this->connection()->prepare($sql);
                            $stmt->execute([$inclusions[$i], $inclusions_name[$i], $name, $serving[$i]]);
                            $stmt = null;
                            echo $inclusions[$i];
                        }
                    }
                }

            }
            }
        }
    }

    protected function updateFood($name, $group, $cost, $grams, $servings, $stats, $fid){
        $sql = "UPDATE inventory SET item_name = '$name', item_group = '$group', cost = $cost, grams = grams + $grams, serving = $servings, order_status = '$stats' WHERE fid = $fid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
    }

    protected function deleteFood($img, $fid){
        unlink($img);
        
        $sql = "SELECT * FROM inventory WHERE fid = '$fid' ;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $name = $row['item_name'];
        }


        $sql = "DELETE FROM inclusions WHERE foreign_name='$name'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "DELETE FROM inventory WHERE fid='$fid'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;


    }

    protected function getInclusions(){
        $sql = "SELECT * FROM inclusions;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results2 = $stmt->fetchAll();
        return $results2;
    }
}

?>