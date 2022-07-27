<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public const CATEGORY_REFERENCE = 'category ';

    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $category = new Category();
            $category->setLibelle("Category " . $count);
            $this->addReference(self::CATEGORY_REFERENCE . $count, $category);
            $category->addArticle($this->getReference('Article ' .$count));

            $manager->persist($category);
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