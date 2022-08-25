<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SupplierRepository::class)]
class Supplier
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
    #[Assert\Regex(
        
    )]
    private $phone;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\OneToMany(mappedBy: 'supplier', targetEntity: ArticleVariation::class)]
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
     * @return Collection<int, ArticleVariation>
     */
    public function getArticleVariations(): Collection
    {
        return $this->variationArticles;
    }

    public function addArticleVariation(ArticleVariation $variationArticle): self
    {
        if (!$this->variationArticles->contains($variationArticle)) {
            $this->variationArticles[] = $variationArticle;
            $variationArticle->setSupplier($this);
        }

        return $this;
    }

    public function removeArticleVariation(ArticleVariation $variationArticle): self
    {
        if ($this->variationArticles->removeElement($variationArticle)) {
            // set the owning side to null (unless already changed)
            if ($variationArticle->getSupplier() === $this) {
                $variationArticle->setSupplier(null);
            }
        }

        return $this;
    }
}
