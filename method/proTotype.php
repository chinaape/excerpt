<?php

abstract class ProTotype
{
    protected $title = '';

    protected function getTitle()
    {
        return $this->title;
    }

    protected function setTitle($title)
    {
        $this->title = $title;
    }

    abstract protected function __clone();
}

class BookProTotype extends ProTotype
{
    protected $category = 'Book';

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

class BarProToType extends ProTotype
{
    protected $category = 'Bar';

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

$book = clone BookProTotype();
$book->setTitle($book->getCategory().' Book');