<?php

namespace App\Entity;

use App\Repository\KategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KategoriaRepository::class)
 */
class Kategoria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa;

    /**
     * @ORM\ManyToMany(targetEntity=Produkt::class)
     */
    private $produkt;

    public function __construct()
    {
        $this->produkt = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * @return Collection|produkt[]
     */
    public function getProdukt(): Collection
    {
        return $this->produkt;
    }

    public function addProdukt(produkt $produkt): self
    {
        if (!$this->produkt->contains($produkt)) {
            $this->produkt[] = $produkt;
        }

        return $this;
    }

    public function removeProdukt(produkt $produkt): self
    {
        if ($this->produkt->contains($produkt)) {
            $this->produkt->removeElement($produkt);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nazwa;
    }
}
