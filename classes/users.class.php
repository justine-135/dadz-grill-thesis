<?php

class Users extends Dbh{

    protected function getUsers(){
        $sql = "SELECT * FROM users";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getUser($uid){
        $sql = "SELECT * FROM users WHERE id=$uid";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;    
    }

    protected function getHistory(){
        $sql = "SELECT * FROM login_history";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;    
    }

    protected function getHistoryDate($date, $date2){
        // $sql = "SELECT * FROM login_history WHERE last_login LIKE '$dateLike'";
        $sql = "SELECT * FROM login_history WHERE DATE(last_login) BETWEEN '$date' AND '$date2'";

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;    
    }

    protected function setUser($userName, $pass, $confirmPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, $userType){
        $sql = "INSERT INTO users (username, pwd, fname, lname, fullname, email, contact, birth_date, location_address, 
        is_superuser, is_cashier, is_waiter, is_cook, is_cleaner, is_active, served) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $this->connection()->prepare($sql);

        $status = 0;
        $status_true = 1;

        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        if ($userType == "cashier") {
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$userName, $hashedPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, 
            $status, $status_true, $status, $status, $status, $status, $status]);   
        }
        if ($userType == "waiter") {  
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$userName, $hashedPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, 
            $status, $status, $status_true, $status, $status, $status, $status]);  
        }
        if ($userType == "cook") {
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$userName, $hashedPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, 
            $status, $status, $status, $status_true, $status, $status, $status]);         
        }
        if ($userType == "cleaner") {
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$userName, $hashedPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, 
            $status, $status, $status, $status, $status_true, $status, $status]); 
        }
        header("location: ../admins.php");
        exit();
    }

    protected function userExist($userName, $email){
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
        $stmt = $this->connection()->prepare($sql);

        if (!$stmt->execute(array($userName, $email))) {
            header("location: ../registration.php?message=processfailed");
            exit();
        }

        $result;
        if ($stmt->rowCount() > 0) {
            $result = true;
        }
        else{
            $result = false;
            return $result;
        }
    }

    // for login

    protected function emptyLoginInput($userName, $pass){
        $result;
        if (empty($userName) || empty($pass)) {
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    protected function loginUser($userName, $pass){
        $sql = "SELECT pwd FROM users WHERE username = ? OR email = ?;";
        $stmt = $this->connection()->prepare($sql);

        if (!$stmt->execute(array($userName, $pass))) {
            $stmt = null;
            header("location: ../login.php?message=processfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../login.php?message=invalidlogin");
            exit();
        }

        $hashedPass = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPass = password_verify($pass, $hashedPass[0]["pwd"]);

        if ($checkPass === false) {
            header("location: ../login.php?message=invalidlogin");
            exit();
        }
        elseif($checkPass === true){
            $browser = include "../includes/getbrowser.inc.php";
            date_default_timezone_set('Asia/Manila');
            $dateNow = date("Y-m-d h:i:sa");
            $savedLogin = date("Y-m-d h:i:sa");
            $sql = "UPDATE users SET reg_date = reg_date, last_login = '$dateNow', is_active = is_active + 1 WHERE username='$userName'";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;

            $sql = "SELECT * FROM users WHERE username = ? OR email = ? AND pwd = ?;";
            $stmt = $this->connection()->prepare($sql);
    
            if (!$stmt->execute(array($userName, $userName, $pass))) {
                $stmt = null;
                header("location: ../login.php?message=processfailed");
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["last_login_datetime"] = $dateNow;
            $sql = "INSERT INTO login_history (`user_id`, fullname, last_login, browser) VALUES (?,?,?,?);";    
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$user[0]["id"], $user[0]["fullname"], $dateNow, $browser]);   
            $stmt = null;

            return $user;

            exit();
        }
    }

    protected function logoutUser($username){
        date_default_timezone_set('Asia/Manila');
        $dateNow = date("Y-m-d h:i:sa");
        $sql = "UPDATE users SET reg_date = reg_date, last_logout = '$dateNow', is_active = is_active - 1 WHERE username='$username'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $id = $_SESSION["uid"];
        
        $sql = "SELECT * FROM users WHERE id=$id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        foreach ($results as $row) {
            $lastLogin = $row["last_login"];
        }
        $stmt = null;

        session_start();
        $last_login_datetime = $_SESSION["last_login_datetime"];
        $sql = "UPDATE login_history SET last_logout = '$dateNow' WHERE last_login='$last_login_datetime'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
    }

    protected function getUserCompliance($date, $date2){
        if (empty($date) || empty($date2)) {
            $sql = "SELECT users.id, users.username, users.is_superuser, users.is_cashier, users.is_waiter, users.is_cook, users.is_cleaner, SUM(served.served), served.date_time
            FROM `served`, `users` 
            WHERE users.id = served.user_id
            GROUP BY users.username";
    
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
    
            return $results;
        }
        else{
            $sql = "SELECT users.id, users.username, users.is_superuser, users.is_cashier, users.is_waiter, users.is_cook, users.is_cleaner, SUM(served.served), served.date_time
            FROM `served`, `users` 
            WHERE users.id = served.user_id
            AND DATE(date_time) BETWEEN '$date' AND '$date2'
            GROUP BY users.username";
    
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
    
            return $results;
        }
 
    }
}

?>