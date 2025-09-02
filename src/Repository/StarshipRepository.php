<?php

namespace App\Repository;

use App\Entity\Starship;
use App\Entity\StarshipPart;
use App\Entity\StarshipStatusEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

/**
 * @extends ServiceEntityRepository<Starship>
 */
class StarshipRepository extends ServiceEntityRepository {
	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry, Starship::class);
	}

	/**
	 * @return Starship[]
	 */
	public function findIncomplete(): Pagerfanta {
		$query = $this->createQueryBuilder('s')
			->andWhere('s.status != :status')
			->orderBy('s.arrivedAt', 'DESC')
			->setParameter('status', StarshipStatusEnum::COMPLETED)
			->getQuery();

		return new Pagerfanta(new QueryAdapter($query));
	}

	public function findMyShip(): Starship {
		return $this->findAll()[0];
	}

	/**
	 * @return Collection<int, StarshipPart>
	 */
	public function getExpensiveParts(int $limit=10): Collection {
		return $this->createQueryBuilder('sp')
			->addCriteria(self::createExpansiveCriteria())
			->setMaxResults($limit)
			->getQuery()
			->getResult();
	}

	public static function createExpansiveCriteria(): Criteria {
		return Criteria::create()
			->andWhere(Criteria::expr()->gt('price', 50000));
	}

	//    /**
	//     * @return Starship[] Returns an array of Starship objects
	//     */
	//    public function findByExampleField($value): array
	//    {
	//        return $this->createQueryBuilder('s')
	//            ->andWhere('s.exampleField = :val')
	//            ->setParameter('val', $value)
	//            ->orderBy('s.id', 'ASC')
	//            ->setMaxResults(10)
	//            ->getQuery()
	//            ->getResult()
	//        ;
	//    }

	//    public function findOneBySomeField($value): ?Starship
	//    {
	//        return $this->createQueryBuilder('s')
	//            ->andWhere('s.exampleField = :val')
	//            ->setParameter('val', $value)
	//            ->getQuery()
	//            ->getOneOrNullResult()
	//        ;
	//    }
}
