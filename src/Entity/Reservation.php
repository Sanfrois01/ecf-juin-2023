<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ApiResource(
    operations:[
        new Get(),
        new GetCollection()
    ],
    normalizationContext: ['groups' => ['read:horaire' , 'read:user']]
)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:horaire'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['read:horaire'])]

    private ?\DateTimeInterface $date_reservation = null;

    #[ORM\Column]
    #[Groups(['read:horaire'])]

    private ?int $couverts_reservation = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:horaire'])]

    private ?string $allergie_reservation = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:horaire'])]

    private ?string $commentaire_reservation = null;

    #[ORM\ManyToMany(targetEntity: HoraireReservation::class, mappedBy: 'horaire_reservation')]
    #[Groups(['read:horaire'])]
    private Collection $horaireReservations;

    #[ORM\ManyToOne(inversedBy: 'user_reservation')]
    #[Groups(['read:user'])]
    private ?User $user = null;

    public function __construct()
    {
        $this->horaireReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeInterface $date_reservation): self
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getCouvertsReservation(): ?int
    {
        return $this->couverts_reservation;
    }

    public function setCouvertsReservation(int $couverts_reservation): self
    {
        $this->couverts_reservation = $couverts_reservation;

        return $this;
    }

    public function getAllergieReservation(): ?string
    {
        return $this->allergie_reservation;
    }

    public function setAllergieReservation(?string $allergie_reservation): self
    {
        $this->allergie_reservation = $allergie_reservation;

        return $this;
    }

    public function getCommentaireReservation(): ?string
    {
        return $this->commentaire_reservation;
    }

    public function setCommentaireReservation(?string $commentaire_reservation): self
    {
        $this->commentaire_reservation = $commentaire_reservation;

        return $this;
    }

    /**
     * @return Collection<int, HoraireReservation>
     */
    public function getHoraireReservations(): Collection
    {
        return $this->horaireReservations;
    }

    public function addHoraireReservation(HoraireReservation $horaireReservation): self
    {
        if (!$this->horaireReservations->contains($horaireReservation)) {
            $this->horaireReservations->add($horaireReservation);
            $horaireReservation->addHoraireReservation($this);
        }

        return $this;
    }

    public function removeHoraireReservation(HoraireReservation $horaireReservation): self
    {
        if ($this->horaireReservations->removeElement($horaireReservation)) {
            $horaireReservation->removeHoraireReservation($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    public function __toString()
    {
        return 
        (string) $this->user;
        (string) $this->horaireReservations;
        (string) $this->couverts_reservation;
        (string) $this->date_reservation;




        
    
    }
    
}