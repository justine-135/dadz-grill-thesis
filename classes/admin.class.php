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

    protected function editRole($id, $role){
        switch ($role) {
            case 'Cashier':
                $sql = "UPDATE users SET is_cashier = 1, is_waiter = 0, is_cleaner = 0, is_cook = 0 WHERE id = $id";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                break;
            case 'Waiter':
                $sql = "UPDATE users SET is_cashier = 0, is_waiter = 1, is_cleaner = 0, is_cook = 0 WHERE id = $id";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                break;
            case 'Cleaner':
                $sql = "UPDATE users SET is_cashier = 0, is_waiter = 0, is_cleaner = 1, is_cook = 0 WHERE id = $id";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                break;
            case 'Cook':
                $sql = "UPDATE users SET is_cashier = 0, is_waiter = 0, is_cleaner = 0, is_cook = 1 WHERE id = $id";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
                break;
            
            default:
                # code...
                break;
        }

    }
}

?>