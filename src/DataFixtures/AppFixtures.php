<?php

namespace App\DataFixtures;

use App\Entity\Starship;
use App\Entity\StarshipPart;
use App\Entity\StarshipStatusEnum;
use App\Factory\StarshipFactory;
use App\Factory\StarshipPartFactory;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture {
	public function load(ObjectManager $manager): void {
		$starship = StarshipFactory::createOne();
		$part1 = new StarshipPart();
		$part1->setName('Warp Core');
		$part1->setPrice(1000);
		$part2 = new StarshipPart();
		$part2->setName('Phaser Array');
		$part2->setPrice(500);
		$manager->persist($part1);
		$manager->persist($part2);
		
		StarshipFactory::createOne([
			'name' => 'USS LeafyCruiser (NCC-0001)',
			'class' => 'Garden',
			'captain' => 'Jean-Luc Pickles',
			'status' => StarshipStatusEnum::IN_PROGRESS,
			'arrivedAt' => new DateTimeImmutable('-1 day'),
		]);

		StarshipFactory::createOne([
			'name' => 'USS Espresso (NCC-1234-C)',
			'class' => 'Latte',
			'captain' => 'James T. Quick!',
			'status' => StarshipStatusEnum::COMPLETED,
			'arrivedAt' => new DateTimeImmutable('-1 week'),
		]);

		$ship = StarshipFactory::createOne([
			'name' => 'USS Wanderlust (NCC-2024-W)',
			'class' => 'Delta Tourist',
			'captain' => 'Kathryn Journeyway',
			'status' => StarshipStatusEnum::WAITING,
			'arrivedAt' => new DateTimeImmutable('-1 month'),
		]);

		StarshipFactory::createMany(20);
		StarshipPartFactory::createMany(100);
	}
}
