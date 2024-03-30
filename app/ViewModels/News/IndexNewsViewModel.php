<?php

declare(strict_types=1);

namespace App\ViewModels\News;

use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class IndexNewsViewModel extends BaseViewModel
{
    public int $id;
    public string $image;
    public ?bool $is_published;

    public array $translations;

    protected function populate(): void
    {
        $this->id = $this->_data->id;
        $this->image = $this->_data->image;
        $this->is_published = $this->_data->is_published;

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
