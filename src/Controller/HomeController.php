<?php

namespace Loann\Controller;

use Loann\Model\MessageManager;
use Loann\Model\CategoryManager;
use Loann\Model\UserManager;
use Loann\Model\SubclassManager;

class HomeController extends Controller
{
    public function indexAction()
    {
        
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        $subclasses = [];
        $messageNumbers = [];
        $datesAndAuthor = [];
        $moderators = [];

        foreach ($categories as $category) {

            $subclassManager = new SubclassManager();
            $getSubclasses = $subclassManager->findByCategory($category->getName());
            $subclasses[] = $getSubclasses;

            $messageManager = new MessageManager();
            // set number of messages corresponding to the category
            $getMessageNumbers = $messageManager->findMessageNumberPerCategory($category->getName());
            // retrieve last message's publication_date
            $getDate = $messageManager->findDateAuthorLastAddedMessagePerCategory($category->getName());
            // if there's no message number, give value 0 by default
            if (!$getMessageNumbers) {
                $getMessageNumbers = '0';
            }
            // if there's no date, give value by default
            if (!$getDate) {
                $getDate = 'Renseignement inconnu';
            }
            
            // set value to array
            $messageNumbers[] = $getMessageNumbers;
            // set value to array
            $datesAndAuthor[] = $getDate;

            $userManager = new UserManager();
            // get all moderators for the category
            $getModerators = $userManager->findModeratorsByCategory($category->getName());
            // set them to the array
            $moderators[] = $getModerators;
        }

        return $this->render('home.html.twig', [
            'categories' => $categories,
            'subclasses' => $subclasses,
            'messageNumbers' => $messageNumbers,
            'datesAndAuthor' => $datesAndAuthor,
            'moderators' => $moderators
        ]);

    }

}
