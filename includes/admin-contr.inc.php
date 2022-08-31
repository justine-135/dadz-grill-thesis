<?php
    include 'autoload.inc.php';

    $id = $_POST["id-value"];

    if (isset($_POST["delete"])) {
        $deleteTable = new AdminContr();
        $deleteTable->initDelete($id);
    }
?>