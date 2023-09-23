<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    public function findAllBooksByQuery(string $query)
    {
        $queryBuilder = $this->createQueryBuilder('book');

        $expression = $queryBuilder->expr();

        $orConditions = $expression->orX(
            $expression->like('book.title', ':query'),
            $expression->eq('book.ean', ':ean')
        );

        return $queryBuilder
            ->where($orConditions)
            ->setParameter('query', '%' . $query . '%')
            ->setParameter('ean', $query)
            ->getQuery()
            ->getResult();
    }
}
