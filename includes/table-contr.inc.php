<?php
    include 'autoload.inc.php';

    if (isset($_GET["contr"])) {
        $contr = $_GET["contr"];

        if ($contr == 1) {
            $timer = new TableContr();
            $timer->initTableTimer();
        }
    }

    if (isset($_POST["attended"])) {
        $tblId = $_POST["table-id"];

        $attended = new TableContr();
        $attended->initAttended($tblId);
    }

    if (isset($_POST["request"])) {
        $tblId = $_POST["table-id"];

        $attended = new TableContr();
        $attended->initRequest($tblId);
    }

?>