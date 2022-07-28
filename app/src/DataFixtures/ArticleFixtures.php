<?php

namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public const ARTICLE_REFERENCE = 'Article ';
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $article = new Article();
            $article->setLibelle("Article " . $count);
            $article->setPrice($count + 20);
            $this->addReference(self::ARTICLE_REFERENCE. $count, $article);
            $article->addCustomerOrder($this->getReference("order".$count));
            $manager->persist($article);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CustomerOrderFixtures::class,
        ];
    }

}