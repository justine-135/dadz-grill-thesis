<?php
include "header.php";

if ($_SESSION["is_superuser"] == 1) {

?>
    <nav class="inventory-nav nav-page flex-row">
        <div class="title flex-row">
            <div class="circle-svg">
                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user" class="sidelink-svg svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path>
                </svg>
            </div>
            <h3>History</h3>
        </div>
        <input type="date" name="" id="" class="search-login-history">
        <button class="add-item-btn csvHtml5">Export</button>

    </nav>

    <div class="main-content tables-container">
        <div class="tables">
            <table class="tables-table loginhistory-table-info hide">
            </table>
            <table class="tables-table loginhistory-table-info-date">
            </table>
        </div>
    </div>

    <div class="alert">

    <?php

    if (isset($_GET["alert"]) || isset($_GET["id"])) {
        $alert = $_GET["alert"];
        $id = $_GET["id"];
        if ($alert == "deleted") {
            echo "<span class='query-notif success'>User " . $id . " has been deleted!</span>";
        } else {
            echo "<span></span>";
        }
    }

    ?>

    </div>
    <script src="js/login_history.js"></script>

<?php } else {
?>
    <nav class="inventory-nav nav-page flex-row">
        <div class="title flex-row">
            <div class="circle-svg">
                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user" class="sidelink-svg svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path>
                </svg>
            </div>
            <h3>Accounts</h3>
        </div>
        <a href="registration.php?message" class="add-admin-btn">Add admin</a>
    </nav>
    <div class="main-content tables-container">
        <div class="tables flex-row">
            <span>You do not have permission.</span>
        </div>
    </div>
<?php }
?>