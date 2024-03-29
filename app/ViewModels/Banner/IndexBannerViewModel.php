<?php

declare(strict_types=1);

namespace App\ViewModels\Banner;

use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class IndexBannerViewModel extends BaseViewModel
{
    public int $id;
    public string $file;
    public string $title;
    public string $type;
    public ?string $file_type;
    public ?bool $is_published;

    public array $translations;

    protected function populate(): void
    {
        $this->id = $this->_data->id;
        $this->file = $this->_data->file;
        $this->type = $this->_data->type;
        $this->file_type = $this->_data->file_type;
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
