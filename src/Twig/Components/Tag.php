<?php

namespace App\Twig\Components;

use App\Entity\Color;
use App\Entity\Food;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Tag
{
    public Color|null $color;
    public Food|null $food;
}
