<?php

namespace Loann\Controller;


use Loann\Model\TopicManager;


class TopicController extends Controller
{
    public function indexAction()
    {
        // retrieving title from the route
        $topicName = $_GET['title'];

        $topicManager = new TopicManager();

        $messages = $topicManager->findMessagesByTopic($topicName);

        return $this->render('messages.html.twig', [
            'topicName' => $topicName,
            'messages' => $messages
        ]);
    }
}