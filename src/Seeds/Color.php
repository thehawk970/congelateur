<?php

namespace App\Seeds;

use App\Entity\Color as _Color;
use Doctrine\ORM\EntityManagerInterface;
use Evotodi\SeedBundle\Command\Seed;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Color extends Seed
{
    public function __construct(
        protected UserPasswordHasherInterface $passwordHasher,
        protected EntityManagerInterface      $entityManager,
        ?string                               $name = null)
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
        return 'color';
    }

    /**
     * Optional ordering of the seed load/unload.
     * Seeds are loaded/unloaded in ascending order starting from 0.
     * Multiple seeds with the same order are randomly loaded.
     */
    public static function getOrder(): int
    {
        return 1;
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

        $colors = [
            'danger' => 'Rouge',
            'success' => 'Vert',
            'info' => 'Bleu',
            'warning' => 'Jaune',

        ];

        foreach ($colors as $hex => $color) {
            $colorRepo = new _Color();
            $colorRepo->setLabel($color);
            $colorRepo->setColor($hex);
            $this->entityManager->persist($colorRepo);
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
        $this->manager->getConnection()->exec('DELETE FROM color');

        /*
         * Must return an exit code.
         * A value other than 0 or Command::SUCCESS is considered a failed seed load/unload.
         */
        return 0;
    }
}
