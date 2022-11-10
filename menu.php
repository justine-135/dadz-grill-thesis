<?php include "header.php";

if ($_SESSION["is_superuser"] == 1 || $_SESSION["is_waiter"] == 1) {

?>

    <div class="overlay">
        <form class="action-btn-modal waiter-form" id="waiter-form" action="./includes/table-contr.inc.php" method="post" enctype="multipart/form-data">
            <div class="head flex-row modal-head">
                <h4 class="action-modal-head"></h4>
                <button type="button"><svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
                    </svg></button>
            </div>
            <div class="body flex-row btn-group">
                <input type="submit" value="Menu" name="menu" id="menu">
                <input type="submit" value="Attend" id="attend" name="attended">
                <!-- <input type="button" value="Attend" id="attend2"> -->
                <input type="submit" value="Request bill" name="request" id="request">
                <input class="hide" type="text" id="table-id" name="table-id">
            </div>
            <div class="series-orders-attend hide"></div>
                        <!-- <div class="btn-group flex-column">
                <div class="body flex-row">
                    <input type="submit" value="Menu" name="menu">
                    <input type="submit" value="Attended" name="attended">
                    <input type="submit" value="Request bill" name="request">
                    <input class="hide" type="text" id="table-id" name="table-id">
                </div> 

                <table class="tables-table">
                    <thead>
                        <tr>
                            <th>Orders</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Set A(1)</td>
                            <td><button>Attend</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>-->
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
            <h4>Menu</h4>
            <button class="legend-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 96c-17.7 0-32 14.3-32 32s-14.3 32-32 32s-32-14.3-32-32C0 75 43 32 96 32h97c70.1 0 127 56.9 127 127c0 52.4-32.2 99.4-81 118.4l-63 24.5 0 18.1c0 17.7-14.3 32-32 32s-32-14.3-32-32V301.9c0-26.4 16.2-50.1 40.8-59.6l63-24.5C240 208.3 256 185 256 159c0-34.8-28.2-63-63-63H96zm48 384c-22.1 0-40-17.9-40-40s17.9-40 40-40s40 17.9 40 40s-17.9 40-40 40z"/></svg>
            </button>
        </div>
    </nav>
    <div class="legend-list">
    <div class="col1">
        <div>
            <span class="legend-title">Table statuses</span>
            <ul>
                <li class="flex-row"><span class="table-data-status red"></span> <span>Occupied</span> </li>
                <li class="flex-row"><span class="table-data-status green"></span> <span>Unoccupied</span> </li>
                <li class="flex-row"><span class="table-data-status yellow"></span> <span>Calling assistance</span> </li>
                <li class="flex-row"><span class="table-data-status blue"></span> <span>Dirty</span> </li>
            </ul>
        </div>
        <div>
            <span class="legend-title">Time</span>
            <ul>
                <li class="flex-row"><span class="table-data-status gray"></span> <span>Not running</span> </li>
                <li class="flex-row"><span class="table-data-status blue"></span> <span>Running</span> </li>
                <li class="flex-row"><span class="table-data-status notify"></span> <span>Notify customers 15 minutes</span> </li>
                <li class="flex-row"><span class="table-data-status red"></span> <span>Time reached 2 hours</span> </li>
                <li class="flex-row"><span class="table-data-status green"></span> <span>Done</span> </li>
            </ul>
        </div>
    </div>
    <div class="col2">
        <div>
            <span class="legend-title">Payment</span>
            <ul>
            <li class="flex-row"><span class="table-data-status nopayment"><span></span></span> <span>Table has no order</span> </li>
                <li class="flex-row"><span class="table-data-status pendingpayment"><span></span></span> <span>Table is waiting for payment</span> </li>
                <li class="flex-row"><span class="table-data-status requestingpayment"><span></span></span> <span>Table is requesting for bill</span> </li>
                <li class="flex-row"><span class="table-data-status completepayment"><span></span></span> <span>Payment is complete</span> </li>
            </ul>
        </div>
        <div>
            <span class="legend-title">Order status</span>
            <ul>
            <li class="flex-row"><span class="table-data-status nopayment"><span></span></span> <span>Table has no order</span> </li>
                <li class="flex-row"><span class="table-data-status pendingpayment"><span></span></span> <span>Prepairing order</span> </li>
                <li class="flex-row"><span class="table-data-status requestingpayment"><span></span></span> <span>Order is ready to pick-up</span> </li>
                <li class="flex-row"><span class="table-data-status completepayment"><span></span></span> <span>Order is served complete</span> </li>
            </ul>
        </div>
    </div>
</div>
    <div class="main-content tables-container waiter-tbl">
        <div class="tables waiter-tbl">
            <table class="tables-table waiter-table waiter-tbl-data table">
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