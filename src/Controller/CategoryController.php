<?php

namespace Loann\Controller;

use Loann\Model\CategoryManager;
use Loann\Model\MessageManager;
use Loann\Model\TopicManager;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $categoryName = $_GET["name"];

        $categoryManager = new CategoryManager();
        $topicManager = new TopicManager();
        $messageManager = new MessageManager();

        $authors = [];
        $messageNumbers = [];
        $lastMessagedatesAuthors = [];

        $topics = $categoryManager->findTopics($categoryName);

        foreach ($topics as $topic) {
            // find the topic's author and store it in the array
            $authors[] = $topicManager->findAuthorByTopic($topic);
            // find how many messages are linked to the topic
            $getMessageNumbers = $messageManager->findMessageNumberPerTopic($topic);
            // find last message'sdate and author
            $getDate = $messageManager->findDateAuthorLastAddedMessagePerTopic($topic);
            // if there's no message number, give value 0 by default
            if (!$getMessageNumbers) {
                $getMessageNumbers = '0';
            }
            // if there's no date, give value by default
            if (!$getDate) {
                $getDate = 'Renseignement inconnu';
            }

            $messageNumbers[] = $getMessageNumbers;
            $lastMessageDatesAuthors[] = $getDate;
        }

        return $this->render('topics.html.twig', [
            'topics' => $topics,
            'authors' => $authors,
            'messageNumbers' => $messageNumbers,
            'lastDateAuthor' => $lastMessageDatesAuthors,
        ]);
    }
}
