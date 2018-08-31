<?php

namespace Loann\Controller;

use Loann\Controller\Controller;
use Loann\Model\SubclassManager;
use Loann\Model\TopicManager;
use Loann\Model\MessageManager;

class SubclassController extends Controller
{
    public function indexAction()
    {
        $subclassName = $_GET['name'];

        $subclassManager = new SubclassManager();
        $topicManager = new TopicManager();
        $messageManager = new MessageManager();

        $authors = [];
        $messageNumbers = [];
        $lastMessageDatesAuthors = [];

        $topics = $subclassManager->findTopics($subclassName);

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

        return $this->render('subclass.html.twig', [
            'topics' => $topics,
            'authors' => $authors,
            'messageNumbers' => $messageNumbers,
            'lastDateAuthor' => $lastMessageDatesAuthors,
        ]);
    }
}
