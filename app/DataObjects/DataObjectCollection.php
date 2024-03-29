<?php

namespace App\DataObjects;

use Illuminate\Support\Collection;

class DataObjectCollection
{

    /**
     * @var Collection
     */
    public Collection $items;
    public int        $totalCount;
    public int        $limit;
    public int        $page;

    public function __construct(Collection $items, int $totalCount, int $limit, int $page)
    {
        $this->items      = $items;
        $this->totalCount = $totalCount;
        $this->limit      = $limit;
        $this->page       = $page;
    }
}
