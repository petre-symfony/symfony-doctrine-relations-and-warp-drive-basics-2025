<?php

namespace App\Repository;

use App\Entity\StarshipPart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StarshipPart>
 */
class StarshipPartRepository extends ServiceEntityRepository {
	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry, StarshipPart::class);
	}

	/**
	 * @return StarshipPart[] Returns an array of StarshipPart objects
	 */
	public function findAllOrderedByPrice(): array {
		return $this->createQueryBuilder('sp')
			->orderBy('sp.price', 'DESC')
			->getQuery()
			->getResult();
	}
}
