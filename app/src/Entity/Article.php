<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'integer')]
    #[Assert\PositiveOrZero]
    private $prix;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $img;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $img_alt;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\PositiveOrZero]
    private $promo;

    #[ORM\Column(type: 'date', nullable: true)]
    private $when_deleted;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'articles')]
    private $categorie;

    #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'article')]
    private $commandes;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: VariationArticle::class)]
    private $variation;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->variation = new ArrayCollection();
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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getImgAlt(): ?string
    {
        return $this->img_alt;
    }

    public function setImgAlt(?string $img_alt): self
    {
        $this->img_alt = $img_alt;

        return $this;
    }

    public function getPromo(): ?int
    {
        return $this->promo;
    }

    public function setPromo(?int $promo): self
    {
        $this->promo = $promo;

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

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addArticle($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, VariationArticle>
     */
    public function getVariation(): Collection
    {
        return $this->variation;
    }

    public function addVariation(VariationArticle $variation): self
    {
        if (!$this->variation->contains($variation)) {
            $this->variation[] = $variation;
            $variation->setArticle($this);
        }

        return $this;
    }

    public function removeVariation(VariationArticle $variation): self
    {
        if ($this->variation->removeElement($variation)) {
            // set the owning side to null (unless already changed)
            if ($variation->getArticle() === $this) {
                $variation->setArticle(null);
            }
        }

        return $this;
    }
}
