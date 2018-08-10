<?php

if (!isset($_SESSION)) {
    session_start();
}

require "../vendor/autoload.php";
require "../connect.php";

//  set route name to $route
// if no route specified, default home
if (!empty($_GET['route'])) {
    $route = $_GET['route'];
} else {
    $route = "home";
}
// var_dump($route);
if ($route == 'home') {
    $homeController = new \Loann\Controller\HomeController();
    echo $homeController->indexAction();
} 
else if ($route == 'signUp') {
    $userController = new \Loann\Controller\UserController();
    echo $userController->showSignUpAction();
}
else if ($route == 'signUpAction') {
    $userController = new \Loann\Controller\UserController();
    echo $userController->signUpAction();
}
else if ($route == 'logOut') {
    $userController = new \Loann\Controller\UserController();
    echo $userController->logOutAction();
}



// else if ($route == 'categories') {
//     $homeController = new \Loann\Controller\HomeController();
//     echo $homeController->categorieAction();
// }