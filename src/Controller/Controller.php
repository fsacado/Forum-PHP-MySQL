<?php

namespace Loann\Controller;

class Controller
{
    /**
     * @var \Twig_Environment
     */
    public static $twig;

    /**
     * @return \Twig_Environment
     */
    public function getTwig(): \Twig_Environment
    {
        if (self::$twig === null) {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../View');
            self::$twig = new \Twig_Environment($loader, array(
                'cache' => false,
            ));
        }
        return self::$twig;
    }

    // /**
    //  * Controller constructor.
    //  */
    // public function __construct()
    // {
    //     // define sessions vars
    //     if (session_status() == PHP_SESSION_NONE) {
    //         session_start();
    //     }
    //     if (empty($_SESSION['message'])) {
    //         $_SESSION['message'] = '';
    //     }
    //     if (empty($_SESSION['message_title'])) {
    //         $_SESSION['message_title'] = '';
    //     }
    //     if (empty($_SESSION['message_type'])) {
    //         $_SESSION['message_type'] = '';
    //     }
    // }


    /**
     * @param string $view
     * @param array $args_tab
     * @return string
     */
    public function render(string $view, array $args_tab = [])
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // $args = [
        //     'message' => $_SESSION['message'],
        //     'message_title' => $_SESSION['message_title'],
        //     'message_type' => $_SESSION['message_type'],
        // ];
        // $args_tab = array_merge($args_tab, $args);
        $view = self::getTwig()->render($view, $args_tab);
        // self::setMessage(''); // burn after reading
        return $view;
    }

}
