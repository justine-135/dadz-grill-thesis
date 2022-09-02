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
        header("location: ../profile.php?alert=updated&id=" . $id);

    }
}
