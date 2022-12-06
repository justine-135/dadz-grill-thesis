<?php
    include 'autoload.inc.php';

    $id = $_POST["id-value"];
    $isManager = 0;

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

    if (isset($_POST["email-change"])) {
        $email = $_POST["email"];

        $editEmail = new AdminContr();
        $editEmail->initEditEmail($id, $email);
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
        $editPassword->initEditPassword($id, $oldPwd, $newPwd, $reTypePwd, $isManager);
    }

    if (isset($_POST['change-role'])) {
        $role = $_POST["role"];
        $editRole = new AdminContr();
        $editRole->initEditRole($id, $role);
    }

    if (isset($_POST['change-pass'])) {
        $oldPwd = "NANi";
        $newPwd = $_POST["new-pwd"];
        $reTypePwd = $_POST["retype-pwd"];
        $isManager = 1;
        echo $newPwd;
        echo $reTypePwd;
        echo $isManager;
        echo "HAHA";
        $editPassword = new AdminContr();
        $editPassword->initEditPassword($id, $oldPwd, $newPwd, $reTypePwd, $isManager);
    }
?>