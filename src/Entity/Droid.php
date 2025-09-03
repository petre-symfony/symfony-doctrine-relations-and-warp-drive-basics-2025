<?php

namespace App\Entity;

use App\Repository\DroidRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DroidRepository::class)]
class Droid {
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(length: 255)]
	private ?string $name = null;

	#[ORM\Column(length: 255)]
	private ?string $primaryFunction = null;

	/**
	 * @var Collection<int, Starship>
	 */
	#[ORM\ManyToMany(targetEntity: Starship::class, mappedBy: 'droids')]
	private Collection $starShips;

	public function __construct() {
		$this->starShips = new ArrayCollection();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function setName(string $name): static {
		$this->name = $name;

		return $this;
	}

	public function getPrimaryFunction(): ?string {
		return $this->primaryFunction;
	}

	public function setPrimaryFunction(string $primaryFunction): static {
		$this->primaryFunction = $primaryFunction;

		return $this;
	}

	/**
	 * @return Collection<int, Starship>
	 */
	public function getShips(): Collection {
		return $this->starShips;
	}

	public function addShip(Starship $ship): static {
		if (!$this->starShips->contains($ship)) {
			$this->starShips->add($ship);
			$ship->addDroid($this);
		}

		return $this;
	}

	public function removeShip(Starship $ship): static {
		if ($this->starShips->removeElement($ship)) {
			$ship->removeDroid($this);
		}

		return $this;
	}
}
