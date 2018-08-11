<?php

namespace Loann\Controller;

use Loann\Model\UserManager;

class UserController extends Controller
{

    public function showSignUpAction($errors = null, $formPostData = null)
    {
        return $this->render('signUp.html.twig', [
            'errors' => $errors,
            'formPostData' => $formPostData
        ]);
    }

    public function signUpAction()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $errors = [];

        $userManager = new UserManager();
        // if the username is already taken, throw an error
        if ($userManager->findByUsername($username)) {
            $errors[] = "Ce pseudo est déjà pris, veuillez en choisir un autre";
        }

        // creating a regex for password: at least one lowercase, one uppercase, one number, minimum eight characters
        $passwordFormat = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
        preg_match($passwordFormat, $password, $match);
        // if the password doesn't match the regex
        if (!$match) {
            $errors['passwordError'] = "Votre mot de passe doit contenir au moins une majuscule,
                                                                un nombre,
                                                                et avoir une longueur minimale de 8 caractères";
        }
        // if the two passwords are different, throw an error
        if ($password !== $_POST['password_repeat']) {
            $errors[] = "Les deux mots de passe doivent être identiques";
        }
        // if one of these fields is empty, throw an error
        if (empty($firstname) || empty($lastname) || empty($username)) {
            $errors[] = "Tous les champs doivent être remplis";
        }
        // if errors, stay on same page
        if ($errors) {
            return $this->showSignUpAction($errors, $_POST);
        } else {
            // setting post values to session
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['username'] = $username;

            // insert new user into SQL
            $userManager->addNewUser($firstname, $lastname, $username, $password);
        }

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
