<?php

class UserContr extends Users{
    private $userName;
    private $pass;
    private $confirmPass;
    private $fullName;
    private $email;
    private $contact;
    private $bDate;
    private $address;
    private $userType;
    private $username;

    public function __construct($userName, $pass, $confirmPass, $fname, $lname, $fullName, $email, $contact, $bDate, $address, $userType){
        $this->userName = $userName;
        $this->pass = $pass;
        $this->confirmPass = $confirmPass;
        $this->fullName = $fullName;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->contact = $contact;
        $this->bDate = $bDate;
        $this->address = $address;
        $this->userType = $userType;
    }
    public function initUser(){
        if ($this->emptyInput($this->userName, $this->pass, $this->confirmPass, $this->fname, $this->lname, $this->email, $this->contact, $this->bDate, $this->address) !== false) {
            header("location: ../registration.php?message=emptyinput");
            exit();
        }
    
        if ($this->invalidEmail($this->email)!==false) {
            header("location: ../registration.php?message=invalidemail");
            exit();
        }
    
        if ($this->invalidContact($this->contact)!==false) {
            header("location: ../registration.php?message=invalidcontact");
            exit();
        }
    
        if ($this->invalidUid($this->userName)!==false) {
            header("location: ../registration.php?message=invaliduser");
            exit();
        }
    
        if ($this->pwdMatch($this->pass, $this->confirmPass)!==false) {
            header("location: ../registration.php?message=passwordmatch");
            exit();
        }
        
        if ($this->userExist($this->userName, $this->fullName)!==false) {
            header("location: ../registration.php?message=userexist");
            exit();
        }
        else{
            $this->setUser($this->userName, $this->pass, $this->confirmPass, $this->fullName, $this->email, $this->contact, $this->bDate, $this->address, $this->userType);
        }
    }

    protected function emptyInput($userName, $pass,  $confirmPass, $fname, $lname, $email, $contact, $bDate, $address){
        $result;
        if (empty($userName) || empty($pass) || empty($confirmPass) || empty($fname) || empty($lname) || empty($email) || empty($contact) || empty($bDate) || empty($address)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function invalidUid($userName){
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function invalidContact($contact){
        $result;
        if (strlen($contact) != 11) {
            $result = true;
        } else {
            if (!preg_match("/^[0-9]*$/", $contact)) {
                $result = true;
            } else {
                if ($contact[0] != "0" || $contact[1] != "9") {
                    $result = true;
                } else {
                    $result = false;
                }
            }
        }
        return $result;
    }

    protected function invalidEmail($email){
        $result;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function pwdMatch($pass, $confirmPass){
        $result;
        if ($pass != $confirmPass) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function initLoginUser(){
        if ($this->emptyLoginInput($this->userName, $this->pass) !== false) {
            header("location: ../login.php?message=emptyinput");
            exit();
        }
        $result = $this->loginUser($this->userName, $this->pass);
        session_start();
        $_SESSION["username"] = $result[0]["username"];
        $_SESSION["userFullname"] = $result[0]["fullname"];
        $_SESSION["email"] = $result[0]["email"];
        $_SESSION["contact"] = $result[0]["contact"];
        $_SESSION["bday"] = $result[0]["birth_date"];
        $_SESSION["address"] = $result[0]["location_address"];
        $_SESSION["is_superuser"] = $result[0]["is_superuser"];
        $_SESSION["is_cashier"] = $result[0]["is_cashier"];
        $_SESSION["is_waiter"] = $result[0]["is_waiter"];
        $_SESSION["is_cook"] = $result[0]["is_cook"];
        $_SESSION["is_cleaner"] = $result[0]["is_cleaner"];
        $_SESSION["uid"] = $result[0]["id"];
        header("location: ../index.php");

    }

    protected function emptyLoginInput($userName, $pass){
        $result;
        if (empty($userName) || empty($pass)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function initLogoutUser(){
        $this->logoutUser($this->userName);

        unset($_SESSION["username"]);
        unset($_SESSION["userFullname"]);
        unset($_SESSION["is_superuser"]);
        unset($_SESSION["is_cashier"]);
        unset($_SESSION["is_waiter"]);
        unset($_SESSION["is_cook"]);
        unset($_SESSION["is_cleaner"]);
    
        header("location: ../login.php?message=");
    }
    
}

?>