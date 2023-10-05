<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Category::class, function (Category $category, int $index) {
            $category
                ->setTitle($this->faker->text(20))
                ->setPosition($index + 1)
                ->setBbk($this->faker->numerify('##.#'))
                ->setDirectory("dir_{$index}")
            ;
        }, 20);
    }
}
