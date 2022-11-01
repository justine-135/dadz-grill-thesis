<?php
    include 'autoload.inc.php';

    $id = $_POST["id-value"];

    if (isset($_POST["delete"])) {
        $deleteAdmin = new AdminContr();
        $deleteAdmin->initDelete($id);
    }

    if (isset($_POST["name-change"])) {
        $fname = strtoupper($_POST['fname']);
        $lname = strtoupper($_POST['lname']);

        $editName = new AdminContr();
        $editName->initEditName($id, $fname, $lname);
    }

    if (isset($_POST["username-change"])) {
        $username = $_POST["username"];

        $editUserName = new AdminContr();
        $editUserName->initEditUserName($id, $username);
    }

    if (isset($_POST["contact-change"])) {
        $contact = $_POST["contact"];

        $editContact = new AdminContr();
        $editContact->initEditContact($id, $contact);
    }

    if (isset($_POST["pwd-change"])) {
        $oldPwd = $_POST["old-pwd"];
        $newPwd = $_POST["new-pwd"];
        $reTypePwd = $_POST["retype-pwd"];

        $editPassword = new AdminContr();
        $editPassword->initEditPassword($id, $oldPwd, $newPwd, $reTypePwd);
    }

    if (isset($_POST['edit-role'])) {
        $role = $_POST["role"];

        $editRole = new AdminContr();
        $editRole->initEditRole($id, $role);
    }
?>