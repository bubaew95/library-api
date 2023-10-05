<?php

namespace App\Model;

class ApiResponse
{
    /**
     * @param BaseBookListItem[] $items
     * @param int $offset
     * @param int $limit
     */
    public function __construct(
        private array $items,
        private int $offset = 0,
        private int $limit = 20
    ){}


    /**
     * @return BaseBookListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
