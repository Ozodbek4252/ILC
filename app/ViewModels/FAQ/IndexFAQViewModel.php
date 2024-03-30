<?php

declare(strict_types=1);

namespace App\ViewModels\FAQ;

use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class IndexFAQViewModel extends BaseViewModel
{
    public int $id;
    public array $translations;

    protected function populate(): void
    {
        $this->id = $this->_data->id;
        $this->translations = $this->getTranslations($this->_data->translations);
    }

    private function getTranslations(Collection $collection): array
    {
        $collection = $collection->filter(function ($item) {
            return $item->lang->code == 'ru';
        });

        $collection = $collection->groupBy('column_name');

        $collection = $collection->map(function ($item) {
            return $item[0];
        });

        return $collection->toArray();
    }
}
