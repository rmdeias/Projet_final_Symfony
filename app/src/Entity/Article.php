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
    private $price;

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

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'articles')]
    private $category;

    #[ORM\ManyToMany(targetEntity: CustomerOrder::class, mappedBy: 'article')]
    private $customerOrders;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ArticleVariation::class)]
    private $variation;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->customerOrders = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, CustomerOrder>
     */
    public function getCustomerOrders(): Collection
    {
        return $this->customerOrders;
    }

    public function addCustomerOrder(CustomerOrder $customerOrder): self
    {
        if (!$this->customerOrders->contains($customerOrder)) {
            $this->customerOrders[] = $customerOrder;
            $customerOrder->addArticle($this);
        }

        return $this;
    }

    public function removeCustomerOrder(CustomerOrder $customerOrder): self
    {
        if ($this->customerOrders->removeElement($customerOrder)) {
            $customerOrder->removeArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ArticleVariation>
     */
    public function getVariation(): Collection
    {
        return $this->variation;
    }

    public function addVariation(ArticleVariation $variation): self
    {
        if (!$this->variation->contains($variation)) {
            $this->variation[] = $variation;
            $variation->setArticle($this);
        }

        return $this;
    }

    public function removeVariation(ArticleVariation $variation): self
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
