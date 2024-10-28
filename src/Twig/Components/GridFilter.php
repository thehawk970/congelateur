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


    #[LiveProp(writable: true)]
    public string $search = '';


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
        $criteria = [];
        $criteria = array_merge($criteria, $this->getCategoryCriteria());
        $criteria = array_merge($criteria, $this->getSearchCriteria());

        if (empty($criteria)) {
            return $this->foodRepository->findAll();
        }

        $qb = $this
            ->foodRepository
            ->filterCriteria($criteria);

        $qb = $this->foodRepository->orderCriteria($qb, []);

        return $qb->getQuery()->getResult();
    }

    protected function getCategoryCriteria(): array
    {
        if (null !== $this->category) {
            return ['category' => $this->category];
        }
        return [];
    }

    protected function getSearchCriteria(): array
    {
        if ('' !== $this->search) {
            return ['label' => 'LIKE ' . $this->search];
        }
        return [];
    }


}
