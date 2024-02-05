<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Personne>
 *
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personne::class);
    }

 //  /**
//  * @return Personne[] Returns an array of Personne objects
  //*/
    public function findPersonneByAgeIntervalle($agemin,$agemax): array
    {
        $qb = $this->createQueryBuilder ('p');
        $this->addIntervalle($qb, $agemin, $agemax);
        return $qb   ->getQuery()  ->getResult()
        ;
    }

    public function statPersonneByAgeIntervalle ($agemin,$agemax): array
    {
        $qb= $this->createQueryBuilder(alias:'p')
        ->select('avg(p.age) as ageMoyen, count(p.id) as nombrePersonne');
        $this->addIntervalle($qb, $agemin, $agemax);
            
        return $qb ->getQuery()->getScalarResult()
        ;
    }
    private function addIntervalle(\Doctrine\ORM\QueryBuilder $qb, $agemin, $agemax){
        $qb ->andWhere('p.age <= :agemax and p.age>= :agemin')
        //->setParameter('agemax', $agemax)
        //->setParameter('agemin', $agemin)
        ->setParameters(['agemin'=> $agemin,'agemax'=> $agemax ]);
        

    }




//public function findOneBySomeField($value): ?Personne
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
