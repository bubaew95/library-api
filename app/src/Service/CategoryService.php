<?php

namespace App\Service;

use App\Entity\Category;
use App\Model\CategoryListItem;
use App\Repository\CategoryRepository;

readonly class CategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function getCategories() : array
    {
        $categories = $this->categoryRepository->findAllCategories();

        return array_map(fn (Category $category) => (
            (new CategogryListItem())
                ->setId($category->getId())
                ->setTitle($category->getTitle())
                ->setAlias($category->getAlias())
                ->setBbk($category->getBbk())
                ->setDirectory($category->getDirectory())
        ), $categories);
    }
}
