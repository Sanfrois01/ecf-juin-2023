<?php

namespace App\Entity;

use App\Entity\Reservation;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\HoraireReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: HoraireReservationRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ]
)]
class HoraireReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:horaire'])]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Groups(['read:horaire'])]

    private ?string $heure_reservation = null;

    #[ORM\ManyToMany(targetEntity: Reservation::class, inversedBy: 'horaireReservations')]

    private Collection $horaire_reservation;

    public function __construct()
    {
        $this->horaire_reservation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureReservation(): ?string
    {
        return $this->heure_reservation;
    }

    public function setHeureReservation(string $heure_reservation): self
    {
        $this->heure_reservation = $heure_reservation;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getHoraireReservation(): Collection
    {
        return $this->horaire_reservation;
    }

    public function addHoraireReservation(Reservation $horaireReservation): self
    {
        if (!$this->horaire_reservation->contains($horaireReservation)) {
            $this->horaire_reservation->add($horaireReservation);
        }

        return $this;
    }

    public function removeHoraireReservation(Reservation $horaireReservation): self
    {
        $this->horaire_reservation->removeElement($horaireReservation);

        return $this;
    }
    public function __toString()
    {
        return 
        (string) $this->horaire_reservation;
    }


}
