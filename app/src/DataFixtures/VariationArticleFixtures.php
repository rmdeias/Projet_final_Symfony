<?php

namespace App\DataFixtures;

use App\Entity\VariationArticle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VariationArticleFixtures extends Fixture
{
    public const VARIATION_ARTICLE_REFERENCE = 'variation';
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $variation = new VariationArticle();
            $variation-> setSize(VariationArticle::SIZE_S .$count);
            $variation->setQuantity(100 + $count);
            $variation->setArticle($this->getReference('Article '.$count));
            $this->addReference(self::VARIATION_ARTICLE_REFERENCE. $count, $variation);


            $manager->persist($variation);
        }
        $manager->flush();
    }


}