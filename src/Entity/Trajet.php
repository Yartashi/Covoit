<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrajetRepository")
 */
class Trajet
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeDep;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeDest;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDep;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombrePlacesMax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="trajets")
     */
    private $conducteur_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="trajet")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="trajet")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVilleDep(): ?string
    {
        return $this->villeDep;
    }

    public function setVilleDep(string $villeDep): self
    {
        $this->villeDep = $villeDep;

        return $this;
    }

    public function getVilleDest(): ?string
    {
        return $this->villeDest;
    }

    public function setVilleDest(string $villeDest): self
    {
        $this->villeDest = $villeDest;

        return $this;
    }

    public function getDateDep(): ?\DateTimeInterface
    {
        return $this->dateDep;
    }

    public function setDateDep(\DateTimeInterface $dateDep): self
    {
        $this->dateDep = $dateDep;

        return $this;
    }

    public function getNombrePlacesMax(): ?int
    {
        return $this->nombrePlacesMax;
    }

    public function setNombrePlacesMax(int $nombrePlacesMax): self
    {
        $this->nombrePlacesMax = $nombrePlacesMax;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(?int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getConducteurId(): ?Utilisateur
    {
        return $this->conducteur_id;
    }

    public function setConducteurId(?Utilisateur $conducteur_id): self
    {
        $this->conducteur_id = $conducteur_id;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setTrajet($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getTrajet() === $this) {
                $commentaire->setTrajet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setTrajet($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            // set the owning side to null (unless already changed)
            if ($inscription->getTrajet() === $this) {
                $inscription->setTrajet(null);
            }
        }

        return $this;
    }
}
