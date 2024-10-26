<?php

namespace App\Seeds;

use Doctrine\ORM\EntityManagerInterface;
use Evotodi\SeedBundle\Command\Seed;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Food extends Seed
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
        return 'food';
    }

    /**
     * Optional ordering of the seed load/unload.
     * Seeds are loaded/unloaded in ascending order starting from 0.
     * Multiple seeds with the same order are randomly loaded.
     */
    public static function getOrder(): int
    {
        return 3;
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

        $foods = [];
        $foods['Rouge'] = [
            4 => 'saucisses',
            5 => 'saucisses',
            6 => 'bavette',
            1 => 'boudin',
            2 => 'boudin',
            3 => 'lardons',
            7 => 'lardons',
            8 => 'magrets 2019',
            9 => 'magrets 2019',
            10 => 'magrets 2019',
            11 => 'poulet entier',
            12 => 'poulet entier',
            13 => 'lapin morceaux',
            14 => 'lapin morceaux',
            15 => 'lapin morceaux',
            16 => 'Rôti de porc',
            17 => 'Rôti de porc',
            18 => 'Pot au feu petit',
            19 => 'Ribs',
            20 => 'Ventrèche épaisse',
            21 => 'Jarret',
            22 => 'Tranches veau',
            '19a' => 'Pot au feu grand',
            '20a' => 'Bourguignon',
            '21a' => 'Tranches de veau',
            '22a' => 'Tranches de veau',
            23 => 'Bourguignon',
            24 => 'Aiguillette',
            25 => 'Aiguillette',
            26 => 'Aiguillette',
            27 => 'Magrets anciens',
            28 => 'Magrets anciens',
            29 => 'Ventrèche épaisse',
            30 => 'Bourguignon',
            31 => 'Bavettes x2',
            32 => 'lapin morceaux',
            33 => 'Bavette',
            34 => 'Tranche de veau',
            35 => 'Tranche de veau',
            36 => 'Tranche de veau',
            37 => 'Chair à saucisse 500g',
            38 => 'Filet mignon',
            39 => 'Rôti de beau',
            40 => 'Saucisse',
            41 => 'Saucisse',
            42 => 'Pot au feu grand',
            43 => 'Bavettes x2',
            44 => 'Tournedos x2',
            45 => 'Bavettes x2',
            46 => 'Chair à saucisse 500g',
            47 => 'Chair à saucisse 500g',
            48 => 'Saucisse',
            49 => 'Araignée',
            50 => 'Bavette',
            51 => 'Bavette',
            52 => ['Steack de veau', 16],
        ];

        $foods['Bleu'] = [
            1 => 'Ciboulettes',
            2 => 'Persils',
            3 => 'Persils',
            4 => 'Persils',
            5 => 'Persils',
            6 => 'Persils',
            7 => 'Cèpes 2021',
            8 => 'Cèpes 2021',
            9 => 'Cèpes 2024',
            10 => 'Cèpes 2024',
            11 => 'Cèpes 2024',
        ];

        $foods['Jaune'] = [
            1 => 'Mirabelle',
            2 => 'Figues',
            3 => 'Cassis',
            4 => 'Framboises 500g',
            5 => 'Noix',
            6 => 'Compotes'
        ];

        $foods['Vert'] = [
            1 => 'Tomates',
            2 => ['Tomates coeur de boeuf', 2],
            3 => 'Poireaux rondelles',
            4 => 'Petit pois',
            5 => 'Poivrons verts',
            6 => 'Haricots verts',
            7 => 'Haricots verts',
            8 => 'Haricots verts',
            9 => 'Haricots verts',
            10 => 'Haricots verts',
            24 => 'Haricots verts',
            11 => 'Haricots plats',
            12 => 'Haricots plats',
            13 => 'Haricots plats',
            14 => 'Poivrons verts',
            15 => 'Poivrons verts',
            16 => 'Potimarron',
            17 => 'Butternut',
            18 => 'Carottes',
            19 => 'Carottes',
            20 => 'Poivrons rouge',
            21 => 'Haricots blancs',
            22 => 'Courgettes',
            23 => 'Courgettes'
        ];


        foreach ($foods as $color => $list) {


            $colorRepository = $this->entityManager->getRepository(\App\Entity\Color::class);
            $color = $colorRepository->findOneBy(['label' => $color]);
            if ($color === null) {
                continue;
            }
            $category = $color->getCategories()->first();


            foreach ($list as $key => $food) {
                $foodEntity = new \App\Entity\Food();
                $foodEntity->setNumber($key);

                if (is_array($food)) {
                    $foodEntity->setLabel($food[0]);
                    $foodEntity->setQuantity($food[1]);
                } else {
                    $foodEntity->setLabel($food);
                }

                $foodEntity->setCategory($category);
                $this->entityManager->persist($foodEntity);
            }
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
        $this->manager->getConnection()->exec('DELETE FROM food');

        /*
         * Must return an exit code.
         * A value other than 0 or Command::SUCCESS is considered a failed seed load/unload.
         */
        return 0;
    }
}
