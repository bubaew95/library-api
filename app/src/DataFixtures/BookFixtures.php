<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Category;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Book::class, function (Book $book) {
            $book
                ->setCategory($this->getRandomReference(Category::class))
                ->setTitle($this->faker->text(20))
                ->setText($this->faker->randomHtml())
                ->setDescription($this->faker->text(225))
                ->setFile('file')
                ->setImage('https://neb-chr.ru/static/images/arheologiya/43._voprosy_drevne.jpg')
                ->setIsbn($this->faker->isbn10())
                ->setInformation($this->faker->countryISOAlpha3())
                ->setKeywords($this->faker->text(5))
                ->setRecommendation($this->faker->numberBetween(0, 1))
                ->setVisible($this->faker->numberBetween(0, 1))
                ->setYear($this->faker->year())
            ;
        }, 40);
    }

    public function getDependencies() : array
    {
        return [
            CategoryFixtures::class
        ];
    }

}
