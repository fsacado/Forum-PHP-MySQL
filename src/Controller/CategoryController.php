<?php

namespace Loann\Controller;

use Loann\Model\CategoryManager;
use Loann\Model\TopicManager;
use Loann\Model\MessageManager;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $categoryName = $_GET["name"];
    
        $categoryManager = new CategoryManager();
        $topicManager = new TopicManager();
        $messageManager = new MessageManager();

        $topics = $categoryManager->findTopics($categoryName);

        $authors = [];
        $messageNumbers = [];

        foreach ($topics as $topic) {
            $authors[] = $topicManager->findAuthorByTopic($topic);
            $messageNumbers[] = $messageManager->findMessageNumberPerTopic($topic);
        }

        return $this->render('topics.html.twig', [
            'topics' => $topics,
            'authors' => $authors,
            'messageNumbers' => $messageNumbers
        ]);
    }   
}
