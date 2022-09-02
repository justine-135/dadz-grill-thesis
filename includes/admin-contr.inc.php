<?php
    include 'autoload.inc.php';

    $id = $_POST["id-value"];

    if (isset($_POST["delete"])) {
        $deleteAdmin = new AdminContr();
        $deleteAdmin->initDelete($id);
    }

    if (isset($_POST["edit"])) {
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $bday = $_POST["bdate"];
        $address = $_POST["address"];

        $editAdmin = new AdminContr();
        $editAdmin->initEdit($id, $fullname, $email, $contact, $bday, $address);
    }
?>