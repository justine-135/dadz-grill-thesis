<?php

class AdminContr extends Admin
{
    public function initDelete($id)
    {
        $this->deleteAdmin($id);
    }

    public function initEdit($id, $fullname, $email, $contact, $bday, $address)
    {
        $this->editAdmin($id, $fullname, $email, $contact, $bday, $address);

        // session_start();
        // $_SESSION["username"] = $result[0]["username"];
        $_SESSION["userFullname"] = $result[0]["fullname"];
        $_SESSION["email"] = $result[0]["email"];
        $_SESSION["contact"] = $result[0]["contact"];
        $_SESSION["bday"] = $result[0]["birth_date"];
        $_SESSION["address"] = $result[0]["location_address"];
        header("location: ../profile.php?alert=updated&id=" . $id);

    }
}
