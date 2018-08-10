<?php


namespace Loann\Controller;


class UserController extends Controller
{

    public function showSignUpAction()
    {
        return $this->render('signUp.html.twig');
    }

    public function signUpAction()
    {

        // make a sql request to make sure username dosen't exist yet
        // register all data into sql

        // setting post values to session
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['username'] = $_POST['username'];

        return header("Location:?route=home");
    }

    public function logOutAction()
    {
        if (isset($_SESSION)) {
            session_destroy();
        }

        return header("Location:?route=home");
    }
}