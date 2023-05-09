<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_menu = null;

    #[ORM\Column(length: 255)]
    private ?string $periode_menu = null;

    #[ORM\Column(length: 255)]
    private ?string $type_menu = null;

    #[ORM\Column]
    private ?int $prix_menu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMenu(): ?string
    {
        return $this->nom_menu;
    }

    public function setNomMenu(string $nom_menu): self
    {
        $this->nom_menu = $nom_menu;

        return $this;
    }

    public function getPeriodeMenu(): ?string
    {
        return $this->periode_menu;
    }

    public function setPeriodeMenu(string $periode_menu): self
    {
        $this->periode_menu = $periode_menu;

        return $this;
    }

    public function getTypeMenu(): ?string
    {
        return $this->type_menu;
    }

    public function setTypeMenu(string $type_menu): self
    {
        $this->type_menu = $type_menu;

        return $this;
    }

    public function getPrixMenu(): ?int
    {
        return $this->prix_menu;
    }

    public function setPrixMenu(int $prix_menu): self
    {
        $this->prix_menu = $prix_menu;

        return $this;
    }
}
