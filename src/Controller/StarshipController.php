<?php

namespace App\Controller;

use App\Entity\Starship;
use App\Repository\StarshipPartRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StarshipController extends AbstractController {
	#[Route('/starships/{slug}', name: 'app_starship_show')]
	public function show(
		#[MapEntity(mapping: ['slug' => 'slug'])]
		Starship $ship,
		StarshipPartRepository $partRepository
	): Response {
		$parts = $partRepository->findBy(['starship' => $ship]);

		foreach ($parts as $part) {
			dump($part);
		}
		
		return $this->render('starship/show.html.twig', [
			'ship' => $ship,
		]);
	}
}
