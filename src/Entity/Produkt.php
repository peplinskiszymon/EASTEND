<?php

namespace App\Entity;

use App\Repository\ProduktRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduktRepository::class)
 */
class Produkt
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
     * @ORM\ManyToMany(targetEntity=Kategoria::class)
     * @ORM\JoinTable(name="kategoria_produkt")
     */
    private $kategoria;

    public function __construct()
    {
        $this->kategoria = new ArrayCollection();
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
     * @return Collection|kategoria[]
     */
    public function getKategoria(): Collection
    {
        return $this->kategoria;
    }

    public function addKategoria(Kategoria $kategoria): self
    {
        if (!$this->kategoria->contains($kategoria)) {
            $this->kategoria[] = $kategoria;
        }

        return $this;
    }

    public function removeKategoria(Kategoria $kategoria): self
    {
        if ($this->kategoria->contains($kategoria)) {
            $this->kategoria->removeElement($kategoria);
        }

        return $this;
    }

    public function __toString()
    {
        $this->nazwa;
    }
}
