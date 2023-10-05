<?php

namespace App\Controller;

use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/api/v1/books', methods: ['GET'])]
    public function index(Request $request, BookService $bookService, $responseItems): JsonResponse
    {
        $offset = $request->query->get('offset') ?? 0;
        $limit = $request->query->get('limit') ?? $responseItems;
        $filters = $request->query->all('filter');

        return $this->json($bookService->getBookList($filters, $offset, $limit));
    }

    #[Route('/api/v1/category/{alias}/books', methods: ['GET'])]
    public function booksByCategory(Request $request, BookService $bookService, string $responseItems, string $alias) : JsonResponse
    {
        $offset = $request->query->get('offset') ?? 0;
        $limit = $request->query->get('limit') ?? $responseItems;

        return $this->json($bookService->getBooksByCategory($alias, $offset, $limit));
    }

    #[Route('/api/v1/book/{id}', methods: ['GET'])]
    public function details(int $id, BookService $bookService) : JsonResponse
    {
        return $this->json($bookService->getBookDetails($id));
    }
}
