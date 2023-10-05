<?php

namespace App\Repository;

use App\Entity\Book;
use App\Exceptions\BookNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findPublishBooks(array $filters, int $offset, int $limit) : array
    {
        $queryBuilder = $this->createQueryBuilder('b')
            ->andWhere('b.visible = 0')
        ;

        if(!empty($filters['q'])) {
            $queryBuilder->andWhere('b.title LIKE :q')->setParameter('q', "%{$filters['q']}%");
        }

        if(!empty($filters['year'])) {
            $queryBuilder->andWhere('b.year = :year')->setParameter('year', $filters['year']);
        }

        return $queryBuilder
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findPublishBooksWithCategoryByAlias(string $alias, int $offset, int $limit) : array
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.category', 'c')
            ->addSelect('c')
            ->where('c.alias = :alias')
            ->setParameter('alias', $alias)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBookById(int $id) : Book
    {
        $book = $this->find($id);

        if(null === $book) {
            throw new BookNotFoundException();
        }

        return $book;
    }

}
