<?php

class Admin extends Dbh{
    protected function deleteAdmin($id){
        $sql = "DELETE FROM users WHERE id='$id'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        header("location: ../admins.php?alert=deleted&id=" . $id);
    }

    protected function editName($id, $fname, $lname){
        $fullName = $fname . " " . $lname;
        $sql = "UPDATE users SET reg_date = reg_date, fname = '$fname', lname = '$lname', fullname = '$fullName' WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "SELECT * FROM users WHERE id=$id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

    protected function editUserName($id, $username){
        $sql = "UPDATE users SET reg_date = reg_date, username = '$username' WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "SELECT * FROM users WHERE id=$id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

    protected function editPassword($id, $oldPwd, $newPwd, $reTypePwd){

        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$id]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $hashedPass = substr($results[0]["pwd"], 0, 60);
        $checkPass = password_verify($oldPwd, $hashedPass);

        if ($checkPass === true) {
            $newHashedPass = password_hash($newPwd, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET reg_date = reg_date, pwd = '$newHashedPass' WHERE id = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$id]);
            $stmt = null;

            header("location: ../profile.php?alert" . $id);
        }
        else{
            header("location: ../profile.php?message=invalid");

        }

    }

    protected function editContact($id, $contact){
        $sql = "UPDATE users SET reg_date = reg_date, contact = '$contact' WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $stmt = null;

        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$id]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
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
                break;
        }

    }

}
?>