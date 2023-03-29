<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlatRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
        ],
        normalizationContext: ['groups' => ['read:categorie', 'read:Post']]

    )]



class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:categorie'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:categorie'])]

    private ?string $nom_plat = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read:categorie'])]

    private ?string $description_plat = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:categorie'])]

    private ?string $img_plat = null;

    #[ORM\Column]
    #[Groups(['read:categorie'])]
    private ?float $prix_plat = null;

    #[ORM\ManyToMany(targetEntity: CategoriePlat::class, mappedBy: 'categorie_plat')]
    #[Groups(['read:categorie'])]
    private Collection $categoriePlats;

    public function __construct()
    {
        $this->categoriePlats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPlat(): ?string
    {
        return $this->nom_plat;
    }

    public function setNomPlat(string $nom_plat): self
    {
        $this->nom_plat = $nom_plat;

        return $this;
    }

    public function getDescriptionPlat(): ?string
    {
        return $this->description_plat;
    }

    public function setDescriptionPlat(string $description_plat): self
    {
        $this->description_plat = $description_plat;

        return $this;
    }

    public function getImgPlat(): ?string
    {
        return $this->img_plat;
    }

    public function setImgPlat(?string $img_plat): self
    {
        $this->img_plat = $img_plat;

        return $this;
    }

    public function getPrixPlat(): ?float
    {
        return $this->prix_plat;
    }

    public function setPrixPlat(float $prix_plat): self
    {
        $this->prix_plat = $prix_plat;

        return $this;
    }

    /**
     * @return Collection<int, CategoriePlat>
     */
    public function getCategoriePlats(): Collection
    {
        return $this->categoriePlats;
    }

    public function addCategoriePlat(CategoriePlat $categoriePlat): self
    {
        if (!$this->categoriePlats->contains($categoriePlat)) {
            $this->categoriePlats->add($categoriePlat);
            $categoriePlat->addCategoriePlat($this);
        }

        return $this;
    }

    public function removeCategoriePlat(CategoriePlat $categoriePlat): self
    {
        if ($this->categoriePlats->removeElement($categoriePlat)) {
            $categoriePlat->removeCategoriePlat($this);
        }

        return $this;
    }
    public function __toString()
    {
        return  (string) $this->getNomPlat();
                (string) $this->getCategoriePlats();

    }
}
