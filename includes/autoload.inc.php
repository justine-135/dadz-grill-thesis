<?php
spl_autoload_register('myAutoLoader');

function myAutoLoader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $path = '';
    $ext = '.class.php';

    if (strpos($url, 'includes') !== false) {
        $path = '../classes/';
    }
    else{
        $path = 'classes/';
    }

    require_once $path . $className . $ext;
}