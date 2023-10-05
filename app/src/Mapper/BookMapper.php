<?php

namespace App\Mapper;

use App\Entity\Book;
use App\Model\BaseBookDetails;
use App\Model\BaseBookListItem;

class BookMapper
{
    public static function arrayMap(array $books) : array
    {
        return array_map(function (Book $book) {
            $item = new BaseBookListItem();

            self::map($book, $item);

            return $item;
        }, $books);
    }

    public static function map(Book $book, BaseBookDetails $bookListItem): void
    {
        $bookListItem
            ->setId($book->getId())
            ->setTitle($book->getTitle())
            ->setAlias($book->getAlias())
            ->setYear($book->getYear())
            ->setRecommendation($book->isRecommendation())
            ->setIsbn($book->getIsbn())
            ->setImage($book->getImage())
            ->setDescription($book->getDescription())
        ;
    }
}
