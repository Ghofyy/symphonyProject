<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Ads;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('FR-fr');
        
        for ($i=1; $i <= 30; $i++ )
        {
        $ads =new Ads();
        $title = $faker->sentence();
       
        $coverImage = $faker->imageUrl(1000,350);
        $introduction = $faker->paragraph(2);
        $content = '<p>' .join( '</p><p>', $faker->paragraphs(2)).'</p>';
        $ads->setTitle($title)
            ->setCoverImage($coverImage)
            ->setIntroduction($introduction)
            ->setContent($content)
            ->setPrice(mt_rand(20, 400))
            ->setRooms(mt_rand(1,5)); 
      
         $manager->persist($ads);
        }
        $manager->flush();
    }
}
