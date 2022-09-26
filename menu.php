<?php include "header.php";

if ($_SESSION["is_superuser"] == 1 or $_SESSION["is_waiter"] == 1) {

?>

    <div class="overlay">
        <form class="action-btn-modal" action="./includes/table-contr.inc.php" method="post" enctype="multipart/form-data">
            <div class="head flex-row modal-head">
                <h4 class="action-modal-head"></h4>
                <button type="button"><svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
                    </svg></button>
            </div>
            <div class="body flex-row">
                <input type="submit" value="Menu" name="menu">
                <input type="submit" value="Attended" name="attended">
                <input type="submit" value="Request bill" name="request">
                <input class="hide" type="text" id="table-id" name="table-id">
            </div>
        </form>
    </div>

    <nav class="inventory-nav nav-page flex-row">
        <div class="title flex-row">
            <div class="circle-svg">
                <svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M0 96C0 60.65 28.65 32 64 32H448C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96zM64 160H128V96H64V160zM448 96H192V160H448V96zM64 288H128V224H64V288zM448 224H192V288H448V224zM64 416H128V352H64V416zM448 352H192V416H448V352z" />
                </svg>
            </div>
            <h3>Menu</h3>
        </div>
        <div class="legend-container">
        <button class="legend-btn"><span>Legend</span></button>
        <div class="legend-list">
            <span>Table statuses</span>
            <ul>
                <li class="flex-row"><span class="table-data-status red"></span> <span>Occupied</span> </li>
                <li class="flex-row"><span class="table-data-status green"></span> <span>Unoccupied</span> </li>
                <li class="flex-row"><span class="table-data-status yellow"></span> <span>Calling assistance</span> </li>
                <li class="flex-row"><span class="table-data-status blue"></span> <span>Dirty</span> </li>
            </ul>
        </div>
    </div>
    </nav>
    <div class="main-content tables-container waiter-tbl">
        <div class="tables waiter-tbl">
            <table class="tables-table waiter-table waiter-tbl-data">
            </table>
        </div>
    </div>

    <div class="alert">

        <?php

        if (isset($_GET["alert"]) || isset($_GET["id"])) {
            $alert = $_GET["alert"];
            $id = $_GET["id"];
            if ($alert == "no_order") {
                echo "<span class='query-notif fail'>Table " . $id . " has not ordered, or has incomplete order.</span>";
            } elseif ($alert == "order_done") {
                echo "<span class='query-notif success'>Table " . $id . " order has been submitted!</span>";
            } elseif ($alert == "has_order") {
                echo "<span class='query-notif success'>Table " . $id . " has been attended!</span>";
            } elseif ($alert == "request") {
                echo "<span class='query-notif success'>Table " . $id . " has submitted a bill request!</span>";
            } else {
                echo "<span></span>";
            }
        }

        ?>

    </div>

    <script src="js/menu.js"></script>

<?php } else {
?>
    <nav class="inventory-nav nav-page flex-row">
        <div class="title flex-row">
            <div class="circle-svg">
                <svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M0 96C0 60.65 28.65 32 64 32H448C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96zM64 160H128V96H64V160zM448 96H192V160H448V96zM64 288H128V224H64V288zM448 224H192V288H448V224zM64 416H128V352H64V416zM448 352H192V416H448V352z" />
                </svg>
            </div>
            <h3>Menu</h3>
        </div>
    </nav>
    <div class="main-content tables-container">
        <div class="tables flex-row">
            <span>You do not have permission.</span>
        </div>
    </div>
<?php }
?>