<?php

namespace App\Controller;

use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FoodRepository $foodRepository): Response
    {
        $foods = $foodRepository->findAll();
        return $this->render('default/index.html.twig', [
            'foods' => $foods,
        ]);
    }
}
