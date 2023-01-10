<?php
    include 'autoload.inc.php';

    $name = $_GET['name'];
    $allFoods = new FoodsView();
    $allFoods->initEditInclusions($name);
?>