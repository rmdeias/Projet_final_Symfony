<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'date', nullable: true)]
    private $when_deleted;

    #[ORM\Column(type: 'string', length: 30)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\OneToMany(mappedBy: 'fournisseur', targetEntity: VariationArticle::class)]
    private $variationArticles;

    public function __construct()
    {
        $this->variationArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getWhenDeleted(): ?\DateTimeInterface
    {
        return $this->when_deleted;
    }

    public function setWhenDeleted(?\DateTimeInterface $when_deleted): self
    {
        $this->when_deleted = $when_deleted;

        return $this;
    }


    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, VariationArticle>
     */
    public function getVariationArticles(): Collection
    {
        return $this->variationArticles;
    }

    public function addVariationArticle(VariationArticle $variationArticle): self
    {
        if (!$this->variationArticles->contains($variationArticle)) {
            $this->variationArticles[] = $variationArticle;
            $variationArticle->setFournisseur($this);
        }

        return $this;
    }

    public function removeVariationArticle(VariationArticle $variationArticle): self
    {
        if ($this->variationArticles->removeElement($variationArticle)) {
            // set the owning side to null (unless already changed)
            if ($variationArticle->getFournisseur() === $this) {
                $variationArticle->setFournisseur(null);
            }
        }

        return $this;
    }
}
