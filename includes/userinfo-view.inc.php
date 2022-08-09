<?php
    include 'autoload.inc.php';

    if (isset($_GET["id"])) {
        $uid = $_GET["id"];

        $userInfo = new UsersView();
        $userInfo->initGetUser($uid);
    }

?>