<?php

namespace App\Controller;

use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/api/v1/categories', name: 'app_category_list', methods: ['GET'])]
    public function index(CategoryService $categoryService) : JsonResponse
    {
        return $this->json($categoryService->getCategories());
    }
}
