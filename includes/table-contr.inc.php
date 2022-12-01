<?php
    include 'autoload.inc.php';

    if (isset($_GET["contr"])) {
        $contr = $_GET["contr"];
        $id = $_GET["id"];

        if ($contr == 1) {
            $timer = new TableContr($id);
            $timer->initStopTableTimer($id);
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

    elseif (isset($_POST['occupy'])) {
        $tblId = $_POST["table-id"];

        $occupy = new TableContr();
        $occupy->initOccupy($tblId);
    }

    elseif (isset($_POST['unoccupy'])) {
        $tblId = $_POST["table-id"];

        $unoccupy = new TableContr();
        $unoccupy->initUnoccupy($tblId);
    }

    elseif (isset($_POST['call'])) {
        $tblId = $_POST["table-id"];

        $call = new TableContr();
        $call->initCall($tblId);
    }

    elseif (isset($_POST['TableStatus'])) {
        $id = $_POST['TableStatus'];

        $buttonClick = new TableContr($id);
        $buttonClick->initNotify($id);
    }

    elseif (isset($_POST['getID'])){
        $id = $_POST['getID'];

        $getID = new TableContr($id);
        $getID->initGetId($id);
    }

    elseif (isset($_POST['counter'])){
        $counter = $_POST['counter'];
        // echo $counter;
        $counter = new TableContr($id);
        $counter->initCounter($id);

        echo $counter;
    }

    elseif (isset($_POST['add-table'])) {
        $tableNumber = $_POST["table-id"];

        if (!preg_match("/^[0-9]*$/", $tableNumber)) {
            header("location: ../setting.php");
        }
        else{
            $addTable = new TableContr($tableNumber);
            $addTable->initTable($tableNumber);
        }
    }

    elseif (isset($_POST['delete-table'])) {
        $tableNumber = $_POST['table-id'];

        $deleteTable = new TableContr($tableNumber);
        $deleteTable->initDeleteTable($tableNumber);
    }

    // else{
    //     header("location: ../menu.php");
    // }
?>