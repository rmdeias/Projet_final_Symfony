<?php

namespace App\Entity;

use App\Repository\ArticleVariationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleVariationRepository::class)]
class ArticleVariation
{
    const SIZE_XXS = 'XXS';
    const SIZE_XS = 'XS';
    const SIZE_S = 'S';
    const SIZE_M = 'M';
    const SIZE_L = 'L';
    const SIZE_XL = 'XL';
    const SIZE_XXL = 'XXL';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $size;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\ManyToOne(targetEntity: Supplier::class, inversedBy: 'variationArticles')]
    private $supplier;

    #[ORM\ManyToOne(targetEntity: Article::class, inversedBy: 'variation')]
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
