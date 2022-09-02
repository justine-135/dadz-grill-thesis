<?php

class Admin extends Dbh{
    protected function deleteAdmin($id){
        $sql = "DELETE FROM users WHERE id='$id'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        header("location: ../admins.php?alert=deleted&id=" . $id);
    }

    protected function editAdmin($id, $fullname, $email, $contact, $bday, $address){
        $sql = "UPDATE users SET fullname = '$fullname', email = '$email', contact = $contact, birth_date = '$bday', location_address = '$address' WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
    }
}

?>