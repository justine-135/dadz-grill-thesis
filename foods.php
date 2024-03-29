<?php include "header.php";
if ($_SESSION["is_superuser"] == 1) {

?>

    <div class="overlay">
        <form class="form-overlay insert-item-form" action="includes/food-contr.inc.php" id="insert-ing" method="post" enctype="multipart/form-data">
            <div class="head flex-row modal-head">
                <h4>Add Item</h4>
                <button class="close-add-form" type="button"><svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
                    </svg></button>
            </div>
            <div class="col1 add-item-div">
                <div class="add-code flex-row">
                    <span>Item Name:</span>
                    <input type="text" name="name" id="insert-name-val" required>
                </div>
                <div class="add-code flex-row">
                    <span>Item Group:</span>
                    <select class="stat-select add-select-group" name="group" id="" required>
                        <option value="Sets">Main set</option>
                        <option value="Meat">Meat</option>
                        <option value="Sides">Sides</option>
                        <option value="Drinks">Drinks</option>
                        <option value="Addons">Add-ons</option>
                    </select>
                </div>
                <div class="add-code flex-row">
                    <span>Price:</span>
                    <input type="text" name="cost" id="num" placeholder="₱" required>
                </div>
                <div class="add-code flex-row grams-input hide">
                    <span>Grams:</span>
                    <input type="text" name="grams" id="grams" placeholder="g">
                </div>
                <div class="add-code flex-row servings-input hide">
                    <span>Serving:</span>
                    <input type="text" name="servings" id="servings" placeholder="g">
                </div>
                <div class="add-code flex-row">
                    <span>Show:</span>
                    <select class="stat-select" name="stats" id="" required>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>
                <div class="flex-row add-file add-code">
                    <span>Image:</span>
                    <input type="file" name="photo" id="" accept="image/png, image/gif, image/jpeg" required>
                </div>
                <div class="add-inclusion">
                    <div class="flex-row add-code">
                        <span>Inclusions 1: </span>
                        <div >
                            <div class="flex-row"  style="width: 70%;">
                            <?php include "includes/foods-view-select.inc.php"; ?>
                            <input class="ms-1" style="width: 50px" name="serving[]" type="number" placeholder="g" min=0 max=500 />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-row add-remove-inclusions-div add-code">
                    <button class="btn btn-primary add-inclusion-btn" type="button" style="margin-left: auto">Add more</button>
                    <button class="btn btn-danger delete-inclusion-btn" type="button" style="margin-left: 5px">Remove</button>
                </div>
            </div>
            <div class="form-overlay-footer flex-row">
                <input id="submit-meal" type="submit" value="Submit" name="insert">
            </div>
        </form>

        <form class="form-overlay update-item-form" action="includes/food-contr.inc.php" method="post" enctype="multipart/form-data">
            <div class="head flex-row modal-head">
                <h4>Update Item</h4>
                <button class="close-add-form" type="button"><svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
                    </svg></button>
            </div>
            <div class="col1 edit-item-div">
                <div class="add-code flex-row">
                    <span>Item Name:</span>
                    <input class="upd-ing-name" type="text" name="name" id="insert-name-val" required>
                </div>
                <div class="add-code flex-row hide">
                    <span>Item Group:</span>
                    <select class="upd-ing-group" name="group" id="" required>
                        <option value="Sets">Main set</option>
                        <option value="Meat">Meat</option>
                        <option value="Sides">Sides</option>
                        <option value="Drinks">Drinks</option>
                        <option value="Addons">Add-ons</option>
                    </select>
                </div>
                <div class="add-code flex-row">
                    <span>Price:</span>
                    <input class="upd-ing-cost" type="text" name="cost" id="num" required>
                </div>
                <div class="add-code flex-row edit-grams-div hide">
                    <span>Add Grams:</span>
                    <input class="upd-ing-grams" type="text" name="grams">
                    <input class="upd-ing-grams2" type="text" name="grams2" hidden>
                </div>
                <div class="add-code flex-row edit-servings-div hide">
                    <span>Serving:</span>
                    <input class="upd-ing-servings" type="text" name="servings" id="servings" placeholder="g">
                </div>
                <div class="add-code flex-row">
                    <span>Show:</span>
                    <select class="upd-ing-stat" name="stats" id="" required>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>
                <div class="edit-inclusions hide">
                    <span>Inclusions:</span>
                    <div class="inclusions-table"></div>
                </div>
                <input class="upd-ing-id hide" type="text" name="upd-ing-id" id="">
            </div>
            <div class="form-overlay-footer flex-row">
                <input type="submit" value="Submit" name="update">
            </div>
        </form>


        <form class="form-overlay delete-item-form" action="includes/food-contr.inc.php" method="post" enctype="multipart/form-data">
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
    </div>


    <nav class="inventory-nav nav-page flex-row">
        <div class="title flex-row">
            <div class="circle-svg">
                <svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M234.5 5.709C248.4 .7377 263.6 .7377 277.5 5.709L469.5 74.28C494.1 83.38 512 107.5 512 134.6V377.4C512 404.5 494.1 428.6 469.5 437.7L277.5 506.3C263.6 511.3 248.4 511.3 234.5 506.3L42.47 437.7C17 428.6 0 404.5 0 377.4V134.6C0 107.5 17 83.38 42.47 74.28L234.5 5.709zM256 65.98L82.34 128L256 190L429.7 128L256 65.98zM288 434.6L448 377.4V189.4L288 246.6V434.6z" />
                </svg>
            </div>
            <h4>Foods</h4>
        </div>
        <button class="add-item-btn">Add item</button>
    </nav>

    <div class="main-content tables-container">
        <div class="tables">
            <table class="tables-table foods-table table">
                <?php include "includes/foods-view.inc.php"; ?>
            </table>
        </div>

    </div>

    <div class="alert-div">
    <?php
    if (isset($_GET["alert"]) || isset($_GET["id"])) {
        $alert = $_GET["alert"];
        $id = $_GET["id"];
        if ($alert == "store") {
            ?>
            <!-- echo "<span class='query-notif fail'>No bill request for table " . $id . "!</span>"; -->
            <div class="alert alert-success d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            New food inserted.
            </div>
            <?php
        } elseif ($alert == "update") {
            ?>
            <!-- echo "<span class='query-notif fail'>No bill request for table " . $id . "!</span>"; -->
            <div class="alert alert-success d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            Food <strong class="mx-1"><?php echo $id; ?></strong> is updated.
            </div>
            <?php
        } elseif ($alert == "store_no") {
            ?>
            <!-- echo "<span class='query-notif fail'>No bill request for table " . $id . "!</span>"; -->
            <div class="alert alert-danger d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            No food is stored.
            </div>
            <?php
        } elseif ($alert == "delete") {
            ?>
            <!-- echo "<span class='query-notif fail'>No bill request for table " . $id . "!</span>"; -->
            <div class="alert alert-success d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            Food <strong class="mx-1"><?php echo $id; ?></strong> is deleted.
            </div>
            <?php
        } else {
            echo "<span></span>";
        }
    }
    ?>
</div>



    <script src="js/inventory.js?v=<?php echo time(); ?>"></script>

<?php } else {
?>
    <nav class="inventory-nav nav-page flex-row">
        <div class="title flex-row">
            <div class="circle-svg">
                <svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M234.5 5.709C248.4 .7377 263.6 .7377 277.5 5.709L469.5 74.28C494.1 83.38 512 107.5 512 134.6V377.4C512 404.5 494.1 428.6 469.5 437.7L277.5 506.3C263.6 511.3 248.4 511.3 234.5 506.3L42.47 437.7C17 428.6 0 404.5 0 377.4V134.6C0 107.5 17 83.38 42.47 74.28L234.5 5.709zM256 65.98L82.34 128L256 190L429.7 128L256 65.98zM288 434.6L448 377.4V189.4L288 246.6V434.6z" />
                </svg>
            </div>
            <h4>Foods</h4>
        </div>
    </nav>
    <div class="main-content tables-container">
        <div class="tables flex-row">
            <span>You do not have permission.</span>
        </div>
    </div>
<?php }
?>