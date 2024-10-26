<?php

namespace App\Entity;

use App\Repository\FootRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FootRepository::class)]
class Foot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
