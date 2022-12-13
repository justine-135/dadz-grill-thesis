<?php
include "header.php";

if ($_SESSION["is_superuser"] == 1 || $_SESSION["is_cashier"]) {
    unset($_SESSION["bill_id"]);

?>

    <div class="overlay">
        <div class="order-info">
            <div class="head flex-row">
                <h4 class="order-tbl-number"></h4>
                <button class="close-order-btn">Close</button>
            </div>
            <div class="body order-information"></div>
        </div>
    </div>

    <nav class="inventory-nav nav-page flex-row">
        <div class="title flex-row">
            <div class="circle-svg">
                <svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M0 96C0 60.65 28.65 32 64 32H448C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96zM64 160H128V96H64V160zM448 96H192V160H448V96zM64 288H128V224H64V288zM448 224H192V288H448V224zM64 416H128V352H64V416zM448 352H192V416H448V352z" />
                </svg>
            </div>
            <h4>Transactions</h4>
        </div>
        <div class="dropdown date-transaction ">
            <button class="btn dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Select date
            </button>
            <ul class="dropdown-menu">
                <li class="ps-2">
                    <span>Start time:</span>
                    <input type="date" name="" id="" class="search-transaction" placeholder="start date">
                </li>
                <li class="ps-2 mt-2">
                    <span>End time:</span>
                    <input type="date" name="" id="" class="search-transaction-2" placeholder="start date">
                </li>
            </ul>
        </div>
        <select class="form-select form-select select-date ms-1" id="transaction-export" aria-label=".form-select-sm example">
            <option value="export-transaction-opt">Transaction</option>
            <option value="export-sales-report-opt">Sales Report</option>
        </select>
        <button class="btn bg-light ms-1 csvHtml5-transaction">Export</button>
    </nav>

    <div class="main-content tables-container">
        <div class="tables flex-row">
            <table class="tables-table transaction-tbl-data table hide"></table>
            <table class="tables-table transaction-tbl-data-date table"></table>
            <table class="export-transaction-tbl hide"></table>
            <table class="export-transaction-tbl-date hide"></table>
            <table class="export-sales-report-tbl hide"></table>
            <table class="export-sales-report-tbl-date hide"></table>
        </div>
    </div>
    <script src="js/transactions.js"></script>

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
            <h4>Transactions</h4>
        </div>
    </nav>

    <div class="main-content tables-container">
        <div class="tables flex-row">
            <span>You do not have permission.</span>
        </div>
    </div>
<?php }
?>