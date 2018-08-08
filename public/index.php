<?php

require "../vendor/autoload.php";
require "../connect.php";

//  set route name to $route
// if no route specified, default home
if (!empty($_GET['route'])) {
    $route = $_GET['route'];
} else {
    $route = "home";
}

if ($route == 'home') {
    $homeController = new \Loann\Controller\HomeController();
    echo $homeController->indexAction();
} 
// else if ($route == 'categories') {
//     $homeController = new \Loann\Controller\HomeController();
//     echo $homeController->categorieAction();
// }