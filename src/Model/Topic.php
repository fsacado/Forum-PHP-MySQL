<?php

namespace Loann\Model;

class Topic
{
    /*
     * @var int
     */
    private $id;

    /*
     * @var string
     */
    private $title;

    /*
     * @var int
     */
    private $subclass_id;

    /*
     * @var int
     */
    private $author_id;

    /**
     * @param mixed $id
     * @return Topic
     */
    public function getId()
    {
        return $this->id;
    }

    /*
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Topic
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param mixed $subclass_id
     * @return Topic
     */
    public function getSubclassId()
    {
        return $this->subclass_id;
    }

    /**
     * @param mixed $author_id
     * @return Topic
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }
}
