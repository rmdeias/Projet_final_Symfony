<?php

namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\CategorieFixtures;

class ArticleFixtures extends Fixture
{
    public const ARTICLE_REFERENCE = 'Article ';
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $article = new Article();
            $article->setLibelle("Article " . $count);
            $article->setPrix($count + 20);
            $this->addReference(self::ARTICLE_REFERENCE. $count, $article);
            $manager->persist($article);
        }
        $manager->flush();
    }

}