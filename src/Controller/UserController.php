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
            // setting post values to session;
            $_SESSION['username'] = $username;

            // insert new user into SQL
            $userManager->addNewUser($firstname, $lastname, $username, $password);
        }

        return header("Location:?route=home");
    }

    public function showLogInAction($errors = null)
    {
        return $this->render('logIn.html.twig', [
            'errors' => $errors
        ]);
    }

    public function logInAction()
    {
        // setting variables to post values
        $username = $_POST['logInUsername'];
        $password = $_POST['logInPassword'];

        $userManager = new UserManager;
        // get the user's password from MySQL
        $getPassword = $userManager->findPasswordByUsername($username);

        $errors = [];

        if ($getPassword) { // if username is correct
            if ($password == $getPassword) { // if given password and MySQL password are the same
                $_SESSION['username'] = $username; // set username to session

                return header('Location:?route=home'); 
            } else {
                $errors[] = "Le mot de passe est incorrect";
            }
        } else {
            $errors[] = "Ce pseudo n'existe pas";
        }

        return $this->showLogInAction($errors);
    }

    public function logOutAction()
    {
        if (isset($_SESSION)) {
            session_destroy();
        }

        return header("Location:?route=home");
    }
}
