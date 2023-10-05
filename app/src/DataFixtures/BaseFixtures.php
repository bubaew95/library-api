<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixtures extends Fixture
{
    protected Generator $faker;
    protected ObjectManager $manager;
    private array $referencesIndex = [];

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create('ru');
        $this->manager = $manager;
        $this->loadData($manager);
    }

    abstract public function loadData(ObjectManager $manager);

    protected function createMany(string $className, callable $factory, int $count): void
    {
        for($i = 0; $i < $count; $i++) {
            $entity = $this->create($className, $factory, $i);
            $this->addReference("{$className}|{$i}", $entity);
        }
        $this->manager->flush();
    }

    protected function create(string $className, callable $factory, int $index = 0): mixed
    {
        $entity = new $className();
        $factory($entity, $index);

        $this->manager->persist($entity);

        return $entity;
    }

    protected function getRandomReference(mixed $className): object
    {
        if( !isset($this->referencesIndex[$className]) ) {
            $this->referencesIndex[$className] = [];
            $referenceClass = $this->referenceRepository->getIdentitiesByClass();

            foreach ($referenceClass[$className] as $key => $referenceName) {
                if(str_starts_with($key, $className . '|')) {
                    $this->referencesIndex[$className][] = $key;
                }
            }
        }

        if(empty($this->referencesIndex[$className])) {
            throw new \Exception("Не найдены ссылки на класс: {$className}");
        }

        return $this->getReference($this->faker->randomElement($this->referencesIndex[$className]));
    }
}
