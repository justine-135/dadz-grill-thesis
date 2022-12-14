<?php
session_start();
if (empty($_SESSION["username"])) {
    header("location: login.php?message=");
}

if (!isset($_SESSION["table"])){
    header("location: menu.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Passion+One:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="shortcut icon" href="./img/icons/logo.jpg" type="image/x-icon">
    <title>Dadz Grillhouse</title>
</head>

<body>
    <nav class="store-nav flex-row">
        <div class="logo flex-row">
            <svg class="store-back-icon icons" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
            </svg>
            <a href="menu.php">Back</a>
        </div>
    </nav>
    <aside class="cart-div ">
        <form class="submit-sale flex-column" action="includes/purchase-contr.inc.php" method="post" enctype="multipart/form-data">
            <div class="cart-body flex-column">
                <div class="cart-intro-text">
                    <h2>Table no. <?php echo $_SESSION["table"] ?></h2>
                </div>
                <div class="cart-list">
                </div>
            </div>
            <div class="cart-submit flex-row">
                <div class="total-text">
                    <span>Total</span>
                    <div class="price">
                        <span>P</span>
                        <input type="text" value="0" name="total" id="" readonly>
                    </div>
                </div>
                <input type="submit" value="Done" name="purchase">
                <input class="hide" type="text" name="table-id" id="" value="<?php echo $_SESSION["table"] ?>">
                <input class="hide" type="text" name="waiter-name" id="" value="<?php echo $_SESSION["username"]; ?>">
                <input class="hide" value="<?php echo $_SESSION["table"]; ?>" type="text" name="table-id" id="" hidden>
                <input class="hide" value="<?php echo $_SESSION["uid"]; ?>" type="text" name="uid" id="" hidden>
            </div>
        </form>
    </aside>
    <main class="main-container">
        <div class="nav-buttons-container">
            <div class="nav-buttons group-btn">
                <button id="all">
                    <div class="image"></div>
                    <div class="text">
                        <span>All</span>
                    </div>
                </button>
                <button id="sets">
                    <div class="image"></div>
                    <div class="text">
                        <span>Sets</span>
                    </div>
                </button>
                <button id="meat">
                    <div class="image"></div>
                    <div class="text">
                        <span>Meat</span>
                    </div>
                </button>
                <button id="sides">
                    <div class="image"></div>
                    <div class="text">
                        <span>Sides</span>
                    </div>
                </button>
                <button id="drinks">
                    <div class="image"></div>
                    <div class="text">
                        <span>Drinks</span>
                    </div>
                </button>
                <button id="addons">
                    <div class="image"></div>
                    <div class="text">
                        <span>Add-ons</span>
                    </div>
                </button>
            </div>
        </div>
        <div class="menu-container">
            <div class="popular-container">
                <h1>All</h1>
                <div class="group-btn item-btn">
                    <?php
                    include "./includes/autoload.inc.php";

                    $allFoods = new FoodsView();
                    $allFoods->initReadAll();
                    ?>
                </div>
            </div>
            <div class="sets-container">
                <h1>Main sets</h1>
                <div class="group-btn item-btn">
                    <?php
                    $setFoods = new FoodsView();
                    $setFoods->initReadSets();
                    ?>
                </div>
            </div>
            <div class="meats-container">
                <h1>Meats</h1>
                <div class="group-btn item-btn">
                    <?php
                    $setFoods = new FoodsView();
                    $setFoods->initReadMeats();
                    ?>
                </div>
            </div>
            <div class="sides-container">
                <h1>Sides</h1>
                <div class="group-btn item-btn">
                    <?php
                    $sideFoods = new FoodsView();
                    $sideFoods->initReadSides();
                    ?>
                </div>
            </div>
            <div class="drinks-container">
                <h1>Drinks</h1>
                <div class="group-btn item-btn">
                    <?php
                    $drinkFoods = new FoodsView();
                    $drinkFoods->initReadDrinks();
                    ?>
                </div>
            </div>
            <div class="addons-container">
                <h1>Addons</h1>
                <div class="group-btn item-btn">
                    <?php
                    $drinkFoods = new FoodsView();
                    $drinkFoods->initReadAddons();
                    ?>
                </div>
            </div>
        </div>
    </main>

    <script src="./js/store.js?v=<?php echo time(); ?>"></script>
    <script src="./js/cart.js?v=<?php echo time(); ?>"></script>

</body>

</html>