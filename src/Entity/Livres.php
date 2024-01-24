<?php

namespace App\Entity;

use App\Repository\LivresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity(repositoryClass: LivresRepository::class)]
class Livres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $editeur = null;

    #[ORM\Column(length: 255)]
    private ?string $auteur = null;

    #[ORM\Column]
    private ?int $isbn = null;

    #[ORM\Column(type: "datetime")]
    private ?DateTime $date_publication = null;
    

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image;


    #[ORM\Column(type: Types::TEXT)]
    private ?string $resume = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'livres')]
    private Collection $genre;

    #[ORM\Column(nullable: true)]
    private ?bool $emprunte = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    private ?User $empruntePar = null;

    private $emprunteParPrenom;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateRendu = null;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(string $editeur): static
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getIsbn(): ?int
    {
        return $this->isbn;
    }

    public function setIsbn(int $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getDatePublication(): ?DateTime
    {
        return $this->date_publication;
    }
    
    public function setDatePublication(?DateTime $date_publication): static
    {
        $this->date_publication = $date_publication;
    
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genre->contains($genre)) {
            $this->genre->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    public function isEmprunte(): ?bool
    {
        return $this->emprunte;
    }

    public function setEmprunte(?bool $emprunte): static
    {
        $this->emprunte = $emprunte;

        return $this;
    }

    public function getEmpruntePar(): ?User
    {
        return $this->empruntePar;
    }

    public function setEmpruntePar(?User $empruntePar): static
    {
        $this->empruntePar = $empruntePar;

        return $this;
    }

    public function getDateRendu(): ?\DateTimeInterface
    {
        return $this->dateRendu;
    }

    public function setDateRendu(?\DateTimeInterface $dateRendu): static
    {
        $this->dateRendu = $dateRendu;

        return $this;
    }

    public function getEmprunteParPrenom(): ?string
    {
        return $this->empruntePar ? $this->empruntePar->getPrenom() : null;
    }
    public function setEmprunteParPrenom(?string $emprunteParPrenom): self
    {
        $this->emprunteParPrenom = $emprunteParPrenom;

        return $this;
    }
}

