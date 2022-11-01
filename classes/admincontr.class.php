<?php

class AdminContr extends Admin
{
    public function initDelete($id)
    {
        $this->deleteAdmin($id);
    }

    public function initEditName($id, $fname, $lname)
    {

        if ($this->emptyInputName($fname, $lname) !== false) {
            header("location: ../profile.php?message=emptyinput");
            exit();
        }

        else{
            $result = $this->editName($id, $fname, $lname);
            session_start();
            $_SESSION["fullname"] = $result[0]["fullname"];
            $_SESSION["fname"] = $result[0]["fname"];
            $_SESSION["lname"] = $result[0]["lname"];
    
            header("location: ../profile.php?alert=updated&id=" . $id);
        }
    }

    public function initEditUserName($id, $username)
    {

        if ($this->emptyInputUid($username) !== false) {
            header("location: ../profile.php?message=emptyinput");
            exit();
        }
    
        if ($this->invalidUid($username)!==false) {
            header("location: ../profile.php?message=invaliduid");
            exit();
        }

        else{
            $result = $this->editUserName($id, $username);

            session_start();
            $_SESSION["username"] = $result[0]["username"];
    
            header("location: ../profile.php?alert=updated&id=" . $id);
        }

    }

    public function initEditContact($id, $contact)
    {

        if ($this->emptyInputContact($contact) !== false) {
            header("location: ../profile.php?message=emptyinput");
            exit();
        }
    
        if ($this->invalidContact($contact)!==false) {
            header("location: ../profile.php?message=invalidformat");
            exit();
        }

        else{
            $result = $this->editContact($id, $contact);

            session_start();
            $_SESSION["contact"] = $result[0]["contact"];

            header("location: ../profile.php?message=success");
        }

    }

    public function initEditPassword($id, $oldPwd, $newPwd, $reTypePwd)
    {

        if ($this->emptyInputPwd($oldPwd, $newPwd, $reTypePwd) !== false) {
            header("location: ../profile.php?message=emptyinput");
            exit();
        }
    
        if ($this->notMatchPwd($newPwd, $reTypePwd)!==false) {
            header("location: ../profile.php?message=notmatch");
            exit();
        }

        else{
            $result = $this->editPassword($id, $oldPwd, $newPwd, $reTypePwd);

        }

    }

    public function initEditRole($id, $role)
    {
        $this->editRole($id, $role);
        header("location: ../admins.php");
    }

    protected function emptyInputName($fname, $lname){
        $result;
        if (empty($fname) || empty($fname)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function emptyInputUid($username){
        $result;
        if (empty($username)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function emptyInputContact($contact){
        $result;
        if (empty($contact)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function emptyInputPwd($oldPwd, $newPwd, $reTypePwd){
        $result;
        if (empty($oldPwd) || empty($newPwd) || empty($reTypePwd)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function notMatchPwd($newPwd, $reTypePwd){
        $result;
        if ($newPwd !== $reTypePwd) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function invalidUid($username){
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
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
}
