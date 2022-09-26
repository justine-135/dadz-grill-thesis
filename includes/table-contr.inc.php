<?php
    include 'autoload.inc.php';

    if (isset($_GET["contr"])) {
        $contr = $_GET["contr"];

        if ($contr == 1) {
            $timer = new TableContr();
            $timer->initTableTimer();
        }
    }

    elseif (isset($_POST["menu"])) {
        $tblId = $_POST["table-id"];

        $menu = new TableContr();
        $menu->initMenu($tblId);
    }

    elseif (isset($_POST["attended"])) {
        $tblId = $_POST["table-id"];

        $attended = new TableContr();
        $attended->initAttended($tblId);
    }

    elseif (isset($_POST["request"])) {
        $tblId = $_POST["table-id"];

        $attended = new TableContr();
        $attended->initRequest($tblId);
    }

    elseif (isset($_POST["clean"])) {
        $tblId = $_POST["table-id"];

        $clean = new TableContr();
        $clean->initClean($tblId);
    }   

    elseif (isset($_POST['TableStatus'])) {
        $button1_click = new TableContr();
        $button1_click->initNotify1();
    }

    else{
        header("location: ../menu.php");
    }
?>