<?php

class Admin extends Dbh{
    protected function deleteAdmin($id){
        $sql = "DELETE FROM users WHERE id='$id'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        header("location: ../admins.php?alert=deleted&id=" . $id);
    }
}

?>