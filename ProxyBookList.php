<?php
/**
 * Created by PhpStorm.
 * User: Giovane
 * Date: 19/09/17
 * Time: 20:34
 */
class ProxyBookList {
    private $bookList = NULL;
    //bookList is not instantiated at construct time
    function __construct() {
    }
    function getBookCount() {
        if (NULL == $this->bookList) {
            $this->makeBookList();
        }
        return $this->bookList->getBookCount();
    }
    function addBook($book) {
        if (NULL == $this->bookList) {
            $this->makeBookList();
        }
        return $this->bookList->addBook($book);
    }
    function getBook($bookNum) {
        if (NULL == $this->bookList) {
            $this->makeBookList();
        }
        return $this->bookList->getBook($bookNum);
    }
    function removeBook($book) {
        if (NULL == $this->bookList) {
            $this->makeBookList();
        }
        return $this->bookList->removeBook($book);
    }
    //Create
    function makeBookList() {
        $this->bookList = new bookList();
    }
}

class BookList {
    private $books = array();
    private $bookCount = 0;
    public function __construct() {
    }
    public function getBookCount() {
        return $this->bookCount;
    }
    private function setBookCount($newCount) {
        $this->bookCount = $newCount;
    }
    public function getBook($bookNumberToGet) {
        if ( (is_numeric($bookNumberToGet)) && ($bookNumberToGet <= $this->getBookCount())) {
            return $this->books[$bookNumberToGet];
        } else {
            return NULL;
        }
    }
    public function addBook(Book $book_in) {
        $this->setBookCount($this->getBookCount() + 1);
        $this->books[$this->getBookCount()] = $book_in;
        return $this->getBookCount();
    }
    public function removeBook(Book $book_in) {
        $counter = 0;
        while (++$counter <= $this->getBookCount()) {
            if ($book_in->getAuthorAndTitle() == $this->books[$counter]->getAuthorAndTitle()) {
                for ($x = $counter; $x < $this->getBookCount(); $x++) {
                    $this->books[$x] = $this->books[$x + 1];
                }
                $this->setBookCount($this->getBookCount() - 1);
            }
        }
        return $this->getBookCount();
    }
}

class Book {
    private $author;
    private $title;
    function __construct($title_in, $author_in) {
        $this->author = $author_in;
        $this->title  = $title_in;
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
    function getAuthorAndTitle() {
        return $this->getTitle().' by '.$this->getAuthor();
    }
}

writeln( 'INICIADO TESTE PROXY PATTERN');
writeln('');

$proxyBookList = new ProxyBookList();
$inBook = new Book('PHP for Cats','Larry Truett');
$proxyBookList->addBook($inBook);

writeln('test 1 - Mostre a contagem de livros depois que um livro é adicionado.');
writeln($proxyBookList->getBookCount());
writeln('');

writeln('test 2 - Mostra o Livro.');
$outBook = $proxyBookList->getBook(1);
writeln($outBook->getAuthorAndTitle());
writeln('');

$proxyBookList->removeBook($outBook);

writeln('test 3 - Mostre a conta do livro depois que um livro é removido');
writeln($proxyBookList->getBookCount());
writeln('');

writeln('FIM DO TESTE DE PROXY PATTERN');

function writeln($line_in) {
    echo $line_in."<br/>";
}

?>