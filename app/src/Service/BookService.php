<?php

namespace App\Service;

use App\Mapper\BookMapper;
use App\Model\BookDetails;
use App\Model\BookListResponse;
use App\Repository\BookRepository;

readonly class BookService
{
    public function __construct(
        private BookRepository $bookRepository
    ){}

    public function getBookList(array $filters, int $offset, int $limit) : BookListResponse
    {
        $books = $this->bookRepository->findPublishBooks($filters, $offset, $limit);
        $arrayMapper = BookMapper::arrayMap($books);

        return new BookListResponse($arrayMapper, $offset, $limit);
    }

    public function getBooksByCategory(string $alias, int $offset, int $limit): BookListResponse
    {
        $books = $this->bookRepository->findPublishBooksWithCategoryByAlias($alias, $offset, $limit);
        $arrayMapper = BookMapper::arrayMap($books);

        return new BookListResponse($arrayMapper, $offset, $limit);
    }

    public function getBookDetails(int $id) : BookDetails
    {
        $book = $this->bookRepository->findBookById($id);
        $details = new BookDetails();

        BookMapper::map($book, $details);

        return $details
            ->setFile($book->getFile())
            ->setDescription($book->getDescription())
            ->setKeywords($book->getKeywords())
            ->setText($book->getText())
            ->setRecommendation($book->isRecommendation())
            ->setInformation($book->getInformation())
        ;
    }
}
