<?php

namespace App\Repository;

use App\Entity\Links;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Links|null find($id, $lockMode = null, $lockVersion = null)
 * @method Links|null findOneBy(array $criteria, array $orderBy = null)
 * @method Links[]    findAll()
 * @method Links[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Links::class);
    }

    // /**
    //  * @return Links[] Returns an array of Links objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Links
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    //Fonction de recherche selon tout ou parti du
    //nom, de l'auteur ou de la date du lien.
    public function SearchAction($motcle)
    {
        $queryBuilder = $this->createQueryBuilder('l')
           ->Select('l')
           ->Where('l.Nom LIKE :nom')
           ->orWhere('l.Auteur LIKE :auteur')
           ->orWhere('l.Date_publi LIKE :date_publi')
           ->setParameter('nom', '%'.$motcle.'%')
           ->setParameter('auteur', '%'.$motcle.'%')
           ->setParameter('date_publi', '%'.$motcle.'%');
           

        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }
}
