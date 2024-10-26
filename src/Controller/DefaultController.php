<?php

namespace App\Controller;

use App\UXTable\FoodTable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FoodTable $foodTable, Request $request): Response
    {
        $foodTable->process($request);

        return $this->render(
            'default/index.html.twig',
            ['foodTable' => $foodTable]
        );
    }
}
