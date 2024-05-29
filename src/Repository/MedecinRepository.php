<?php

namespace App\Repository;

use App\Entity\Medecin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Medecin>
 *
 * @method Medecin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medecin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medecin[]    findAll()
 * @method Medecin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedecinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medecin::class);
    }

    public function findMedecinByCriteria(?string $domaine, ?string $ville): QueryBuilder
    {
        $query = $this->createQueryBuilder('m');

        if ($domaine) {
            $query->andWhere('m.domaine LIKE :domaine')
                  ->setParameter('domaine', '%' . $domaine . '%');
        }

        if ($ville) {
            $query->andWhere('m.ville LIKE :ville')
                  ->setParameter('ville', '%' . $ville . '%');
        }

        return $query;
    }
}
