<?php

namespace Loann\Controller;

use Loann\Model\MessageManager;
use \Loann\Model\CategoryManager;
use \Loann\Model\UserManager;

class HomeController extends Controller
{
    public function indexAction()
    {

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        $messageNumbers = [];
        $dates = [];
        $moderators = [];

        foreach ($categories as $category) {
            $messageManager = new MessageManager();
            // set number of messages corresponding to the category
            $getMessageNumbers = $messageManager->findMessageNumberPerCategory($category->getName());
            // retrieve last message's publication_date
            $getDate = $messageManager->findLastAddedMessagePerCategory($category->getName());
            // if there's no message number, give value 0 by default
            if (!$getMessageNumbers) {
                $getMessageNumbers = '0';
            }
            // if there's no date, give value by default
            if (!$getDate) {
                $getDate = 'Date inconnue';
            }
            // set value to array
            $messageNumbers[] = $getMessageNumbers;
            // set value to array
            $dates[] = $getDate;

            $userManager = new UserManager();
            // get all moderators for the category
            $getModerators = $userManager->findModeratorsByCategory($category->getName());
            // set them to the array
            $moderators[] = $getModerators;

        }

        return $this->render('home.html.twig', [
            'categories' => $categories,
            'messageNumbers' => $messageNumbers,
            'dates' => $dates,
            'moderators' => $moderators
        ]);

    }

}
