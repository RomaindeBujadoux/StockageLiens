<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinksRepository")
 */
class Links
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
    private $Nom;

    /**
     * @ORM\Column(type="text")
     */
    private $Cible;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $Auteur;

    /**
     * 
     * @ORM\Column(type="datetime")
     */
    private $Date_publi;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getCible(): ?string
    {
        return $this->Cible;
    }

    public function setCible(string $Cible): self
    {
        $this->Cible = $Cible;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    public function setAuteur(?string $Auteur): self
    {
    	
        $this->Auteur = $Auteur;

        return $this;
    }

    public function getDatePubli(): ?\DateTimeInterface
    {
        return $this->Date_publi;
    }

    public function setDatePubli(?\DateTimeInterface $Date_publi): self
    {
        $this->Date_publi = $Date_publi;

        return $this;
    }
}
