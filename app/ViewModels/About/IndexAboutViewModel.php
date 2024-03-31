<?php

declare(strict_types=1);

namespace App\ViewModels\About;

use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class IndexAboutViewModel extends BaseViewModel
{
    public int $id;
    public string $background_image;
    public string $background_image_url;
    public string $sec1_image;
    public string $sec1_image_url;
    public string $sec2_image;
    public string $sec2_image_url;
    public array $translations;

    protected function populate(): void
    {
        $this->id = $this->_data->id;
        $this->background_image = $this->_data->background_image;
        $this->background_image_url = $this->_data->background_image_url;
        $this->sec1_image = $this->_data->sec1_image;
        $this->sec1_image_url = $this->_data->sec1_image_url;
        $this->sec2_image = $this->_data->sec2_image;
        $this->sec2_image_url = $this->_data->sec2_image_url;
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
