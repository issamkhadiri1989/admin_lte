<?php

namespace App\Repository;

use App\Entity\Author;
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
    private const LIMIT = 10;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function getBooksWithTitle(string $title, int $page, \DateTime $start = null, \DateTime $end = null): array
    {
        $builder = $this->createQueryBuilder('b');

        $exp = $builder->expr();

        $query = $builder->where(
            $exp->like('b.title', ':issam')
        );

        if (null !== $start) {
            $exp->gt('b.publishDate', ':d1');
            $query ->setParameter('d1', $start);
        }

        if (null !== $end) {
            $exp->lt('b.publishDate', ':d2');
            $query ->setParameter('d2', $end);
        }

        $query->setParameter('issam', '%'.$title.'%');

        return
            $query
            ->setFirstResult(self::LIMIT * ($page - 1))
            ->setMaxResults(self::LIMIT)
        ->getQuery()

        ->getResult();



    }

//    /**
//     * @return Book[] Returns an array of Book objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Book
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
