<?php

/**
 * 迭代模式：提供一种方法访问一个容器（Container）对象中各个元素，而又不需暴露该对象的内部细节。
 * 你需要访问一个聚合对象，而且不管这些对象是什么都需要遍历的时候，就应该考虑使用迭代器模式。
 * 另外，当需要对聚集有多种方式遍历时，可以考虑去使用迭代器模式。迭代器模式为遍历不同的聚集结构提供如开始、下一个、是否结束、当前哪一项等统一的接口。
 * PHP标准库（SPL）中提供了迭代器接口 Iterator，要实现迭代器模式，实现该接口即可。
 */
class Book
{
    protected $author, $title;

    public function __construct($author, $title)
    {
        $this->author = $author;
        $this->title = $title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthorAndTitle()
    {
        return $this->author . $this->title;
    }
}

class BookList implements \Countable
{
    private $books;

    public function getBook($bookNumberToGet)
    {
        if (isset($this->books[$bookNumberToGet])) {

            return $this->books[$bookNumberToGet];
        }

        return null;
    }

    public function addBook(Book $book)
    {
        $this->books[] = $book;
    }

    public function removeBook(Book $removeBook)
    {
        foreach ($this->books as &$item) {
            if ($item->getTitle() === $removeBook->getTitle()) {
                unset($item);
            }
        }
    }

    public function count()
    {
        return count($this->books);
    }
}

class BookListIterator implements Iterator
{
    private $position = 0;
    private $bookList = null;

    public function __construct(BookList $bookList)
    {
        $this->bookList = $bookList;
    }

    public function current()
    {
        return $this->bookList->getBook($this->position);
    }

    public function next()
    {
        $this->position++;
    }

    public function valid()
    {
        return null !== $this->bookList->getBook($this->position);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function key()
    {
        return $this->position;
    }
}

$bookList = new BookList();
$bookList->addBook(new Book('Learning PHP Design Patterns', 'William Sanders'));
$bookList->addBook(new Book('Professional Php Design Patterns', 'Aaron Saray'));
$bookList->addBook(new Book('Clean Code', 'Robert C. Martin'));

$bookListIterator = new BookListIterator($bookList);
$arBooks = array();


while ($bookListIterator->valid()) {
    $arBooks[$bookListIterator->key()]['author'] = $bookListIterator->current()->getAuthor();
    $arBooks[$bookListIterator->key()]['title'] = $bookListIterator->current()->getTitle();
    $bookListIterator->next();
}

print_r($arBooks);