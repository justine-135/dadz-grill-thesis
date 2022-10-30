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
            $sql = "UPDATE users SET is_active = is_active + 1 WHERE username='$userName'";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            $stmt = null;

            $sql = "SELECT * FROM users WHERE username = ? OR email = ? AND pwd = ?;";
            $stmt = $this->connection()->prepare($sql);
    
            if (!$stmt->execute(array($userName, $userName, $pass))) {
                $stmt = null;
                header("location: ../login.php?message=processfailed");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $user;

            exit();
        }
    }

    protected function logoutUser($username){
        $sql = "UPDATE users SET is_active = is_active - 1 WHERE username='$username'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
    }
}

?>