<?php


namespace Loann\Controller;

use \Loann\Model\CategoryManager;


class HomeController extends Controller
{

    public function indexAction()
    {
        $test = "je m'appelle Loann";
    

        return $this->render('test.html.twig', [
            'test' => $test    
        ]);

    }

    public function categorieAction()
    {
        $test = "je m'appelle Toto";

        $manager = new CategoryManager();
        $categories = $manager->findAll();
// var_dump($categories);
        return $this->render('test.html.twig', [
            'test' => $test,
            'categories' => $categories    
        ]);

    }

}
