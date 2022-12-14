<?php
include "header.php";

if ($_SESSION["is_superuser"] == 1) {

?>

    <div class="overlay">
        <form class="form-overlay delete-account-form" action="includes/admin-contr.inc.php" method="post" enctype="multipart/form-data">
            <div class="head flex-row modal-head">
                <h4>Delete</h4>
                <button class="close-add-form" type="button"><svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
                    </svg></button>
            </div>
            <div class="body">

            </div>
            <div class="form-overlay-footer flex-row">
                <input type="submit" value="Submit" name="delete">
            </div>
        </form>
        <div class="form-overlay view-account-container" >
            <div class="head flex-row modal-head">
                <h4>Information</h4>
                <button class="close-add-form" type="button"><svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
                    </svg>
                </button>
            </div>
            <div class="body account-information">
            </div>
        </div>
    </div>

    <nav class="inventory-nav nav-page flex-row">
        <div class="title flex-row">
            <div class="circle-svg">
                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user" class="sidelink-svg svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path>
                </svg>
            </div>
            <h4>Accounts</h4>
        </div>
        <a href="compliance.php" class="add-admin-btn">Evaluate</a>
        <a href="login_history.php" class="add-admin-btn">History</a>
        <a href="registration.php?message" class="add-admin-btn">Add crew</a>
    </nav>

    <div class="main-content tables-container">
        <div class="tables">
            <table class="tables-table admin-table-info table">
            </table>
        </div>
    </div>

    <div class="alert-div">

    <?php
    if (isset($_GET["alert"])) {
        $alert = $_GET["alert"];
        if ($alert == "deleted") {
            $id = $_GET["id"];
            ?>
        <div class="alert alert-success d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
        Deleted user <strong class="ms-1"><?php echo $id ?></strong> successfully. 
        </div>
            <?php
        } elseif ($alert == "pwdchange") {
            $id = $_GET["id"];
            ?>
            <div class="alert alert-success d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            Changed password for user <strong class="mx-1"><?php echo $id ?></strong> successfully. 
            </div>
            <?php
        
        } elseif ($alert == "emptyinput") {
        ?>
        <div class="alert alert-danger d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
        Fill up inputs. 
        </div>
        <?php
        } elseif ($alert == "notmatch") {
            ?>
            <div class="alert alert-danger d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            Password don't match. 
            </div>
            <?php
        }
        elseif ($alert == "editrole") {
            $id = $_GET["id"];
            ?>
            <div class="alert alert-success d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            Changed user <strong class="mx-1"><?php echo $id ?> </strong> role successfully. 
            </div>
            <?php
        }
    }
    ?>
    </div>

    <script src="js/admin.js?v=<?php echo time(); ?>"></script>
<?php } else {
?>
    <nav class="inventory-nav nav-page flex-row">
        <div class="title flex-row">
            <div class="circle-svg">
                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user" class="sidelink-svg svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path>
                </svg>
            </div>
            <h4>Accounts</h4>
        </div>
    </nav>
    <div class="main-content tables-container">
        <div class="tables flex-row">
            <span>You do not have permission.</span>
        </div>
    </div>
<?php }
?>