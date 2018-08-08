<?php

namespace Loann\Model;

class Message
{
    /**
     * @var int
     */
    private $id;

    /** 
     * @var string
     */
    private $content;

    /**
     * @var date
     */
    private $publication_date;

    /**
     * @var int
     */
    private $author_id;

    /**
     * @var int
     */
    private $topic_id;

    /**
     * @param mixed $id
     * @return Message
     */
    public function getId()
    {
        return $this->id;
    }

    /*
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publication_date;
    }

    /**
     * @param mixed $publication_date
     * @return Message
     */
    public function setPublicationDate($publication_date)
    {
        $this->publication_date = $publication_date;
        return this;
    }

    /**
     * return mixed
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * return mixed
     */
    public function getTopicId()
    {
        return $this->topic_id;
    }
}
