<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionRepository")
 */
class Inscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateInscr;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPassage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="inscriptions")
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trajet", inversedBy="inscriptions")
     */
    private $trajet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscr(): ?\DateTimeInterface
    {
        return $this->dateInscr;
    }

    public function setDateInscr(\DateTimeInterface $dateInscr): self
    {
        $this->dateInscr = $dateInscr;

        return $this;
    }

    public function getNbPassage(): ?int
    {
        return $this->nbPassage;
    }

    public function setNbPassage(int $nbPassage): self
    {
        $this->nbPassage = $nbPassage;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getTrajet(): ?Trajet
    {
        return $this->trajet;
    }

    public function setTrajet(?Trajet $trajet): self
    {
        $this->trajet = $trajet;

        return $this;
    }
}
