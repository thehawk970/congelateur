<?php

namespace App\Twig\Components;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsLiveComponent]
final class GridFilter extends AbstractController
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public ?Category $category = null;

    /**
     * @var Category[]
     */
    #[LiveProp(writable: true)]
    public array $categories = [];


    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected FoodRepository     $foodRepository
    )
    {
        $this->categories = $this->categoryRepository->findAll();
    }

    #[ExposeInTemplate]
    public function getFoods(): array
    {
        if (null === $this->category) {
            return $this->foodRepository->findAll();
        }
        
        return $this->foodRepository->findBy(['category' => $this->category]);
    }


}
