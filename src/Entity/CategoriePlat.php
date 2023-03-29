<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\CategoriePlatRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoriePlatRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ]
)]

class CategoriePlat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:Post'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:Post'])]

    private ?string $nom_categorie = null;

    #[ORM\ManyToMany(targetEntity: Plat::class, inversedBy: 'categoriePlats')]
    private Collection $categorie_plat;

    public function __construct()
    {
        $this->categorie_plat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nom_categorie;
    }

    public function setNomCategorie(string $nom_categorie): self
    {
        $this->nom_categorie = $nom_categorie;

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getCategoriePlat(): Collection
    {
        return $this->categorie_plat;
    }

    public function addCategoriePlat(Plat $categoriePlat): self
    {
        if (!$this->categorie_plat->contains($categoriePlat)) {
            $this->categorie_plat->add($categoriePlat);
        }

        return $this;
    }

    public function removeCategoriePlat(Plat $categoriePlat): self
    {
        $this->categorie_plat->removeElement($categoriePlat);

        return $this;
    }
    public function __toString()
    {
        return (string) $this->nom_categorie;
                (string) $this->categorie_plat;

    }
}
