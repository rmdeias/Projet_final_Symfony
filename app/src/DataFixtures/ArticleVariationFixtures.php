<?php

namespace App\DataFixtures;

use App\Entity\ArticleVariation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleVariationFixtures extends Fixture implements DependentFixtureInterface
{
    public const ARTICLE_VARIATION_REFERENCE = 'variation';
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $variation = new ArticleVariation();
            $variation-> setSize(ArticleVariation::SIZE_S .$count);
            $variation->setQuantity(100 + $count);
            $variation->setArticle($this->getReference('Article '.$count));
            $this->addReference(self::ARTICLE_VARIATION_REFERENCE. $count, $variation);


            $manager->persist($variation);
        }
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            ArticleFixtures::class,
        ];
    }
}