<?php

namespace App\Seeds;

use App\Entity\Category as _Category;
use App\Entity\Color as _Color;
use Doctrine\ORM\EntityManagerInterface;
use Evotodi\SeedBundle\Command\Seed;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Category extends Seed
{
    public function __construct(
        protected UserPasswordHasherInterface $passwordHasher,
        protected EntityManagerInterface $entityManager,
        ?string $name = null)
    {
        parent::__construct($name);
    }

    /**
     * Return the name of your seed.
     */
    public static function seedName(): string
    {
        /*
         * The seed won't load if this is not set
         * The resulting command will be seed:user
         */
        return 'category';
    }

    /**
     * Optional ordering of the seed load/unload.
     * Seeds are loaded/unloaded in ascending order starting from 0.
     * Multiple seeds with the same order are randomly loaded.
     */
    public static function getOrder(): int
    {
        return 0;
    }

    /**
     * The load method is called when loading a seed.
     */
    public function load(InputInterface $input, OutputInterface $output): int
    {
        /*
         * Doctrine logging eats a lot of memory, this is a wrapper to disable logging
         */
        $this->disableDoctrineLogging();

        $categories = [
            [
                'name' => '🍗 Viande',
                'color' => '#FF0000'
            ],
            [
                'name' => '🫑 Légumes',
                'color' => '#008000'
            ],
            [
                'name' => '🍒 Fruits',
                'color' => '#FFA500'
            ],
            [
                'name' => '🐟 Poisson',
                'color'=> '#0080ff'
            ],
            [
                'name' => '🧄 Herbe',
                'color' => '#008000'
            ],
            [
                'name' => '🧀 Fromage',
                'color' => '#FFFF00'
            ]
        ];


        $colorRepository = $this->entityManager->getRepository(_Color::class);
        foreach ($categories as $category) {

            $color = $colorRepository->findOneBy(['color' => $category['color']]);

            $categoryRepo = new _Category();
            $categoryRepo->setLabel($category['name']);
            $categoryRepo->setColor($color);
            $this->entityManager->persist($categoryRepo);
        }

        $this->entityManager->flush();
        $this->entityManager->clear();

        /*
         * Must return an exit code.
         * A value other than 0 or Command::SUCCESS is considered a failed seed load/unload.
         */
        return 0;
    }

    /**
     * The unload method is called when unloading a seed.
     */
    public function unload(InputInterface $input, OutputInterface $output): int
    {
        // Clear the table
        $this->manager->getConnection()->exec('DELETE FROM category');

        /*
         * Must return an exit code.
         * A value other than 0 or Command::SUCCESS is considered a failed seed load/unload.
         */
        return 0;
    }
}
