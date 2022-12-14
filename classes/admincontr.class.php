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
    
            header("location: ../profile.php?message=success");
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
    
            header("location: ../profile.php?message=success");
        }

    }

    public function initEditEmail($id, $email)
    {

        if ($this->emptyInputEmail($email) !== false) {
            header("location: ../profile.php?message=emptyinput");
            exit();
        }
    
        if ($this->invalidEmail($email)!==false) {
            header("location: ../profile.php?message=invalidformat");
            exit();
        }

        else{
            $result = $this->editEmail($id, $email);

            session_start();
            $_SESSION["email"] = $result[0]["email"];

            header("location: ../profile.php?message=success");
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

    public function initEditPassword($id, $oldPwd, $newPwd, $reTypePwd, $isManager)
    {

        if ($this->emptyInputPwd($oldPwd, $newPwd, $reTypePwd, $isManager) !== false) {
            if ($isManager == 0) {
                header("location: ../profile.php?message=emptyinput");
                exit();
            }
            else{
                header("location: ../admins.php?alert=emptyinput");
                exit();
            }
        }
    
        if ($this->notMatchPwd($newPwd, $reTypePwd)!==false) {
            if ($isManager == 0) {
                header("location: ../profile.php?message=notmatch");
                exit();
            }
            else{
                header("location: ../admins.php?alert=notmatch");
                exit();
            }
        }

        else{
            $result = $this->editPassword($id, $oldPwd, $newPwd, $reTypePwd, $isManager);

        }

    }

    public function initEditRole($id, $role)
    {
        $this->editRole($id, $role);
        header("location: ../admins.php?alert=editrole&id=" . $id);
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

    protected function emptyInputEmail($email){
        $result;
        if (empty($email)) {
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

    protected function emptyInputPwd($oldPwd, $newPwd, $reTypePwd, $isManager){
        $result;

        if ($isManager == 0) {
            if (empty($oldPwd) || empty($newPwd) || empty($reTypePwd)) {
                $result = true;
            } else {
                $result = false;
            }
        }
        else{
            if (empty($newPwd) || empty($reTypePwd)) {
                $result = true;
            } else {
                $result = false;
            }
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

    protected function invalidEmail($email){
        $result;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
